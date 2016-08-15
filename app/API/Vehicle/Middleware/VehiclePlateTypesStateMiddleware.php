<?php

namespace Thirty98\API\Vehicle\Middleware;

use Thirty98\API\Stdlib\Middleware\AbstractPostMiddleware;
use Thirty98\API\Vehicle\Services\VehicleService;

class VehiclePlateTypesStateMiddleware extends AbstractPostMiddleware
{
    public function __construct(VehicleService $service)
    {
        $this->service = $service;
    }

    protected function updateRequest(Array $payload)
    {
        $state_code = $payload['state']['code'];

        if($state_code == 'LA') {
            $vehicle_type = $payload['vehicle_type']['slug'];
            $type_of_plate = $payload['type_of_plate'];

            $output = $this->service->fetchPlateTypeByVehicleAndState($state_code, $vehicle_type, $type_of_plate);

            if(isset($output['error'])) {
                return $output;
            }
        }

        return $payload;
    }

    protected function postValidationRules()
    {
        return [
            'type_of_plate' => 'required_if:state.code,LA'
        ];
    }
}