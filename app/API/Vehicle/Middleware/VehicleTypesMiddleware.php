<?php

namespace Thirty98\API\Vehicle\Middleware;

use Thirty98\API\Stdlib\Middleware\AbstractPostMiddleware;
use Thirty98\API\Vehicle\Services\VehicleService;

class VehicleTypesMiddleware extends AbstractPostMiddleware
{
    public function __construct(VehicleService $service)
    {
        $this->service = $service;
    }

    protected function postValidationRules()
    {
        return [
            'state.code'    => 'required|string',
            'vehicle_type'  => 'required|string',
        ];
    }

    protected function updateRequest(Array $payload)
    {
        $output = $this->service->fetchVehicle($payload['vehicle_type']);
        
        if(isset($output['error'])) {
            return [
                'error' => [
                    "http_code"     => 200,
                    "response_msg"  => "No data found.",
                    "response_code" => "NO_DATA_FOUND",
                    "exception"     => "No vehicle type: {$payload['vehicle_type']}"
                ]
            ];
        }

        return array_merge($payload, ['vehicle_type' => $output]);
    }
}