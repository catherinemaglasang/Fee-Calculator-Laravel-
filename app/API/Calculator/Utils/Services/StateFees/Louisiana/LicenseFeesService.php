<?php

namespace Thirty98\API\Calculator\Utils\Services\StateFees\Louisiana;

use Thirty98\API\Calculator\Utils\Contracts\StateFees\LicenseFeeServiceInterface;
use Thirty98\API\Calculator\Utils\Services\StateFees\AbstractLicenseFeesService;
use Thirty98\API\Calculator\Services\VehicleFeesService;
use Thirty98\API\Vehicle\Services\VehicleService;

class LicenseFeesService extends AbstractLicenseFeesService implements LicenseFeeServiceInterface
{
    protected $state = 'LA';


    public function __construct($details)
    {
        parent::__construct($details, $details['services']['Fee Service']);
    }

    public function getLicenseFees()
    {
        $license_fees = parent::getLicenseFees();
        $license_fees['license_transfer_fee'] = $this->getLicenseTransferFee();

        return $license_fees;
    }

    /**
     * LA License Fee params
     * vehicle_type
     * type_of_plate
     * gvw
     * farm_use
     */

    /**
     * return [
     * 'error' => [
     * 'http_code' => 200,
     * 'response_msg' => "No vehicle types fee found",
     * 'response_code' => "NO_DATA_FOUND",
     * "exception" => "No vehicle types found for vehicle: {$vehicleType} in the state of {$state} with a fee of {$fee}"
     * ]
     * ];
     */
    protected function getLicenseFee()
    {
        $vehicle_type = $this->details['vehicle_type']['slug'];
        $state = $this->details['state']['code'];
        $farm_use = $this->details['farm_use'];
        $gvw = floatval(str_replace(',', '', $this->details['gvw']));
        $taxable_value = $this->details['taxable_value'];
        $date_of_sale = $this->details['date_of_sale'];
        $license_fee = '';
        $type_of_plate = $this->details['type_of_plate'];
        $bus_passengers = isset($this->details['bus_passengers']) ? intval($this->details['bus_passengers']) : 0;

        $weight_fees_model = new VehicleService();

        if ($vehicle_type == 'car' || $vehicle_type == 'van' || $vehicle_type == 'suv') {
            if ($gvw >= 10000) {
                // Fetch by weight.
                $license_fee = $weight_fees_model->getWeightedCalculation($state, $vehicle_type, $date_of_sale, $gvw, $farm_use);
            } else {
                $license_fee = (round(($taxable_value - 10000) * .001) * 2) + 20;
            }
        } else if ($vehicle_type == 'truck' || $vehicle_type == 'truck_tractor') {
            $license_fee = $weight_fees_model->getWeightedCalculation($state, $vehicle_type, $date_of_sale, $gvw, $farm_use);
        } else if ($vehicle_type == 'motorcycle') {
            $license_fee = $this->model->getVehicleFeeByState($state, $vehicle_type, 'motorcycle_plate');
        } else if ($vehicle_type == 'off_road_vehicle') {
            $license_fee = $this->model->getVehicleFeeByState($state, $vehicle_type, 'no_plate');
        } else if ($vehicle_type == 'antique_vehicle') {
            $license_fee = $this->model->getVehicleFeeByState($state, $vehicle_type, 'antique_plate');
        } else if ($vehicle_type == 'boat_trailer') {
            if ($gvw > 0 && $gvw <= 1500) {
                $license_fee = $this->model->getVehicleFeeByState($state, $vehicle_type, 'boat_trailer_plate');
            } else {
                return [
                    'error' => [
                        'http_code' => 200,
                        'response_msg' => "Weight should not exceed 1500 and must be above 0 for boat trailer",
                        'response_code' => "WEIGHT_ERROR",
                        "exception" => "Weight condition satisfied for Boat Trailer Plate. Weight provided: {$gvw}"
                    ]
                ];
            }
        } else if ($vehicle_type == 'utility_trailer') {
            if ($gvw > 0 && $gvw <= 500) {
                $license_fee = $this->model->getVehicleFeeByState($state, $vehicle_type, 'trailer_plate');
            } else {
                return [
                    'error' => [
                        'http_code' => 200,
                        'response_msg' => "Weight should not exceed 500 and must be above 0 for utility trailer",
                        'response_code' => "WEIGHT_ERROR",
                        "exception" => "Weight condition satisfied for Utility Trailer Plate. Weight provided: {$gvw}"
                    ]
                ];
            }
        } else if ($vehicle_type == 'trailer' || $vehicle_type == 'travel_trailer' || $vehicle_type == 'semi_trailer') {
            if ($type_of_plate == '1_yr_trailer_plate') {
                $license_fee = $this->model->getVehicleFeeByState($state, $vehicle_type, '1_yr_trailer_plate');
            } else if ($type_of_plate == '4_yr_trailer_plate') {
                $license_fee = $this->model->getVehicleFeeByState($state, $vehicle_type, '4_yr_trailer_plate');
            } else if ($type_of_plate == 'permanent_trailer_plate') {
                $license_fee = $this->model->getVehicleFeeByState($state, $vehicle_type, 'permanent_trailer_plate');
            }
        } else if ($vehicle_type == 'private_bus') {
            if ($type_of_plate == 'hire_passenger_plate') {
                $license_fee = $this->model->getVehicleFeeByState($state, $vehicle_type, 'hire_passenger_plate');
                $license_fee = $license_fee * $bus_passengers;
            } else if ($type_of_plate == 'private_bus_plate') {
                $license_fee = $this->model->getVehicleFeeByState($state, $vehicle_type, 'private_bus_plate');
            }
        }

        return $license_fee;
    }

    protected function getLicenseTransferFee()
    {
        $vehicle_type = $this->details['vehicle_type']['slug'];
        $transaction_type = $this->details['transaction_type'];

        if ($transaction_type != "TP") {
            return 0;
        }

        return $this->model->getVehicleFeeByState($this->state, $vehicle_type, 'license_transfer_fee');
    }


}
