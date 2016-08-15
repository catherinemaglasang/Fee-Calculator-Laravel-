<?php

namespace Thirty98\Http\Controllers\Manage;


use GuzzleHttp\Client;
use Thirty98\Http\Controllers\Controller;
use Thirty98\http\controllers\models\Cities;
use Thirty98\http\controllers\models\Cities_Fees;
use Thirty98\Http\Controllers\Models\Counties;
use Thirty98\Http\Controllers\Models\CountyFees;
use Thirty98\Http\Controllers\Models\Fees;
use Thirty98\Http\Controllers\Models\StateFees;
use Thirty98\Http\Controllers\Models\States;
use Thirty98\Http\Controllers\Models\TexasDates;
use Thirty98\Http\Controllers\Models\Types;
use DB;

class ManageDataController extends Controller
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    // Get Cities Fees

    /**
     * Get list of Categories.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function getCategories()
    {
        $response = $this->client->get(url('api/v1/categories?api_key=' . env('API_KEY')));

        return response($response->getBody(), $response->getStatusCode(), ['Content-Type' => 'application/json']);
    }

    /**
     * Get Types of a Category ID.
     *
     * @param $categoryId
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function getTypeByCategoryId($categoryId)
    {
        $response = $this->client->get(url('api/v1/categories/' . $categoryId . '/types?api_key=' . env('API_KEY')));

        return response($response->getBody(), $response->getStatusCode(), ['Content-Type' => 'application/json']);
    }

    public function getFeesByState($state, $categoryTypeId)
    {
        $stateFees = StateFees::where('state_id', '=', $state)->where('category_type_id', '=', $categoryTypeId)->get();

        return $this->getName('fee', $stateFees);
    }

    // Get Fees

    private function getName($feeType, $feeGroups)
    {
        $data = [];

        $fees = Fees::where('type', '=', $feeType)->get();

        foreach ($fees as $key => $fee) {
            // Initialize only ids marked as fee
            $fee_id = $fee->id;
            $fee_name = $fee->name;
            // Double foreach which I think not effecient
            foreach ($feeGroups as $key => $feeGroup) {
                if ($feeGroup->fee_id == $fee_id) {
                    $feeGroup['fee_name'] = $fee_name;
                    $feeGroup['edit'] = false;
                    $feeGroup['button'] = 'Edit';
                    $feeGroup['update'] = false;
                    array_push($data, $feeGroup);
                }
            }
        }

        return $data;
    }

    public function getPlateTypes($stateCode, $type)
    {
        if ($type == 'none') {
            $type = '';
        }

        $type = strtolower(trim($type));
        $includedPlates = '';

        // Only applicable in LA.
        if ($stateCode == 'LA') {
            // Rules with complete VIN info
            if ($type == "car") {
                $includedPlates = 'Car|1-Yr Commercial|2-Yr Commercial|Farm';
            } else if ($type == 'van') {
                $includedPlates = 'Car|1-Yr Commercial|2-Yr Commercial|Farm';
            } else if ($type == 'suv') {
                $includedPlates = 'Car|1-Yr Commercial|2-Yr Commercial|Farm';
            } else if ($type == 'truck') {
                $includedPlates = 'Truck|1-Yr Commercial|2-Yr Commercial|Farm';
            } else if ($type == "truck-tractor") {
                $includedPlates = 'Truck|1-Yr Commercial|2-Yr Commercial|Farm*';
            } else if ($type == "private-bus") {
                $includedPlates = 'Private Bus';
            } else if ($type == "motorcycle") {
                $includedPlates = 'Motorcycle';
            } else if ($type == "off-road-vehicle") {
                $includedPlates = 'NONE';
            } else if ($type == "motor-home") {
                $includedPlates = 'Motor Home';
            } else if ($type == "trailer") {
                $includedPlates = 'Trailer|Farm';
            } else if ($type == "utility-trailer") {
                $includedPlates = 'Trailer';
            } else if ($type == "collector-vehicle") {
                $includedPlates = 'Car|Truck';
            } else if ($type == "exempt vehicle") {
                $includedPlates = 'Exempt';
            } else if ($type == "boat-trailer") {
                $includedPlates = 'Trailer';
            } else if ($type == "semi-trailer") {
                $includedPlates = 'Permanent Trailer Plate';
            } else if ($type == "trailer-1y license") {
                $includedPlates = '1-Yr Trailer|1-Yr Farm';
            } else if ($type == "trailer-4y license") {
                $includedPlates = '4-Yr Trailer|4-Yr Farm';
            } else if ($type == "boat-trailer") {
                $includedPlates = 'Boat Trailer Plate';
            }
        }

        $sql = "SELECT
                  pt.name
                FROM
                  plate_types pt
                  INNER JOIN plate_types_states pts
                    ON pts.`plate_type_id` = pt.`id`
                    AND pts.`state_id` =
                    (SELECT
                      `id`
                    FROM
                      states
                    WHERE `code` = :stateCode)";

        if ($includedPlates != '') {
            $includedPlates = explode('|', $includedPlates);
            $exclude_conditions = ' AND (';

            foreach ($includedPlates as $excluded) {
                if ($exclude_conditions == ' AND (') {
                    if ($excluded == 'NONE') {
                        $exclude_conditions .= " LOWER(name) = LOWER('$excluded') ";
                    } else {
                        $exclude_conditions .= " LOWER(name) = LOWER('$excluded Plate') ";
                    }
                } else {
                    if ($excluded == 'NONE') {
                        $exclude_conditions .= " OR LOWER(name) = LOWER('$excluded') ";
                    } else {
                        $exclude_conditions .= " OR LOWER(name) = LOWER('$excluded Plate') ";
                    }
                }
            }

            $exclude_conditions .= ') ORDER by order_no';

            $sql .= $exclude_conditions;
        }

        $data = DB::select(DB::raw($sql), array(
            'stateCode' => $stateCode
        ));

        $result = array();
        $result['data'] = $data;
        $result['sql'] = $sql;
        /*$result['exclude_list'] = $includedPlates;
        $result['sql'] = $sql;*/
        $result = json_encode($result);

        return $result;
    }

    // Get TTL types.
    public function getTTLTypes($stateCode)
    {
        $sql = "
            SELECT
              t.name,
              t.code
            FROM
              ttltypes t
              INNER JOIN ttltype_states ts
                ON ts.`ttltype_id` = t.`id`
                AND ts.`state_id` =
                (SELECT
                  `id`
                FROM
                  states
                WHERE `code` = :stateCode)
        ";

        $data = DB::select(DB::raw($sql), array(
            'stateCode' => $stateCode
        ));

        $result = array();
        $result['data'] = $data;
        $result = json_encode($result);

        return $result;
    }

    // Get Fees
    public function getParishes()
    {
        $result = array();
        $result['data'] = Counties::where('is_parish', 1)->get();
        $result = json_encode($result);

        print $result;
    }

    public function getCitiesByParish($parishName)
    {
        $parishID = Counties::where('name', '=', $parishName)->first()->id;

        $result = array();
        $result['data'] = Cities::where('county_id', '=', $parishID)->get();
        $result = json_encode($result);

        return $result;
    }

    public function getCitiesByState($stateName)
    {
        $result = array();
        $result['data'] = Cities_Fees::getCitiesByState($stateName);
        $result = json_encode($result);

        print $result;
    }

    public function getTypesByCode($stateCode)
    {
        $result = array();
        $result['data'] = Types::getByCode($stateCode);
        $result = json_encode($result);

        print $result;
    }

    public function getFeesByCounty($county, $categoryTypeId)
    {

        $countyFees = CountyFees::where('county_id', '=', $county)
            ->where('category_type_id', '=', $categoryTypeId)
            ->get();

        return $this->getName('fee', $countyFees);

    }

    public function getCitiesFeesBySate($stateName)
    {
        $result = array();
        $result['data'] = $this->addNameObj(Cities_Fees::getCityFees($stateName));
        $result['state'] = $stateName;
        $result = json_encode($result);

        print $result;
    }

    private function addNameObj($feeGroups)
    {
        foreach ($feeGroups as $fees) {
            $fees->button = true;
            $fees->edit = 'Edit';
            $fees->update = false;
            $fees->originalAmount = $fees->fee_amount;
            $fees->originalStartDate = $fees->formatted_start_date;
            $fees->originalEndDate = $fees->formatted_end_date;
        }

        return $feeGroups;
    }

    // Get Penalties
    public function getPenaltiesByState($state, $categoryTypeId)
    {

        $stateFees = StateFees::where('state_id', '=', $state)->where('category_type_id', '=', $categoryTypeId)->get();

        return $this->getName('penalty', $stateFees);

    }

    public function getPenaltiesByCounty($county, $categoryTypeId)
    {

        $countyFees = CountyFees::where('county_id', '=', $county)
            ->where('category_type_id', '=', $categoryTypeId)
            ->get();

        return $this->getName('penalty', $countyFees);

    }

    // Get Tax

    public function getTaxByState($state, $categoryTypeId)
    {
        $stateTax = StateFees::where('state_id', '=', $state)
            ->where('category_type_id', '=', $categoryTypeId)
            ->get();

        return $this->getName('tax', $stateTax);
    }

    public function getTaxByCounty($county, $categoryTypeId)
    {

        $countyTax = CountyFees::where('county_id', '=', $county)
            ->where('category_type_id', '=', $categoryTypeId)
            ->get();

        return $this->getName('tax', $countyTax);

    }

    public function getDateStatus($date_of_sale)
    {
        $result_arr = array(
            'msg' => '',
            'license_fee' => '',
            'invalid_date' => false
        );

        if (strtotime($date_of_sale) == "") {
            $result_arr['msg'] = 'Date of Sale invalid.';
            $result_arr['invalid_date'] = true;
            $result_arr['date_of_sale'] = $date_of_sale;

            return $result_arr;
        }

        $current_date = date('Y-m-d');

        // Staggered.
        $day_difference = (strtotime($current_date) - strtotime($date_of_sale)) / (60 * 60 * 24);

        if ($day_difference > 90 || $day_difference < -180) {

            $day_difference = ($day_difference < 0 ? ($day_difference * -1) . ' days after' : $day_difference . ' days prior');
            $day_difference = 'License Fee Registration can only be done 90 days prior and 180 days after the current date. This Date of Sale is ' . $day_difference . ' the current date.';

            $result_arr['msg'] = $day_difference;
            $result_arr['invalid_date'] = true;

            return $result_arr;
        } else {
            $result_arr['msg'] = 'Date Validated.';

            return $result_arr;
        }
    }

    // Get dates by state

    public function getDatesByState($state, $feeType)
    {
        $tables = [
            'Texas' => TexasDates::class
        ];

        $state_name = States::where('id', '=', $state)->first()->name;
        $dates = $tables[$state_name]::all();

        return $this->getName($feeType, $dates);

    }

    // Get Fee names

    private function getCitiesFees($stateName)
    {
        // run get url
        // make louisiana API
    }

    // Return states

    public function getStates()
    {
        return States::orderBy('priority')->select('code', 'name', 'slug', 'country_code', 'priority')->get()->toArray();
    }
}
