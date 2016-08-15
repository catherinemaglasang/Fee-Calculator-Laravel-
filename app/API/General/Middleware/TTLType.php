<?php

namespace Thirty98\API\General\Middleware;

use Thirty98\API\v1\General\Services\ResponseService;
use Thirty98\API\General\Services\TTLTypeService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Closure;

class TTLType
{
    protected $service;
    
    public function __construct(TTLTypeService $service)
    {
        $this->service = $service;
    }
    
    /**
     * Filters TTL TYPE and get the Fee Calculator configuration on what taxes/fees are to be displayed
     * 
     * @param Request $request
     * @param Closure $next
     * @return Request
     */
    public function handle(Request $request, Closure $next)
    {
        $payload = $request->all();
        
        $validator = $this->postRequestValidator($payload);
        if ($validator->fails()) {
            $response = ['error' => $validator->errors(), 'payload' => $payload];
            return ResponseService::success("Validation failed", $response, 200, "FAILED_VALIDATION");
        }
        
        if(!$this->service->fetchByCode($payload['ttl_type'])) {
            $response = ['error' => "No ttl type code: {$payload['ttl_type']}", 'payload' => $payload];
            return ResponseService::success("NO TTL TYPE FOUND", $response, 200, "DATA_NOT_FOUND");
        }
        
        $calculations = $this->service->getFeeCalculationConfig($payload['state'], $payload['ttl_type']);
        $request->replace(array_replace_recursive($payload, $calculations));
        
        return $next($request);
    }
    
    public function postRequestValidator(Array $payload)
    {
        return Validator::make($payload, $this->postValidationRules());
    }
    
    private function postValidationRules()
    {
        return [
            'state'         => 'required|string',
            'ttl_type'      => 'required|string',
        ];
    }
}
