<?php

namespace Thirty98\API\General\Middleware;

use Thirty98\API\Stdlib\Services\ResponseService;
use Thirty98\API\General\Services\DataOneService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Closure;

class DataOne
{
    protected $service;
    
    public function __construct(DataOneService $service)
    {
        $this->service = $service;
    }
    
    public function handle(Request $request, Closure $next)
    {
        $payload = $request->all();
        
        $validator = $this->postRequestValidator($payload);
        if ($validator->fails()) {
            $response = ['error' => $validator->errors(), 'payload' => $payload];
            return ResponseService::success("Validation failed", $response, 200, "FAILED_VALIDATION");
        }
        
        $vehicle = $this->service->getVehicleInfo($payload['vin']);
        $request->replace(array_replace_recursive($payload, $this->getInfo($vehicle, $payload))); //update the request
        
        return $next($request);
    }
    
    public function postRequestValidator(Array $payload)
    {
        return Validator::make($payload, $this->postValidationRules());
    }
    
    private function postValidationRules()
    {
        return [
            'vin'           => 'required|alpha_num|min:17|max:17',
            'type'          => 'required|string',
            'fuel_type'     => 'sometimes|string|in:G,D',
            'crub_weight'   => 'sometimes|numeric',
            'msrp'          => 'sometimes|numeric',
            "state"         => "required|string"
        ];
    }
    
    /**
     * If retured vehicle information is only one entry, replace the current request values
     * 
     * @param Object $vehicle
     * @param Array $payload
     * @return Array
     */
    private function getInfo($vehicle, $payload)
    {
        if ($vehicle->count() === 1) {
            $data = $vehicle->first();
            return [
                'vin_pattern'   => $data->vin_pattern,
                // 'fuel_type'     => $data->fuel_type,
                'crub_weight'   => $data->crub_weight,
                'type'          => strtolower($data->vehicle_type),
                'msrp'          => $data->msrp,
                'year'          => $data->year,
                'make'          => strtolower($data->make),
                'model'         => strtolower($data->model),
                'tonnage'       => $data->tonnage,
                'category'      => strtolower($this->service->getVehicleCategory($data->vehicle_type)),
            ];
        } 
        
        return [
            'vin_pattern'   => $this->service->getVinPattern($payload['vin']),
            'category'      => strtolower($this->service->getVehicleCategory($payload['type'])),
        ];
    }
}