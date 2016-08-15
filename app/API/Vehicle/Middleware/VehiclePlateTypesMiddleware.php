<?php

namespace Thirty98\API\Vehicle\Middleware;

use Thirty98\API\Stdlib\Middleware\AbstractPostMiddleware;
use Thirty98\API\Vehicle\Services\VehicleService;

class VehiclePlateTypesMiddleware extends AbstractPostMiddleware
{
    public function __construct(VehicleService $service)
    {
        $this->service = $service;
    }

    protected function postValidationRules()
    {
        return [
            'type_of_plate' => 'required_if:state.code,LA'
        ];
    }

    protected function updateRequest(Array $payload)
    {
        $state_code = $payload['state']['code'];

        if($state_code == 'LA') {
            $output = $this->service->getPlateTypeByName($payload['type_of_plate']);

            if(isset($output['error'])) {
                return $output;
            }
        }

        return $payload;
    }
}