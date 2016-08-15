<?php

namespace Thirty98\API\Vehicle\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Thirty98\API\Calculator\Services\TransactionTypeService;
use Thirty98\API\General\Entities\Avalara;
use Thirty98\API\Stdlib\Services\FeeService;
use Thirty98\API\Stdlib\Services\ResponseService;
use Thirty98\API\Vehicle\Services\VehicleService;
use Thirty98\DatahubApi\DatahubApi;
use Thirty98\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Thirty98\Http\Controllers\Models\Counties;
use Thirty98\Models\City;
use Thirty98\Models\County;
use Thirty98\Models\POSLAStatePlateCode;
use Thirty98\Models\POSLaTitleCodeTransactionType;
use Thirty98\Models\POSTitleCode;
use Thirty98\Models\StateVehicleTypeFee; //to be removed
use Thirty98\Models\LACityParishSalesTax; //to be removed
use Thirty98\Models\LALicenseWeightFee; //to be removed
use DB;
use Thirty98\Models\TXInspectionFee; //to be removed


class VehicleController extends Controller
{
    protected $service;

    public function __construct(VehicleService $service)
    {
        $this->service = $service;
    }

    public function getVehicleTypesByState()
    {

    }

    public function getInspectionFees(Request $request)
    {
        $payload = $request;

        $output = $this->service->getTXInspectionFees();

        if (isset($output['error'])) {
            $data = ['error' => $output['error']['exception'], 'payload' => $payload];
            $message = $output['error']['response_msg'];
            $message_code = $output['error']['response_code'];
            return ResponseService::success($message, $data, 200, $message_code);
        }

        $response = ['fuel_types' => $output, 'payload' => $payload];
        return ResponseService::success("Here's the Inspection fees", $response);
    }

    public function getFilteredInspectionFee(Request $request)
    {
        $vehicle_type = $request->get('vehicle_type');
        $model_year = $request->get('model_year');
        $county = $request->get('county');
        $new_or_used = $request->get('new_or_used');

        /**
         * Brazoria|Fort Bend|Galveston|Harris|Montgomery|Collin,|Dallas|Denton|Ellis|Johnson|Kaufman|Parker|Rockwall|Tarrant
         * Travis|Williamson
         * El Paso
         */

        $output = [];
        $emission_countries = ["021", "044", "057", "062", "071", "078", "083", "100", "124", "127", "169", "183", "198", "219"];
        $tarvis_williamson = ["226", "245"];


        if ($new_or_used == 1) {
            $output = $this->service->getInspectionFeeBycode('2YR');
        } else {
            if ($model_year > 25) {

            } else {

            }
        }

        $output = $this->service->getTXInspectionFees();

        if (isset($output['error'])) {
            $data = ['error' => $output['error']['exception'], 'payload' => $payload];
            $message = $output['error']['response_msg'];
            $message_code = $output['error']['response_code'];
            return ResponseService::success($message, $data, 200, $message_code);
        }

        $response = ['fuel_types' => $output, 'payload' => $payload];
        return ResponseService::success("Here's the Inspection fees", $response);

    }

    public function getInspectionFeeBycode($code)
    {
        $payload = $request;

        $output = $this->service->getTXInspectionFeeByCode($code);

        if (isset($output['error'])) {
            $data = ['error' => $output['error']['exception'], 'payload' => $payload];
            $message = $output['error']['response_msg'];
            $message_code = $output['error']['response_code'];
            return ResponseService::success($message, $data, 200, $message_code);
        }

        $response = ['inspection_fee' => $output, 'payload' => $payload];
        return ResponseService::success("Here's the Inspection fees", $response);
    }

    public function getFuelTypes($state)
    {
        $output = $this->service->fetchFuelTypeByState($state);

        if (isset($output['error'])) {
            $data = ['error' => $output['error']['exception']];
            $message = $output['error']['response_msg'];
            $message_code = $output['error']['response_code'];
            return ResponseService::success($message, $data, 200, $message_code);
        }

        $response = ['fuel_types' => $output];
        return ResponseService::success("Here's the fuel types", $response);
    }

