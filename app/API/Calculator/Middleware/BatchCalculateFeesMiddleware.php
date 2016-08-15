<?php

namespace Thirty98\API\Calculator\Middleware;

use Thirty98\API\Stdlib\Middleware\AbstractPostMiddleware;
use Thirty98\API\Calculator\Services\VehicleFeesService;

class BatchCalculateFeesMiddleware extends AbstractPostMiddleware
{
    protected $state;
    protected $vehicle;
    protected $vehicle_service;

    public function __construct(VehicleFeesService $vehicle)
    {
        $this->vehicle_service = $vehicle;
    }

    protected function postValidationRules()
    {
        return [
            'calc_params' => 'required'
        ];
    }

    protected function updateRequest(Array $payload)
    {
        return $payload;
    }
}