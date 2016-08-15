<?php

namespace Thirty98\API\POS\Services;

use DB;
use Thirty98\API\Stdlib\Helpers\QueryHelperService;
use Thirty98\API\Vehicle\Services\VehicleService;
use Thirty98\Models\POSLaLicenseCodeTransactionType;
use Thirty98\Models\POSLaNorthAmericanState;
use Thirty98\Models\POSLAStatePlateCode;
use Thirty98\Models\POSLaTitleCodeTransactionType;
use Thirty98\Models\POSLaTransactionType;
use Thirty98\Models\VehicleType;
use Thirty98\API\TaxWatch\Services\TaxWatchService;

class POSService
{
    /**
     * References
     * Substring: SELECT SUBSTRING('CAT', 1, 1)
     * REGEXP: SELECT SUBSTRING('CAT', 1, 1) REGEXP '[A-Z]'
     *
     */

    protected $model;
    protected $vehicle_model;
    protected $tax_watch_service;

    public function __construct(POSLAStatePlateCode $pos_state_plate_code, VehicleService $vehicle_service, TaxWatchService $tax_watch_service)
    {
        $this->model = $pos_state_plate_code;
        $this->vehicle_model = $vehicle_service;
        $this->tax_watch_service = $tax_watch_service;
    }

    public function getNorthAmericanStates()
    {
        $result = POSLaNorthAmericanState::select('state_code as code', 'name', 'slug', 'state_type_code as code_type', 'country_code')
            ->orderBy('name')
            ->get();

        /**
         * code: "AL",
         * name: "Alabama",
         * slug: "alabama",
         * country_code: "US"
         */

        if (count($result) === 0) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_code' => "NO_DATA_FOUND",
                    'response_msg' => "No North American States found",
                    "exception" => "No North American States found"
                ]
            ];
        }

        return $result->toArray();
    }

    public function getLicenseCodeDefaults($transaction_type)
    {
        $result = POSLaLicenseCodeTransactionType::join('pos_la_license_codes', 'pos_license_code_id', '=', 'pos_la_license_codes.id')
            ->join('pos_la_transaction_types', 'pos_transaction_type_id', '=', 'pos_la_transaction_types.id')
            ->where('pos_la_transaction_types.code', '=', $transaction_type)
            ->select('pos_la_license_codes.name', 'pos_la_license_codes.code', DB::raw('CONCAT(pos_la_license_codes.name, " - ", pos_la_license_codes.code) AS full_name'), 'selected')
            ->get();

        if (count($result) !== 0) {
            $container = [];
            $selected = '';

            foreach ($result as $data) {
                if ($data['selected']) {
                    $selected = $data->toArray()['code'];
                }

                unset($data['selected']);
                $container[] = $data;
            }

            $result = [];
            $result['License Codes'] = $container;
            $result['selected'] = $selected;
        }

        return $result;
    }

    public function getTitleCodeDefaults($transaction_type)
    {
        $result = POSLaTitleCodeTransactionType::join('pos_la_title_codes', 'pos_title_code_id', '=', 'pos_la_title_codes.id')
            ->join('pos_la_transaction_types', 'pos_transaction_type_id', '=', 'pos_la_transaction_types.id')
            ->where('pos_la_transaction_types.code', '=', $transaction_type)
            ->select('pos_la_title_codes.name', 'pos_la_title_codes.code', DB::raw('CONCAT(pos_la_title_codes.name, " - ", pos_la_title_codes.code) AS full_name'), 'selected')
            ->get();

        if (count($result) !== 0) {
            $container = [];
            $selected = '';

            foreach ($result as $data) {
                if ($data['selected']) {
                    $selected = $data->toArray()['code'];
                }

                unset($data['selected']);
                $container[] = $data;
            }

            $result = [];
            $result['Title Codes'] = $container;
            $result['selected'] = $selected;
        }

        return $result;
    }

    public function getTransactionType($code)
    {
        $result = POSLaTransactionType::where('code', '=', $code)->first();

        if (count($result) === 0) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_code' => "NO_DATA_FOUND",
                    'response_msg' => "No transaction type match found",
                    "exception" => "No transaction type found for transaction type code: '{$code}'"
                ]
            ];
        }

        return $result;
    }

    public function getFees($taxable_value, $state, $street_address, $zip, $county, $city)
    {
        $result = $this->tax_watch_service->getFees($taxable_value, $state, $street_address, $zip, $county, $city);

        return $result;
    }

    public function getPOSPlateCalculation($pos, $taxable_value, $date_of_sale, $weight, $number_of_passengers, $renewal)
    {
        $total_amount = 0;

        foreach ($pos as $key => $data) {
            if ($data) {
                switch ($key) {
                    case "spov":
                        // $total_amount = $total_amount + $taxable_value;
                        break;
                    case "init_fee":
                        if ($renewal == false) {
                            $total_amount = $total_amount + $data;
                        }
                        break;
                    case "weight_per_hundred":
                        $total_amount = $total_amount + $this->vehicle_model->getPOSWeightedCalculation($weight, $data, 100);
                        break;
                    case "weight_per_thousand":
                        $total_amount = $total_amount + $this->vehicle_model->getPOSWeightedCalculation($weight, $data, 1000);
                        break;
                    case "prorated":
                        $total_amount = $total_amount + $this->vehicle_model->getProrateMultiplier($date_of_sale);
                        break;
                    case "staggered":
                        // Do nothing.
                        $total_amount = $total_amount + $data;
                        break;
                    case "fixed":
                        $total_amount = $total_amount + $data;
                        break;
                    case "per_passenger":
                        $total_amount = $total_amount + ($data * $number_of_passengers);
                        break;
                }
            }
        }

        return $total_amount;
    }

    public function getLicensePlate($license_plate, $prefix)
    {
        $exists_prefix = [];

        if ($prefix !== "") {
            $exists_prefix = $this->model->where('prefix', '=', $prefix)->get();
        }

        $license_plate_length = strlen($license_plate);
        $condition = "";

        if (count($exists_prefix) === 0) {
            // SQL should not include prefix as condition.
            $sql = "
                SELECT
                  vehicle_name,
                  vehicle_slug,
                  plate_name,
                  number_of_years,
                  per_passenger,
                  DATE_FORMAT(DATE_ADD(
                      DATE_ADD(
                        NOW(),
                        INTERVAL -1 MONTH
                      ),
                      INTERVAL number_of_years YEAR
                    ),'%m/%Y') as expiration_year,
                  class_code,
                  CASE
                    start_weight_range
                    WHEN start_weight_range = 0
                    THEN 0
                    ELSE start_weight_range
                  END AS start_weight_range,
                  CASE
                    end_weight_range
                    WHEN end_weight_range = 0
                    THEN 0
                    ELSE end_weight_range
                  END AS end_weight_range
                FROM
                  (SELECT
                    vehicle_name,
                    vehicle_slug,
                    plate_name,
                    RIGHT(begin_license_w_prefix, {$license_plate_length}) AS begin_license_prefix_ending,
                    RIGHT(end_license_w_prefix, {$license_plate_length}) AS end_license_prefix_ending,
                    begin_license_w_prefix,
                    end_license_w_prefix,
                    prefix,
                    begin_license,
                    end_license,
                    class_code,
                    number_of_years,
                    start_weight_range,
                    end_weight_range,
                    vehicle_priority,
                    per_passenger
                  FROM
                    (SELECT
                      c.name AS vehicle_name,
                      c.slug AS vehicle_slug,
                      b.name AS plate_name,
                      CONCAT(a.prefix, a.begin_license) AS begin_license_w_prefix,
                      CONCAT(a.prefix, a.end_license) AS end_license_w_prefix,
                      a.begin_license,
                      a.end_license,
                      a.class_code,
                      a.number_of_years,
                      a.prefix,
                      a.`start_weight_range`,
                      a.`end_weight_range`,
                      a.`vehicle_priority`,
                      a.`per_passenger`
                    FROM
                      pos_la_state_plate_codes a
                      INNER JOIN pos_la_state_plate_code_categories b
                        ON a.plate_type_id = b.id
                      INNER JOIN vehicle_types c
                        ON c.id = a.vehicle_id) AS a) AS b
            ";

            $condition = "WHERE prefix IS NULL OR prefix = ''";
        } else {
            // SQL should also include prefix as condition.
            $sql = "
                SELECT
                  vehicle_name,
                  vehicle_slug,
                  plate_name,
                  per_passenger,
                  number_of_years,
                  DATE_FORMAT(DATE_ADD(
                      DATE_ADD(
                        NOW(),
                        INTERVAL -1 MONTH
                      ),
                      INTERVAL number_of_years YEAR
                    ),'%m/%Y') as expiration_year,
                  class_code,
                  CASE
                    start_weight_range
                    WHEN start_weight_range = 0
                    THEN 0
                    ELSE start_weight_range
                  END AS start_weight_range,
                  CASE
                    end_weight_range
                    WHEN end_weight_range = 0
                    THEN 0
                    ELSE end_weight_range
                  END AS end_weight_range
                    FROM
                      (SELECT
                        vehicle_name,
                        vehicle_slug,
                        plate_name,
                        RIGHT(begin_license_w_prefix, {$license_plate_length}) AS begin_license_prefix_ending,
                        RIGHT(end_license_w_prefix, {$license_plate_length}) AS end_license_prefix_ending,
                        begin_license_w_prefix,
                        end_license_w_prefix,
                        prefix,
                        begin_license,
                        end_license,
                        class_code,
                        number_of_years,
                        start_weight_range,
                        end_weight_range,
                        vehicle_priority,
                        per_passenger
                      FROM
                        (SELECT
                          c.name AS vehicle_name,
                          c.slug AS vehicle_slug,
                          b.name AS plate_name,
                          CONCAT(a.prefix, a.begin_license) AS begin_license_w_prefix,
                          CONCAT(a.prefix, a.end_license) AS end_license_w_prefix,
                          a.begin_license,
                          a.end_license,
                          a.class_code,
                          a.number_of_years,
                          a.prefix,
                          a.`start_weight_range`,
                          a.`end_weight_range`,
                          a.`vehicle_priority`,
                          a.`per_passenger`
                        FROM
                          pos_la_state_plate_codes a
                          INNER JOIN pos_la_state_plate_code_categories b
                            ON a.plate_type_id = b.id
                          INNER JOIN vehicle_types c
                            ON c.id = a.vehicle_id) AS a) AS b
            ";

            $condition = "WHERE prefix = '{$exists_prefix[0]['prefix']}'";
        }

        // Append dynamically built SQL.
        $regexp_condition = $this->buildRegExpCondition($license_plate, $condition);

        $sql = $sql . $regexp_condition . " ORDER BY vehicle_priority, start_weight_range, end_weight_range ";
        $result = DB::select($sql);

        if (count($result) == 0) {
            $result = [
                'error' => [
                    'http_code' => 200,
                    'response_code' => "NO_DATA_FOUND",
                    'response_msg' => "No license plate matches found",
                    "exception" => "No license plate matches found for license plate: '{$license_plate}'"
                ]
            ];
        } else {
            $vehicle_types = [];

            foreach ($result as $key => $data) {
                $data = (array)$data;

                if ($data['plate_name'] === 'Commercial') {
                    $display_option = $data['class_code'] . '-' . $data['vehicle_name'] . '-' . $data['plate_name'] . '- 1 YR';

                    $vehicle_types[] = [
                        'name' => $display_option,
                        'vehicle_name' => $data['vehicle_name'],
                        'vehicle_slug' => $data['vehicle_slug'],
                        'plate_name' => $data['plate_name'],
                        'number_of_years' => $data['number_of_years'],
                        'expiration_year' => $data['expiration_year'],
                        'class_code' => $data['class_code'],
                        'start_weight_range' => $data['start_weight_range'],
                        'end_weight_range' => $data['end_weight_range'],
                    ];

                    $display_option = $data['class_code'] . '-' . $data['vehicle_name'] . '-' . $data['plate_name'] . '- 2 YR';

                    $vehicle_types[] = [
                        'name' => $display_option,
                        'vehicle_name' => $data['vehicle_name'],
                        'vehicle_slug' => $data['vehicle_slug'],
                        'plate_name' => $data['plate_name'],
                        'number_of_years' => $data['number_of_years'],
                        'expiration_year' => $data['expiration_year'],
                        'class_code' => $data['class_code'],
                        'start_weight_range' => $data['start_weight_range'],
                        'end_weight_range' => $data['end_weight_range'],
                    ];
                } else {
                    if ($data['vehicle_slug'] === "truck" || $data['vehicle_slug'] === "trailer") {
                        $display_option = $data['class_code'] . '-' . $data['vehicle_name'] . '-' . $data['plate_name'] . ' ' . $data['start_weight_range'] . '-' . $data['end_weight_range'];
                    } else {
                        $display_option = $data['class_code'] . '-' . $data['vehicle_name'] . '-' . $data['plate_name'];
                    }

                    $arr = [
                        'name' => $display_option,
                        'vehicle_name' => $data['vehicle_name'],
                        'vehicle_slug' => $data['vehicle_slug'],
                        'plate_name' => $data['plate_name'],
                        'number_of_years' => $data['number_of_years'],
                        'expiration_year' => $data['expiration_year'],
                        'class_code' => $data['class_code'],
                        'start_weight_range' => $data['start_weight_range'],
                        'end_weight_range' => $data['end_weight_range'],
                    ];

                    if ($data['per_passenger'] != 0) {
                        $arr['has_passenger'] = true;
                    }

                    $vehicle_types[] = $arr;
                }
            }

            // Make unique plate names.
            $vehicle_types = array_unique($vehicle_types, SORT_REGULAR);

            $result = $vehicle_types;
        }

        return $result;
    }

    public function getPrefix($license_plate)
    {
        preg_match('/^[A-z]*/', $license_plate, $match);

        return $match[0];
    }

    public function buildRegExpCondition($str, $condition)
    {
        $str_len = strlen($str);

        for ($i = 1; $i < $str_len; $i++) {
            $string_char = $str[$i - 1];

            if (is_numeric($str[$i - 1])) {
                $condition = QueryHelperService::addCondition($condition, "(SUBSTRING(end_license_prefix_ending, {$i}, 1) REGEXP '[0-9]' AND '$string_char' <= SUBSTRING(end_license_prefix_ending, {$i}, 1))");
            } else {
                $condition = QueryHelperService::addCondition($condition, "(SUBSTRING(end_license_prefix_ending, {$i}, 1) REGEXP '[A-Z]' AND '$string_char' <= SUBSTRING(end_license_prefix_ending, {$i}, 1))");
            }
        }

        $condition = QueryHelperService::addCondition($condition, "LENGTH(end_license_prefix_ending) = {$str_len}");

        return $condition;
    }

    public function getPOSPlateData($pos_class_code)
    {
        $data = POSLAStatePlateCode::join('pos_la_state_plate_code_categories', 'pos_la_state_plate_code_categories.id', '=', 'plate_type_id')
            ->join('vehicle_types', 'vehicle_types.id', '=', 'vehicle_id')
            ->where('class_code', $pos_class_code)
            ->select('spov', 'init_fee', 'weight_per_hundred', 'weight_per_thousand', 'prorated', 'staggered', 'fixed', 'per_passenger', 'vehicle_types.slug', 'prefix')
            ->first();

        if (count($data) == 0) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No pos plate data found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No no pos data found for POS class code: {$pos_class_code}"
                ]
            ];
        }

        return $data;
    }

    public function getVehicleTypes()
    {
        $result = VehicleType::join('state_vehicle_types', 'state_vehicle_types.vehicle_type_id', '=', 'id');

        /**
         * ARTaxRate::join('cities', 'cities.id', '=', 'city_id')
         * ->join('counties', 'counties.id', '=', 'cities.county_id')
         * ->where('counties.state_code', 'AR')
         * ->where('cities.slug', $city)
         * ->first();
         */
    }
}