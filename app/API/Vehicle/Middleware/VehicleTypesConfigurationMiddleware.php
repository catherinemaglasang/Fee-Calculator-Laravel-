<?php

namespace Thirty98\API\Vehicle\Middleware;

use Thirty98\API\Stdlib\Middleware\AbstractPostMiddleware;
use Thirty98\API\Stdlib\Services\ResponseService;
use Thirty98\API\Vehicle\Services\VehicleService;

class VehicleTypesConfigurationMiddleware extends AbstractPostMiddleware
{
    public function __construct(VehicleService $service)
    {
        $this->service = $service;
    }

    protected function postValidationRules()
    {
        return [

        ];
    }

    protected function updateRequest(Array $payload)
    {
        if (isset($payload['vehicle_type'])) {
            if($payload['vehicle_type'] != "") {
                $output = $this->service->fetchByVehicleByStateAndType($payload['state']['code'], $payload['vehicle_type']);

                if (isset($output['error'])) {
                    return [
                        'error' => [
                            "http_code" => 200,
                            "response_msg" => "No data found.",
                            "response_code" => "NO_DATA_FOUND",
                            "exception" => "No vehicle type: {$payload['vehicle_type']}"
                        ]
                    ];
                }

                return array_merge($payload, ['vehicle_type' => $output]);
            } else {
                return $payload;
            }
        } else {
            return $payload;
        }
    }
}