    public function getPlateTypesByStateAndVehicle(Request $request)
    {
        $payload = $request->all();

        if (!isset($plate))

            $output = $this->service->fetchPlateByStateAndVehicleType($payload['state']['code'], $payload['vehicle_type']['slug']);

        if (isset($output['error'])) {
            $data = ['error' => $output['error']['exception'], 'payload' => $payload];
            $message = $output['error']['response_msg'];
            $message_code = $output['error']['response_code'];
            return ResponseService::success($message, $data, 200, $message_code);
        }

        $response = ['plate_types' => $output, 'payload' => $payload];
        return ResponseService::success("Here's the plate types", $response);
    }

    public function getPlateTypesByState(Request $request)
    {
        $payload = $request->all();

        $output = $this->service->fetchPlateByState($payload['state']['code']);

        if (isset($output['error'])) {
            $data = ['error' => $output['error']['exception'], 'payload' => $payload];
            $message = $output['error']['response_msg'];
            $message_code = $output['error']['response_code'];
            return ResponseService::success($message, $data, 200, $message_code);
        }

        $response = ['plate_types' => $output, 'payload' => $payload];
        return ResponseService::success("Here's the plate types", $response);
    }

    // For GET - WORKING.
    public function funcTest(Request $request)
    {
        $title_codes = POSTitleCode::all();

        return $title_codes;
    }

    /**
     * Calculate by weight.
     * Assumed GVWR is >= 10000
     * For: Can, Van, SUV, Truck, Truck Tractor
     * Having Plates:
     *  Car, Van, SUV (Car Plate)
     * Trucks (Truck Plate, Farm Plate)
     */
    public function getWeightedCalculation()
    {
        $dateOfSale = '12/11/2016';
        $vehicleType = 'truck';
        $gcvwr = floatval('26000');

        // Get vehicle type rate.
        $db = LALicenseWeightFee::join('state_vehicle_types', 'state_vehicle_types.id', '=', 'state_vehicle_type_id')
            ->join('vehicle_types', 'vehicle_types.id', '=', 'state_vehicle_types.vehicle_type_id')
            ->where('vehicle_types.name', $vehicleType)
            ->whereRaw("$gcvwr BETWEEN start_date AND end_date")
            ->havingRaw('now() BETWEEN start_date AND end_date')
            ->first();

        $data = [
            'date_of_sale' => $dateOfSale,
            'vehicle_type' => $vehicleType,
            'gcvwr' => $gcvwr
        ];

        if (!$db) {
            return "";
        }

        $is_rate = $db['is_rate'];
        $per_pound_rate = $db['per_pound_rate'];
        $is_farm = $db['is_farm'];
        $prorated = $db['prorated'];
        $fee = $db['fee'];
        $prorationMonth = $db['proration_month'];

        if ($is_farm) {
            if ($prorated && $is_rate) {

            } else {
                return $fee;
            }
        } else {
            if ($prorated && $is_rate) {
                // Determine the difference date.
                $date = strtotime($dateOfSale);

                if ($date) {
                    $year = date('Y', $date);
                    $month = date('m', $date);
                } else {
                    return "Bad date format.";
                }

                $prorateMonth = date('m', strtotime($prorationMonth));

                // Check if july has elapsed.
                if ($month >= $prorateMonth) {
                    $licenseMultiplier = (12 - $month) + $prorateMonth;
                } else {
                    $licenseMultiplier = $prorateMonth - $month;
                }

                // Get license fee.
                $licenseFee = $gcvwr * ($fee / $per_pound_rate);
                $licenseFee = ($licenseFee / 12) * $licenseMultiplier;

                $yearDifference = $year - date('Y');

                return $licenseFee;
            } else {
                return $fee;
            }
        }
    }

