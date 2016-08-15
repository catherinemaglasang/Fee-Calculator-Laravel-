<?php

namespace Thirty98\API\Calculator\Services;

use Thirty98\Models\StateVehicleTypeFee;

class VehicleFeesService
{
    protected $model;

    public function __construct()
    {
        $this->model = new StateVehicleTypeFee();
    }

    /**
     * Fetches a fee based on state, vehicle type and fee name.
     */
    public function getVehicleFeeByState($state, $vehicleType, $fee)
    {
        /*$arr = json_encode(
            [
                'state' => $state,
                'vehicle Type' => $vehicleType,
                'fee' => $fee
            ]
        );

        die($arr);*/

        $data = $this->model->join('state_vehicle_types', 'state_vehicle_types.id', '=', 'state_vehicle_type_id')
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
                    'response_msg' => "No fee found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No fee: {$fee} found for vehicle: {$vehicleType} in the state of {$state}"
                ]
            ];
        }

        return $data->amount;
    }
}