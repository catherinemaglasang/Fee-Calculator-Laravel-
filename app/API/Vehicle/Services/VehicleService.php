<?php

namespace Thirty98\API\Vehicle\Services;

use Thirty98\Models\ARCommercialWeightFee;
use Thirty98\Models\ARPassengerWeightFee;
use Thirty98\Models\ARTaxRate;
use Thirty98\Models\County;
use Thirty98\Models\LABodyStyles;
use Thirty98\Models\LACityParishSalesTax;
use Thirty98\Models\LALicenseWeightFee;
use Thirty98\Models\PlateType;
use Thirty98\Models\StateFuelType;
use Thirty98\Models\StatePlateType;
use Thirty98\Models\StateVehiclePlateType;
use Thirty98\Models\StateVehicleType;
use Thirty98\Models\StateVehicleTypeFee;
use Thirty98\Models\TXInspectionFee;
use Thirty98\Models\TXWeightFee;
use Thirty98\Models\VehicleType;

use DB;

class VehicleService
{
    protected $vehicle_type_model;
    protected $plate_type_model;
    protected $state_vehicle_type_fee_model;
    protected $la_license_weight_fee_model;

    /**
     * Style:
     * Return $this->model->your_function_name
     * Functions needed: fetch plate types by
     */
    public function __construct()
    {
        $this->vehicle_type_model = new VehicleType();
        $this->plate_type_model = new StateVehicleType();
        $this->state_vehicle_type_fee_model = new StateVehicleTypeFee();
        $this->la_license_weight_fee_model = new LALicenseWeightFee();
    }

    /**
     * Arkansas Specific Functions.
     */
    public function fetchArkansasPassengerWeightFees($weight)
    {
        return ARPassengerWeightFee::havingRaw("{$weight} BETWEEN min_weight AND max_weight")->first()->reg_fee;
    }

    public function fetchArkansasCommercialWeightFees($weight)
    {
        return ARCommercialWeightFee::havingRaw("{$weight} BETWEEN min_weight AND max_weight")->first()->reg_fee;
    }

    public function fetchArkansasSalesTax($city, $taxable_value)
    {
        return $this->fetchTaxRates($city, $taxable_value)->state_rate * $taxable_value;
    }

    public function fetchArkansasCityRate($city, $taxable_value)
    {
        return $this->fetchTaxRates($city, $taxable_value)->city_rate;
    }

    public function fetchArkansasCountyRate($city, $taxable_value)
    {
        return $this->fetchTaxRates($city, $taxable_value)->county_rate;
    }

    public function fetchTaxRates($city, $taxable_value)
    {
        return ARTaxRate::join('cities', 'cities.id', '=', 'city_id')
            ->join('counties', 'counties.id', '=', 'cities.county_id')
            ->where('counties.state_code', 'AR')
            ->where('cities.slug', $city)
            ->first();
    }


    /**
     * End of Arkansas Functions.
     */

    /**
     * Fetches county rates.
     * @param $county
     * @return mixed
     */
    public function getCounty($county)
    {
        $data = LACityParishSalesTax::join('cities', 'cities.id', '=', 'city_id')
            ->join('counties', 'cities.county_id', '=', 'counties.id')
            ->where('counties.slug', $county)
            ->select('cities.code as area_code', 'cities.name', 'counties.name', 'area_tax', 'area_vendor_desc', 'parish_tax', 'parish_vendor_desc')
            ->first();

        if (!$data) {
            return [];
        } else {
            $data['area_tax'] = 0;
            $data['area_vendor_desc'] = 0;
        }

        return $data;
    }