    public function getGeoLocationRates(Request $request)
    {
        $payload = $request->all();
        $state_code = $payload['state']['code'];

        $payload = [
            'Sales Tax Rate' => $payload['Sales Tax Rate'],
            'city' => $payload['city'],
            'county' => $payload['county'],
        ];

        $response = ['Sales Tax Rates' => $payload['Sales Tax Rate']];
        return ResponseService::success("Here's the Sales Tax Rates", $response);
    }

    /**
     * For Car, Van and SUVs having a gvwr of less than 10000.
     * @param $fee
     * @return float
     */
    public function getPassengerVehicleLicenseFee($fee)
    {
        return (round(($fee - 10000) * .001) * 2) + 20;
    }

    /**
     * Gets a fee from the state_vehicle_type_fees table.
     */
    public function getVehicleFeeFromTable($state, $vehicleType, $feeName)
    {
        /*$state = 'LA';
        $vehicleType = 'car';
        $feeName = '1_yr_commercial_plate';*/

        $fee = StateVehicleTypeFee::join('state_vehicle_types', 'state_vehicle_types.id', '=', 'state_vehicle_type_id')
            ->join('vehicle_types', 'vehicle_types.id', '=', 'state_vehicle_types.vehicle_type_id')
            ->join('state_vehicle_fees', 'state_vehicle_fees.id', '=', 'state_vehicle_fee_id')
            ->join('fees', 'fees.id', '=', 'state_vehicle_fees.fee_id')
            ->where('state_vehicle_types.state_code', $state)
            ->where('vehicle_types.slug', $vehicleType)
            ->where('fees.slug', $feeName)
            ->select('amount')
            ->first();

        return $fee;
    }

    /**
     * Function to get parish and area calculations.
     */
    public function getCitySalesTaxCalcVariables()
    {
        $salesTaxCalculationData = LACityParishSalesTax::join('cities', 'cities.id', '=', 'city_id')
            ->join('counties', 'counties.id', '=', 'cities.county_id')
            ->where('counties.state_code', 'LA')
            ->where('cities.name', 'Crowley')
            ->whereRaw('now() BETWEEN start_date AND end_date')
            ->select('area_tax', 'area_vendor_desc', 'parish_tax', 'parish_vendor_desc')
            ->first();

        $area_tax = $salesTaxCalculationData['area_tax'];
        $area_vendor_desc = $salesTaxCalculationData['area_vendor_desc'];
        $parish_tax = $salesTaxCalculationData['parish_tax'];
        $parish_vendor_desc = $salesTaxCalculationData['parish_vendor_desc'];

        // Static LA computation variables.


        // Determine if there is a city or not.
        if ($area_tax != "" && $area_vendor_desc != "") {

        } else {
            // Just calculate the state and the parish.
        }

        return $salesTaxCalculationData;
    }

    public function getCitySalesTaxCalculationVariables($state, $vehicleType, $gcvwr)
    {
        return LALicenseWeightFee::join('state_vehicle_types', 'state_vehicle_types.id', '=', 'state_vehicle_type_id')
            ->join('vehicle_types', 'vehicle_types.id', '=', 'state_vehicle_types.vehicle_type_id')
            ->where('vehicle_types.name', $vehicleType)
            ->where('state_vehicle_types.state_code', $state)
            ->whereRaw("$gcvwr BETWEEN start_date AND end_date")
            ->havingRaw('now() BETWEEN start_date AND end_date')
            ->first();
    }

