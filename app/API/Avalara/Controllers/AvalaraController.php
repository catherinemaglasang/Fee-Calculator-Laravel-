<?php

namespace Thirty98\API\Avalara\Controllers;

use Thirty98\API\Stdlib\Controllers\AbstractPostController;
use Thirty98\API\Stdlib\Services\ResponseService;
use Thirty98\API\Avalara\Services\AvalaraService;
use Illuminate\Http\Request;

class AvalaraController extends AbstractPostController
{
    protected $service;
    
    public function __construct(AvalaraService $service)
    {
        $this->service = $service;
    }
    
    public function verifyLocation(Request $request)
    {
        $payload = $request->all();
        
        $validator = $this->postRequestValidator($payload);
        if ($validator->fails()) {
            $response = ['errors' => $validator->errors(), 'payload' => $payload];
            return ResponseService::success("Validation failed", $response, 200, "FAILED_VALIDATION");
        }
        
        $output = $this->service->getLocation($payload['street_address'], $payload['zip']);
        if (isset($output['error'])) {
            $data = ['error' => $output['error']['exception'], 'payload' => $payload];
            $message = $output['error']['response_msg'];
            $message_code = $output['error']['response_code'];
            return ResponseService::success($message, $data, 200, $message_code);
        }
        
        $response = ['location' => $output, 'payload' => $payload];
        return ResponseService::success("Here's your location", $response);
    }
    
    
    public function postValidationRules()
    {
        return [
            "street_address"    => "required|string",
            "zip"               => "required|string"
        ];
    }
}