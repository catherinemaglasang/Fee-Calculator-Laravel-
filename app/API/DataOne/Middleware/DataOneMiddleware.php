<?php

namespace Thirty98\API\DataOne\Middleware;

use Thirty98\API\Stdlib\Middleware\AbstractPostMiddleware;
use Thirty98\API\DataOne\Services\DataOneService;
use Illuminate\Http\Request;
use Closure;

class DataOneMiddleware extends AbstractPostMiddleware
{
    protected $service;
    
    public function __construct(DataOneService $service)
    {
        $this->service = $service;
    }
    
    protected function updateRequest(Array $payload)
    {
        $vehicle = $this->service->getVehicleInfo($payload['vin']);
        return array_replace_recursive($payload, $this->getInfo($vehicle, $payload));
    }

    protected function postValidationRules()
    {
        return [
            'vin'           => 'required|alpha_num|min:11|max:17',
            'type'          => 'required|string',
            'category'      => 'sometimes|string',
            'fuel_type'     => 'sometimes|string|in:G,D',
            'crub_weight'   => 'sometimes|numeric',
            'msrp'          => 'sometimes|numeric',
            "state.code"    => "required|string"
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
                'fuel_type'     => $data->fuel_type,
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