    /**
     * @return bool|string
     */
    public function getTXInspectionOptions(Request $request)
    {
        $payload = $request->all();

        $model_year = $payload['model_year'];
        $vehicle_type = $payload['vehicle_type']['slug'];
        $processing_county = $payload['processing_county'];
        $new_or_used = $payload['new_or_used'];

        // FOR ALL NEW VEHICLES.
        $year = date('Y') - $model_year;

        // Model year overrides the new or used.

        if ($year >= 25) {
            // Automatically and OLD vehicle.
            return TXInspectionFee::where('code', '1YR')->first();
        } else if ($year < 25 && $new_or_used == 0) {
            // Less than 25 years old AND used.
            return $this->getAdditionalInspectionsByCounty($processing_county, $vehicle_type);
        } else {
            // It's new.
            return TXInspectionFee::where('code', '2YR')->first();
        }
    }

    public function getAdditionalInspectionsByCounty($county_code, $vehicle_type)
    {
        $emission_a_options = [
            'state_codes' => ['021', '083', '078', '100', '169', '044', '057', '062', '071', '124', '127', '183', '198', '219'],
            'options' => ['ASM', 'OBD', 'EMONLY-ASM', 'EMONLY-OBD', 'SOEO', 'CWEO']
        ];

        $el_paso_options = [
            'state_codes' => ['070'],
            'options' => ['SOEO', 'CWEO', 'EMONLY', 'TSI']
        ];
        $emission_counties_c_options = [
            'state_codes' => ['226', '245'],
            'options' => ['TISOBD', 'OBDNL', 'NLTSI', 'SOEO', 'CWEO']
        ];

        // Get all entries aside from these emission counties.
        $state_wide = ['2YR', 'CW', 'CDEC', 'TLMC'];

        $personal = ['TLMC', 'TSI', 'ASM', 'OBD', 'EMONLY', 'EMONLY-ASM', 'EMONLY-OBD', 'TISOBD',
            'OBDNL', 'NLTSI', 'SOEO', 'SOEO', 'CWEO', 'SOEO', 'CWEO'];

        $commercial = ['CW', 'CDEC', 'CWEO'];

        $tmlc = ['TLMC'];

        $state_wide_query_str = "'2YR', 'CW', 'CDEC', 'TLMC'";

        $sql = "SELECT * FROM tx_inspection_fees WHERE code IN " . "(" . $state_wide_query_str . ")";
        $output = DB::select(DB::raw($sql));

        if (in_array($county_code, $emission_a_options['state_codes'])) {
            foreach ($emission_a_options['options'] as $data) {
                array_push($state_wide, $data);
            }
        }

        if (in_array($county_code, $el_paso_options['state_codes'])) {
            foreach ($el_paso_options['options'] as $data) {
                array_push($state_wide, $data);
            }
        }

        if (in_array($county_code, $emission_counties_c_options['state_codes'])) {
            // die('in 3');
            foreach ($emission_counties_c_options['options'] as $data) {
                array_push($state_wide, $data);
            }
        }

        $state_wide = array_unique($state_wide);

        switch ($vehicle_type) {
            case "passenger":
                $state_wide = $this->filterInspectionCodes($state_wide, $personal);
                break;
            case "van_truck_plates":
                $state_wide = $this->filterInspectionCodes($state_wide, $personal);
                break;
            case "1_4_pickup_truck":
                $state_wide = $this->filterInspectionCodes($state_wide, $personal);
                break;
            case "1_2_pickup_truck":
                $state_wide = $this->filterInspectionCodes($state_wide, $personal);
                break;
            case "3_4_pickup_truck":
                $state_wide = $this->filterInspectionCodes($state_wide, $personal);
                break;
            case "1_ton_pickup_truck":
                $state_wide = $this->filterInspectionCodes($state_wide, array_merge($personal, $commercial));
                break;
            case "pickup_truck_1_ton":
                $state_wide = $this->filterInspectionCodes($state_wide, array_merge($personal, $commercial));
                break;
            case "truck_tractor":
                $state_wide = $this->filterInspectionCodes($state_wide, $commercial);
                break;
            case "combination_truck":
                $state_wide = $this->filterInspectionCodes($state_wide, $commercial);
                break;
            case "city_bus":
                $state_wide = $this->filterInspectionCodes($state_wide, $commercial);
                break;
            case "private_bus":
                $state_wide = $this->filterInspectionCodes($state_wide, $personal);
                break;
            case "motor_bus":
                $state_wide = $this->filterInspectionCodes($state_wide, array_merge($personal, $commercial));
                break;
            case "moped":
                $state_wide = $this->filterInspectionCodes($state_wide, $tmlc);
                break;
            case "motorcycle":
                $state_wide = $this->filterInspectionCodes($state_wide, $tmlc);
                break;
            case "off_road_motorcycle":
                $state_wide = $this->filterInspectionCodes($state_wide, $tmlc);
                break;
            case "mini_bike":
                $state_wide = $this->filterInspectionCodes($state_wide, $tmlc);
                break;
            case "atv_type_vehicle":
                $state_wide = $this->filterInspectionCodes($state_wide, $tmlc);
                break;
            case "motor_home":
                $state_wide = $this->filterInspectionCodes($state_wide, $personal);
                break;
            case "travel_trailer":
                $state_wide = $this->filterInspectionCodes($state_wide, $tmlc);
                break;
            case "token_trailer":
                $state_wide = $this->filterInspectionCodes($state_wide, $tmlc);
                break;
            case "trailer":
                $state_wide = $this->filterInspectionCodes($state_wide, $tmlc);
                break;
            case "utility_trailer":
                $state_wide = $this->filterInspectionCodes($state_wide, $tmlc);
                break;
            case "collector_vehicle":
                $state_wide = $this->filterInspectionCodes($state_wide, $personal);
                break;
            default:
                echo "Your favorite color is neither red, blue, nor green!";
        }

        if ($state_wide > 0) {
            $str = "";
            $iteration = 0;
            foreach ($state_wide as $code) {
                if ($iteration == count($state_wide) - 1) {
                    $str .= "'" . $code . "'";
                } else {
                    $str .= "'" . $code . "'" . ',';
                }

                $iteration++;
            }

            $sql = "SELECT * FROM tx_inspection_fees WHERE code IN " . "(" . $str . ")";
            $output = DB::select(DB::raw($sql));
        }

        $response = ['inspection_fees' => $output];
        return ResponseService::success("Here's the Inspection fees", $response);
    }

