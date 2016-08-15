<?php

namespace Thirty98\API\Stdlib\Middleware;

use Thirty98\API\Vehicle\Services\VehicleService;

class ZipMiddleware extends AbstractPostMiddleware
{
    protected $service;

    public function __construct(VehicleService $service)
    {
        $this->service = $service;
    }

    /**
     * Validates city and county (county can be blank)
     * @param array $payload
     * @return array
     */
    protected function updateRequest(Array $payload)
    {
        return $payload;
    }

    protected function postValidationRules()
    {
        return [
            'zip' => 'required'
        ];
    }
}