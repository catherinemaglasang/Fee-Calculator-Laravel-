<?php

namespace Thirty98\API\Avalara\Middleware;

use Thirty98\API\Stdlib\Middleware\AbstractPostMiddleware;
use Thirty98\API\Avalara\Services\AvalaraService;

class AvalaraMiddleware extends AbstractPostMiddleware
{
    protected $service;
    
    public function __construct(AvalaraService $service)
    {
        $this->service = $service;
    }
    
    public function updateRequest(Array $payload)
    {
        return $payload;
    }
    
    public function postValidationRules()
    {
        return [
            'state.code' => 'required|string',
        ];
    }
}