    public function filterInspectionCodes($inspection_codes, $filter)
    {
        $filtered_inspection_codes = [];

        foreach ($inspection_codes as $data) {
            if (in_array($data, $filter)) {
                array_push($filtered_inspection_codes, $data);
            }
        }

        return $filtered_inspection_codes;
    }

    public function generateArray($name, $city_list)
    {
        print($name . ' ' . '[');

        foreach ($city_list as $data) {
            $id = County::where('name', 'LIKE', "$data")->first();

            if (!$id) {
                dd($data);
            } else {
                print $id->code . ", ";
            }

        }

        print(']');
    }


    /**
     * Vehicle License Fee Formulas
     */
    public function getLicenseFeeForCars()
    {
        $typeOfPlate = '';
        $gcvw = '';

        // See car.
        // First and foremost, see GCVW.
        if ($gcvw >= 10000) {

        } else {

        }

        if ($typeOfPlate == 'Car Plate') {
            if ($gcvw >= 10000) {
                // Get weighted fees
            } else {
                // Get fee by value
            }
        } else if ($typeOfPlate == '1-Yr Commercial Plate') {
            if ($gcvw >= 10000) {
                // Return error.
            } else {
                // return value in fees table
            }
        } else if ($typeOfPlate == '2-Yr Commercial Plate') {
            if ($gcvw >= 10000) {
                // Return error.
            } else {
                // return value in fees table
            }
        }
    }