    public function getLouisianaBodyStyles($vehicle_type)
    {
        $data = LABodyStyles::join('vehicle_types', 'vehicle_types.id', '=', 'vehicle_id')
            ->where('vehicle_types.slug', '=', $vehicle_type)
            ->select('vehicle_types.slug as vehicle_type', 'la_body_styles.slug as slug', 'body_style', 'code', DB::raw('CONCAT(body_style, " - ", code) AS display_name'), 'priority as display_order')
            ->groupBy('priority')
            ->get()
            ->toArray();

        if (count($data) === 0) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No body styles found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No body styles found for vehicle '{$vehicle_type}' in the state of LA"
                ]
            ];
        }

        return $data;
    }

    /**
     * Fetches city with county rate.
     * @param $city
     * @param $county
     */
    public function getCityAndCountyRate($county, $city)
    {
        return LACityParishSalesTax::join('cities', 'cities.id', '=', 'city_id')
            ->join('counties', 'cities.county_id', '=', 'counties.id')
            ->where('cities.slug', $city)
            ->where('counties.slug', $county)
            ->select('cities.code as area_code', 'cities.name as city_name', 'counties.name as county_name', 'area_tax', 'area_vendor_desc', 'parish_tax', 'parish_vendor_desc')
            ->first();
    }

    public function fetchCounty($county_code, $state_code)
    {
        return County::where('code', '=', $county_code)
            ->where('state_code', '=', $state_code)
            ->first();
    }

    public function fetchAreaTaxRates($county, $city = "")
    {
        $state = 0;

        // Fetch county alone.
        if ($city == "") {
            $state = 0;
            $data = $this->getCounty($county);
        } else {
            $state = 1;
            // Fetch county with city.
            $data = $this->getCityAndCountyRate($county, $city);

            if ($data === null) {
                // Try to look for county alone.
                $data = $this->getCounty($county);
            }
        }

        if (!$data) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No tax rates found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No tax rates found for county: {$county} in the city of {$city}"
                ]
            ];
        }

        return $data;
    }

    public function fetchFuelTypeByState($state)
    {
        $data = StateFuelType::join('fuel_types', 'fuel_types.id', '=', 'fuel_type_id')
            ->where('state_code', $state)
            ->get();

        if (count($data) == 0) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No fuel types found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No fuel types found for the state of {$state}"
                ]
            ];
        }

        return $data->toArray();
    }

    public function fetchTXInspectionFee($code)
    {
        return TXInspectionFee::where('code', $code);
    }

    public function fetchVehicle($vehicleSlug)
    {
        $data = $this->vehicle_type_model->where('slug', $vehicleSlug)
            ->first();

        if (!$data) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No vehicle found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No vehicle {$vehicleSlug} found"
                ]
            ];
        }

        return $data->toArray();
    }

    public function fetchByVehicleByStateAndType($state, $vehicleSlug)
    {
        $data = StateVehicleType::join('vehicle_types', 'vehicle_types.id', '=', 'vehicle_type_id')
            ->where('state_code', $state)
            ->where('vehicle_types.slug', $vehicleSlug)
            ->first();

        if (!$data) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No vehicles found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No vehicle {$vehicleSlug} found for the state of {$state}"
                ]
            ];
        }

        return $data;
    }

    /**
     * This function checks if the vehicle and plate type matches.
     * @param $state
     * @param $vehicleSlug
     * @param $typeOfPlate
     * @return array
     */
    public function fetchPlateTypeByVehicleAndState($state, $vehicleSlug, $typeOfPlate)
    {
        $data = StateVehiclePlateType::join('state_plate_types', 'state_plate_types.id', '=', 'state_plate_type_id')
            ->join('plate_types', 'plate_types.id', '=', 'state_plate_types.plate_type_id')
            ->join('state_vehicle_types', 'state_vehicle_types.id', '=', 'state_vehicle_id')
            ->join('vehicle_types', 'vehicle_types.id', '=', 'state_vehicle_types.vehicle_type_id')
            ->where('state_plate_types.state_code', $state)
            ->where('vehicle_types.slug', $vehicleSlug)
            ->where('plate_types.slug', $typeOfPlate)
            ->select('plate_types.name', 'plate_types.slug')
            ->get()->toArray();

        if (!$data) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No matching plate type found for vehicle",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No plate type: {$typeOfPlate} found for vehicle: {$vehicleSlug} in the state of {$state}"
                ]
            ];
        }

        return $data;
    }


    public function fetchPlateByStateAndVehicleType($state, $vehicleSlug)
    {
        $data = StateVehiclePlateType::join('state_plate_types', 'state_plate_types.id', '=', 'state_plate_type_id')
            ->join('plate_types', 'plate_types.id', '=', 'state_plate_types.plate_type_id')
            ->join('state_vehicle_types', 'state_vehicle_types.id', '=', 'state_vehicle_id')
            ->join('vehicle_types', 'vehicle_types.id', '=', 'state_vehicle_types.vehicle_type_id')
            ->where('state_plate_types.state_code', $state)
            ->where('vehicle_types.slug', $vehicleSlug)
            ->select('plate_types.name', 'plate_types.slug', 'plate_types.slug as value')
            ->get()->toArray();

        if (!$data) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No plate types found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No plate types found for vehicle: {$vehicleSlug} in the state of {$state}"
                ]
            ];
        }

        return $data;
    }

    public function fetchPlateTypeByState($state)
    {
        $data = StateVehiclePlateType::join('state_plate_types', 'state_plate_types.id', '=', 'state_plate_type_id')
            ->join('plate_types', 'plate_types.id', '=', 'state_plate_types.plate_type_id')
            ->join('state_vehicle_types', 'state_vehicle_types.id', '=', 'state_vehicle_id')
            ->join('vehicle_types', 'vehicle_types.id', '=', 'state_vehicle_types.vehicle_type_id')
            ->where('state_plate_types.state_code', $state)
            ->select('plate_types.name', 'plate_types.slug')
            ->get()->toArray();

        if (!$data) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No plate types found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No plate types found in the state of {$state}"
                ]
            ];
        }

        return $data;
    }

    /**
     * @param $plate_type is a slug
     */
    public function getPlateTypeByName($plate_type)
    {
        $data = PlateType::where('slug', $plate_type)->first();

        if (!$data) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No plate type found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No plate type found having an identifier of {$plate_type}"
                ]
            ];
        }

        return $data;
    }

    /**
     * @param $plate_type is a slug
     * @param $state is a slug
     */
    public function getPlateTypeByStateAndName($state, $plate_type)
    {
        $data = StatePlateType::join('plate_types', 'plate_types.id', '=', 'plate_type_id')
            ->where('state_code', $state)
            ->where('plate_types.slug', $plate_type)
            ->first();

        if (!$data) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No plate type found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No plate type found having an identifier of {$plate_type} in the state of: {$state}"
                ]
            ];
        }

        return $data;
    }


    /**
     *  Louisiana Calculations.
     */

    /**
     *  Fetches a fee based on state, vehicle type and fee name.
     * @param $state
     * @param $vehicleType
     * @param $fee
     * @param bool|false $prorated
     * @param bool|false $date_of_sale
     * @param bool|false $proration_month
     * @return array|float
     */
    public function getVehicleFeeByState($state, $vehicleType, $fee)
    {
        $data = $this->state_vehicle_type_fee_model->join('state_vehicle_types', 'state_vehicle_types.id', '=', 'state_vehicle_type_id')
            ->join('vehicle_types', 'vehicle_types.id', '=', 'state_vehicle_types.vehicle_type_id')
            ->join('state_vehicle_fees', 'state_vehicle_fees.id', '=', 'state_vehicle_fee_id')
            ->join('fees', 'fees.id', '=', 'state_vehicle_fees.fee_id')
            ->where('state_vehicle_types.state_code', $state)
            ->where('vehicle_types.slug', $vehicleType)
            ->where('fees.slug', $fee)
            ->whereRaw('now() BETWEEN start_date AND end_date')
            ->select('amount')
            ->first();

        if (!$data) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No vehicle types fee found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No vehicle types found for vehicle: {$vehicleType} in the state of {$state} with a fee of {$fee}"
                ]
            ];
        }

        return $data->amount;
    }

    public function prorateFee($amount, $date_of_sale, $proration_month)
    {
        $date = strtotime($date_of_sale);

        if ($date) {
            $month = date('m', $date);
        } else {
            return "Bad date format.";
        }

        $prorateMonth = date('m', strtotime($proration_month));
        $prorate_next_year = false;

        // Check if july has elapsed.
        if ($month >= $prorateMonth) {
            $licenseMultiplier = (12 - $month) + $prorateMonth;
            $prorate_next_year = true;
        } else {
            $licenseMultiplier = $prorateMonth - $month;
        }

        if ($prorate_next_year) {
            // Get current year and minus that of the difference.
            $license_year = date('Y', strtotime(date('Y'))) + 1;
        } else {
            $license_year = date('Y');
        }

        // Get year difference.
        $current_year = date('Y', strtotime($date_of_sale));
        $year_difference = $current_year - $license_year;

        if ($year_difference > 0) {
            $licenseMultiplier = $licenseMultiplier + (12 * $year_difference);
        }

        $licenseFee = ($amount / 12) * $licenseMultiplier;

        return $licenseFee;
    }

    public function getTXInspectionFees()
    {
        $data = TXInspectionFee::all();

        if (count($data) === 0) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No inspection fees found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No inspection fees found."
                ]
            ];
        }

        return $data;
    }

    public function getTXInspectionFeeByCode($code)
    {
        $data = TXInspectionFee::where('code', $code)->first();

        if (!$data) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No inspection fee found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No inspection fees found for code {$code}."
                ]
            ];
        }

        return $data;
    }

    public function getTXWeightFee($gvw)
    {
        $sql = "
            SELECT
              *
            FROM
              tx_weight_fees
            WHERE $gvw BETWEEN min_weight
              AND max_weight

              ORDER BY max_weight LIMIT 1
        ";

        $data = DB::select(DB::raw($sql));

        if (!$data) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No gvw fee found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No weight found for gvw: {$gvw}"
                ]
            ];
        }

        return $data[0]->reg_fee;
    }

    /**
     * For Car, Van and SUVs having a gvwr of less than 10000.
     * @param $fee
     */
    public function getPassengerVehicleLicenseFee($taxable_amount)
    {
        return (round(($taxable_amount - 10000) * .001) * 2) + 20;
    }

    public function getPOSWeightedCalculation($weight, $prorate_rate, $weight_rate)
    {
        $amount = ($weight / $weight_rate) * $prorate_rate;

        return $amount;
    }

    public function getProrateMultiplier($date_of_sale)
    {
        $date_of_sale_month = date('m', strtotime($date_of_sale));
        $current_month = date('m');

        // Prorate july.
        if ($date_of_sale_month >= 7) {
            $prorate_multiplier = (12 - $current_month) + 7;
        } else {
            $prorate_multiplier = 7 - $current_month;
        }

        return $prorate_multiplier;
    }

    public function getWeightedCalculation($state, $vehicleType, $dateOfSale, $gcvwr, $isFarm = 0)
    {
        $data = $this->la_license_weight_fee_model->join('state_vehicle_types', 'state_vehicle_types.id', '=', 'state_vehicle_type_id')
            ->join('vehicle_types', 'vehicle_types.id', '=', 'state_vehicle_types.vehicle_type_id')
            ->where('vehicle_types.name', $vehicleType)
            ->where('is_farm', $isFarm)
            ->where('state_vehicle_types.state_code', $state)
            ->whereRaw("$gcvwr BETWEEN begin_weight AND end_weight")
            ->havingRaw('now() BETWEEN start_date AND end_date')
            ->first();

        if (!$data) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No license fee found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No license fee found vehicle: {$vehicleType} in the state of {$state} with a Gross Combined Weight Fee of {$gcvwr}"
                ]
            ];
        }


        $is_rate = $data['is_rate'];
        $per_pound_rate = $data['per_pound_rate'];
        $is_farm = $data['is_farm'];
        $prorated = $data['prorated'];
        $fee = $data['fee'];
        $prorationMonth = $data['proration_month'];

        if ($is_farm) {
            return $fee;
        } else {
            if ($prorated && $is_rate) {
                $date = strtotime($dateOfSale);

                if ($date) {
                    $month = date('m', $date);
                } else {
                    return "Bad date format.";
                }

                $prorateMonth = date('m', strtotime($prorationMonth));
                $prorate_next_year = false;

                // Check if july has elapsed.
                if ($month >= $prorateMonth) {
                    $licenseMultiplier = (12 - $month) + $prorateMonth;
                    $prorate_next_year = true;
                } else {
                    $licenseMultiplier = $prorateMonth - $month;
                }

                if ($prorate_next_year) {
                    // Get current year and minus that of the difference.
                    $license_year = date('Y', strtotime(date('Y'))) + 1;
                } else {
                    $license_year = date('Y');
                }

                // Get year difference.
                $current_year = date('Y', strtotime($dateOfSale));
                $year_difference = $current_year - $license_year;

                if ($year_difference > 0) {
                    $licenseMultiplier = $licenseMultiplier + (12 * $year_difference);
                }

                $licenseFee = $gcvwr * ($fee / $per_pound_rate);
                $licenseFee = ($licenseFee / 12) * $licenseMultiplier;

                return $licenseFee;
            } else {
                return $fee;
            }
        }
    }

    /**
     * End of Louisiana Calculations.
     */
}
