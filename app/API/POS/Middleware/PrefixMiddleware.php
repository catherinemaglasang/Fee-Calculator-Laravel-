<?php

namespace Thirty98\API\POS\Middleware;

use Thirty98\API\Stdlib\Middleware\AbstractPostMiddleware;

class PrefixMiddleware extends AbstractPostMiddleware
{
    protected $pos_service;
    protected $vehicle_service;


    public function __construct()
    {

    }

    protected function updateRequest(Array $payload)
    {
        return $payload;
    }

    protected function postValidationRules()
    {
        return [
            'license_plate' => 'required|string'
        ];
    }
}