    public function getLicenseFeeForVans()
    {
        $typeOfPlate = '';
        $gcvw = '';

        if ($typeOfPlate == 'Car Plate') {
            if ($gcvw >= 10000) {
                // Get weighted fees
            } else {
                // Get fee by value
            }
        } else if ($typeOfPlate == '1-Yr Commercial Plate') {
            if ($gcvw >= 10000) {
                // Return error.
            } else {
                // return value in fees table
            }
        } else if ($typeOfPlate == '2-Yr Commercial Plate') {
            if ($gcvw >= 10000) {
                // Return error.
            } else {
                // return value in fees table
            }
        }
    }

    public function getLicenseFeeForSUVs()
    {
        $typeOfPlate = '';
        $gcvw = '';

        if ($typeOfPlate == 'Car Plate') {
            if ($gcvw >= 10000) {
                // Get weighted fees
            } else {
                // Get fee by value
            }
        } else if ($typeOfPlate == '1-Yr Commercial Plate') {
            if ($gcvw >= 10000) {
                // Return error.
            } else {
                // return value in fees table
            }
        } else if ($typeOfPlate == '2-Yr Commercial Plate') {
            if ($gcvw >= 10000) {
                // Return error.
            } else {
                // return value in fees table
            }
        }
    }

    public function getLicenseFeeForTruck()
    {
        $typeOfPlate = '';
        $gcvw = '';

        if ($typeOfPlate == 'Truck Plate') {
            if ($gcvw >= 10000) {
                // Get weighted fees
            } else {
                // Get fee by value
            }
        } else if ($typeOfPlate == 'Farm Plate') {
            if ($gcvw >= 10000) {
                // Return error.
            } else {
                // return value in fees table
            }
        }
    }

    public function getLicenseFeeForTruckTractor()
    {
        $typeOfPlate = '';
        $gcvw = '';

        if ($typeOfPlate == 'Truck Plate') {
            if ($gcvw >= 10000) {
                // Get weighted fees
            } else {
                // Get fee by value
            }
        } else if ($typeOfPlate == 'Farm Plate') {
            if ($gcvw >= 10000) {
                // Return error.
            } else {
                // return value in fees table
            }
        }
    }

    public function getLicenseFeeForPrivateBus()
    {
        $typeOfPlate = 'Private Bus Plate';
        $gcvw = '';

        if ($typeOfPlate == 'Hire Passenger Plate') {
            // Needs number of passengers.
            $num_of_passengers = 3;
            $license_fee = $this->getVehicleFeeFromTable('LA', 'private_bus', 'hire_passenger_plate')['amount'] * $num_of_passengers;

            return $license_fee;
        } else if ($typeOfPlate == 'Private Bus Plate') {
            $license_fee = $this->getVehicleFeeFromTable('LA', 'private_bus', 'private_bus_plate')['amount'];

            return $license_fee;
        }
    }

    public function getLicenseFeeForMotorcycle()
    {
        $typeOfPlate = 'Motorcycle Plate';

        if ($typeOfPlate == 'Motorcycle Plate') {
            $license_fee = $this->getVehicleFeeFromTable('LA', 'motorcycle', 'motorcycle_plate')['amount'];

            return $license_fee;
        }
    }

    public function getLicenseFeeForOffRoadVehicle()
    {
        $typeOfPlate = 'No Plate';

        if ($typeOfPlate == 'No Plate') {
            $license_fee = $this->getVehicleFeeFromTable('LA', 'motorcycle', 'motorcycle_plate')['amount'];

            return $license_fee;
        }
    }

    public function getLicenseFeeForMotorHome()
    {
        $typeOfPlate = 'Motor Home Plate';

        if ($typeOfPlate == 'Motor Home Plate') {
            $license_fee = $this->getVehicleFeeFromTable('LA', 'motor_home', 'motor_home_plate')['amount'];

            return $license_fee;
        }
    }

