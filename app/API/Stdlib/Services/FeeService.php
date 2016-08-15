<?php

namespace Thirty98\API\Stdlib\Services;
use Thirty98\Models\Fee;
use Thirty98\Models\StateVehicleFee;
use Thirty98\Models\StateVehicleTypeFee;

class FeeService
{
    protected $fee_model;
    protected $state_fee_model;
    protected $state_vehicle_type_fee_model;

    public function __construct(Fee $fee, StateVehicleFee $state_fee, StateVehicleTypeFee $state_vehicle_type_fee)
    {
        $this->fee_model = $fee;
        $this->state_fee_model = $state_fee;
        $this->state_vehicle_type_fee_model = $state_vehicle_type_fee;
    }

    public function fetchFee($fee)
    {
        $data = $this->fee_model->where('slug', $fee)->first();

        if (!$data) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No fee found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No fee found for fee query: {$fee}"
                ]
            ];
        }

        return $data;
    }

    public function fetchByState($state, $fee)
    {
        $data = $this->state_fee_model->join('fees', 'fees.id', '=', 'fee_id')
            ->where('state_code', $state)
            ->where('fees.slug', $fee)
            ->first();

        if (!$data) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No state fee found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No fee found for fee query: {$fee} in the state of {$state}"
                ]
            ];
        }

        return $data;
    }

    public function fetchFeeByStateAndVehicleType($state, $vehicleType)
    {
        $data = $this->state_vehicle_type_fee_model->join('state_vehicle_fees', 'state_vehicle_fees.id', '=', 'state_vehicle_fee_id')
            ->join('fees', 'fees.id', '=', 'state_vehicle_fees.fee_id')
            ->join('state_vehicle_types', 'state_vehicle_types.id', '=', 'state_vehicle_type_id')
            ->join('vehicle_types', 'vehicle_types.id', '=', 'state_vehicle_types.vehicle_type_id')
            ->where('vehicle_types.slug', $vehicleType)
            ->where('state_vehicle_types.state_code', $state)
            ->where('state_vehicle_fees.state_code', $state)
            ->select('fees.slug')
            ->get();

        if (!$data) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No fees found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No fees found for vehicle: {$vehicleType} in the state of {$state}"
                ]
            ];
        }

        return $data;
    }
}
