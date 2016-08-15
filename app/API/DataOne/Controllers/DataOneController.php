<?php

namespace Thirty98\API\DataOne\Controllers;

use Thirty98\API\Stdlib\Controllers\AbstractPostController;
use Thirty98\API\DataOne\Services\DataOneService;
use Thirty98\API\Stdlib\Services\ResponseService;
use Illuminate\Http\Request;

class DataOneController extends AbstractPostController
{
    protected $service;
    
    public function __construct(DataOneService $service)
    {
        $this->service = $service;
    }
    
    public function vinPattern(Request $request)
    {
        $payload = $request->all();
        $validator = $this->postRequestValidator($payload);
        if ($validator->fails()) {
            $response = ['errors' => $validator->errors(), 'payload' => $payload];
            return ResponseService::success("Validation failed", $response, 200, "FAILED_VALIDATION");
        }
        
        $response = ['vin_pattern' => $this->service->getVinPattern($payload['vin']), 'payload' => ['vin' => $payload['vin']]];
        return ResponseService::success("Here's the vin pattern", $response);
    }
    
    
    public function vehicleInfo(Request $request)
    {
        $payload = $request->all();
        
        $validator = $this->postRequestValidator($payload);
        if ($validator->fails()) {
            $response = ['errors' => $validator->errors(), 'payload' => $payload];
            return ResponseService::success("Validation failed", $response, 200, "FAILED_VALIDATION");
        }
        
        $output = $this->service->getVehicleInfo($payload['vin']);
        if (isset($output['error'])) {
            $data = ['error' => $output['error']['exception'], 'payload' => $payload];
            $message = $output['error']['response_msg'];
            $message_code = $output['error']['response_code'];
            return ResponseService::success($message, $data, 200, $message_code);
        }
        
        $dataone = $this->service->mappingCorrections($output);
        
        if (isset($payload['state'])) {
            $output = $this->service->correctVehicleTypeMapping($dataone, $payload['state']);
        } else {
            $output = $dataone;
        }
        
        $data = json_decode(json_encode($output), true);
        $response = ['vehicles' => $data, 'payload' => array_merge($payload, $dataone)];
        return ResponseService::success("Here's the vehicle(s)", $response);
    }
    
    public function getBodyTypes()
    {
        $output = $this->service->getVehicleStyles();
        if (isset($output['error'])) {
            $data = ['error' => $output['error']['exception'], 'payload' => $payload];
            $message = $output['error']['response_msg'];
            $message_code = $output['error']['response_code'];
            return ResponseService::success($message, $data, 200, $message_code);
        }
        
        return ResponseService::success("Here's the body type(s)", ['body_types' => $output]);
    }


    protected function postValidationRules()
    {
        return [
            'vin' => 'required|alpha_num|min:17|max:17'
        ];
    }
}