    public function getLicenseFeeForTrailer()
    {
        $typeOfPlate = '4-Yr Trailer Plate';
        $typeOfPlate = 'Permanent Trailer Plate';

        if ($typeOfPlate == '1-Yr Trailer Plate') {
            $license_fee = $this->getVehicleFeeFromTable('LA', 'semi_trailer', '1_yr_trailer_plate')['amount'];

            return $license_fee;
        } else if ($typeOfPlate == '4-Yr Trailer Plate') {
            $license_fee = $this->getVehicleFeeFromTable('LA', 'semi_trailer', '4_yr_trailer_plate')['amount'];

            return $license_fee;
        } else if ($typeOfPlate == 'Permanent Trailer Plate') {
            $license_fee = $this->getVehicleFeeFromTable('LA', 'semi_trailer', 'permanent_trailer_plate')['amount'];

            return $license_fee;
        }
    }

    public function getLicenseFeeForSemiTrailer()
    {
        $typeOfPlate = '4-Yr Trailer Plate';
        $typeOfPlate = 'Permanent Trailer Plate';

        if ($typeOfPlate == '1-Yr Trailer Plate') {
            $license_fee = $this->getVehicleFeeFromTable('LA', 'semi_trailer', '1_yr_trailer_plate')['amount'];

            return $license_fee;
        } else if ($typeOfPlate == '4-Yr Trailer Plate') {
            $license_fee = $this->getVehicleFeeFromTable('LA', 'semi_trailer', '4_yr_trailer_plate')['amount'];

            return $license_fee;
        } else if ($typeOfPlate == 'Permanent Trailer Plate') {
            $license_fee = $this->getVehicleFeeFromTable('LA', 'semi_trailer', 'permanent_trailer_plate')['amount'];

            return $license_fee;
        }
    }

    public function getLicenseFeeForTravelTrailer()
    {
        $typeOfPlate = '4-Yr Trailer Plate';
        $typeOfPlate = 'Permanent Trailer Plate';

        if ($typeOfPlate == '1-Yr Trailer Plate') {
            $license_fee = $this->getVehicleFeeFromTable('LA', 'semi_trailer', '1_yr_trailer_plate')['amount'];

            return $license_fee;
        } else if ($typeOfPlate == '4-Yr Trailer Plate') {
            $license_fee = $this->getVehicleFeeFromTable('LA', 'semi_trailer', '4_yr_trailer_plate')['amount'];

            return $license_fee;
        } else if ($typeOfPlate == 'Permanent Trailer Plate') {
            $license_fee = $this->getVehicleFeeFromTable('LA', 'semi_trailer', 'permanent_trailer_plate')['amount'];

            return $license_fee;
        }
    }

    /**
     * Needs GCVWR
     */
    public function getLicenseFeeForUtilityTrailer()
    {
        $typeOfPlate = 'License Fee';
        $gcvwr = '500';

        if ($typeOfPlate == 'License Fee') {
            if ($gcvwr <= 500) {
                $license_fee = $this->getVehicleFeeFromTable('LA', 'utility_trailer', 'license_fee_plate')['amount'];
            } else {
                return "GCVWR for trailer plate must not exceed 500 LBS";
            }
        }
    }

    public function getLicenseFeeForBoatTrailer()
    {
        $typeOfPlate = 'License Fee';
        $gcvwr = '1500';

        if ($typeOfPlate == 'License Fee') {
            if ($gcvwr <= 1500) {
                $license_fee = $this->getVehicleFeeFromTable('LA', 'boat_trailer', 'license_fee_plate')['amount'];

                return $license_fee;
            } else {
                return "GCVWR for trailer plate must not exceed 1500 LBS";
            }
        }
    }

    public function getLicenseFeeForAntiquePlate()
    {
        $typeOfPlate = 'Antique Plate';
        $gcvwr = '1500';

        if ($typeOfPlate == 'Antique Plate') {
            $license_fee = $this->getVehicleFeeFromTable('LA', 'antique_vehicle', 'antique_vehicle_plate')['amount'];

            return $license_fee;
        }
    }


}