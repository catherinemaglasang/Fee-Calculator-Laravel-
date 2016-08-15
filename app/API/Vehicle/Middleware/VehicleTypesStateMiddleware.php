<?php

namespace Thirty98\API\Vehicle\Middleware;

use Thirty98\API\Stdlib\Middleware\AbstractPostMiddleware;
use Thirty98\API\Vehicle\Services\VehicleService;

class VehicleTypesStateMiddleware extends AbstractPostMiddleware
{
    public function __construct(VehicleService $service)
    {
        $this->service = $service;
    }

    protected function postValidationRules()
    {
        return [
            'state.code' => 'required|string',
            'vehicle_type.slug' => 'required|string',
        ];
    }

    protected function updateRequest(Array $payload)
    {
        $state = $payload['state']['code'];
        $vehicle_type = $payload['vehicle_type']['slug'];

        if ($state === "LA") {
            $pos_vehicles = ["car", "bus", "motorcycle", "off_road_motorcycle", "trailer", "truck"];

            if (!in_array($vehicle_type, $pos_vehicles)) {
                return [
                    'error' => [
                        "http_code" => 200,
                        "response_msg" => "No data found.",
                        "response_code" => "NO_DATA_FOUND",
                        "exception" => "No vehicle type: {$vehicle_type} in the state of {$payload['state']['code']}"
                    ]
                ];
            }

            $output = $this->service->fetchByVehicleByStateAndType($payload['state']['code'], $vehicle_type);

            if (isset($output['error'])) {
                return [
                    'error' => [
                        "http_code" => 200,
                        "response_msg" => "No data found.",
                        "response_code" => "NO_DATA_FOUND",
                        "exception" => "No vehicle type: {$vehicle_type} in the state of {$payload['state']['code']}"
                    ]
                ];
            }
        } else if ($state === "TX") {
            $output = $this->service->fetchByVehicleByStateAndType($payload['state']['code'], $vehicle_type);

            if (isset($output['error'])) {
                return [
                    'error' => [
                        "http_code" => 200,
                        "response_msg" => "No data found.",
                        "response_code" => "NO_DATA_FOUND",
                        "exception" => "No vehicle type: {$vehicle_type} in the state of {$payload['state']['code']}"
                    ]
                ];
            }
        }

        return array_merge(['vehicles' => $output], $payload);
    }
}