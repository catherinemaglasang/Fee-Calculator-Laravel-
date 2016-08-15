<?php

namespace Thirty98\API\Stdlib\Controllers;

use Illuminate\Http\Request;
use Thirty98\API\Stdlib\Services\ResponseService;
use Thirty98\API\Stdlib\Services\StateService;

class StateController extends AbstractGetController
{
    /**
     * @var Thirty98\API\Stdlib\Services\StateService 
     */
    protected $state;
    
    public function __construct(StateService $state)
    {
        $this->state = $state;
    }
    
    public function getVehicleTypes($state_code)
    {
        $payload = ['state' => $state_code];
        
        $output = $this->state->getVehicleTypes(strtoupper($state_code));
        
        if (isset($output['error'])) {
            $data = ['error' => $output['error']['exception'], 'payload' => $payload];
            $message = $output['error']['response_msg'];
            $message_code = $output['error']['response_code'];
            return ResponseService::success($message, $data, 200, $message_code);
        }
        
        $response = ['vehicle_types' => $output, 'payload' => $payload];
        return ResponseService::success("Here's your data", $response);
    }
    
    
    public function getVehicleBodyTypes(Request $request)
    {
        $payload = $request->all();
        $state_code = $payload['state']['code'];
        $vehicle_type = $payload['vehicle_type']['slug'];

        $output = $this->state->getVehicleBodyTypes(strtoupper($state_code), $vehicle_type);
        
        if (isset($output['error'])) {
            $data = ['error' => $output['error']['exception'], 'payload' => $payload];
            $message = $output['error']['response_msg'];
            $message_code = $output['error']['response_code'];
            return ResponseService::success($message, $data, 200, $message_code);
        }
        
        $response = ['vehicle_body_types' => $output, 'payload' => $payload];
        return ResponseService::success("Here's your data", $response);
    }
    
    public function getVehicleColors($state_code)
    {
        $payload = ['state' => $state_code];
        
        $output = $this->state->getVehicleColors($payload['state']);
        
        if (isset($output['error'])) {
            $data = ['error' => $output['error']['exception'], 'payload' => $payload];
            $message = $output['error']['response_msg'];
            $message_code = $output['error']['response_code'];
            return ResponseService::success($message, $data, 200, $message_code);
        }
        
        $response = ['vehicle_colors' => $output, 'payload' => $payload];
        return ResponseService::success("Here's your data", $response);
    }
    
    public function getStateCountyCities($state_code, $county_code)
    {
        $payload = [
            'state_code'    => $state_code,
            'county_code'   => $county_code
        ];
        
        
        $output = $this->state->getCities(strtoupper($state_code), $county_code);
        
        if (isset($output['error'])) {
            $data = ['error' => $output['error']['exception'], 'payload' => $payload];
            $message = $output['error']['response_msg'];
            $message_code = $output['error']['response_code'];
            return ResponseService::success($message, $data, 200, $message_code);
        }
        
        $response = ['cities' => $output, 'payload' => $payload];
        return ResponseService::success("Here's your data", $response);
    }
    
    public function getInspectionTypes($state_code)
    {
        $payload = ['state' => $state_code];
        
        $output = $this->state->getInspectionTypes($payload['state']);
        
        if (isset($output['error'])) {
            $data = ['error' => $output['error']['exception'], 'payload' => $payload];
            $message = $output['error']['response_msg'];
            $message_code = $output['error']['response_code'];
            return ResponseService::success($message, $data, 200, $message_code);
        }
        
        $response = ['inspection_types' => $output, 'payload' => $payload];
        return ResponseService::success("Here's your data", $response);
    }
    
    public function getSalesTax($state_code)
    {
        $payload = ['state' => $state_code];
        
        $output = $this->state->getSalesTax($payload['state']);
        
        if (isset($output['error'])) {
            $data = ['error' => $output['error']['exception'], 'payload' => $payload];
            $message = $output['error']['response_msg'];
            $message_code = $output['error']['response_code'];
            return ResponseService::success($message, $data, 200, $message_code);
        }
        
        $response = ['sales_tax' => $output, 'payload' => $payload];
        return ResponseService::success("Here's your data", $response);
    }
    
    public function getSalesTaxExempt($state_code)
    {
        $payload = ['state' => $state_code];
        
        $output = $this->state->getSalesTaxExempt($payload['state']);
        
        if (isset($output['error'])) {
            $data = ['error' => $output['error']['exception'], 'payload' => $payload];
            $message = $output['error']['response_msg'];
            $message_code = $output['error']['response_code'];
            return ResponseService::success($message, $data, 200, $message_code);
        }
        
        $response = ['sales_tax_exempt' => $output, 'payload' => $payload];
        return ResponseService::success("Here's your data", $response);
    }
    
    public function getVehicleOwnership($state_code)
    {
        $payload = ['state' => $state_code];
        
        $output = $this->state->getVehicleOwnershipByState($payload['state']);
        
        if (isset($output['error'])) {
            $data = ['error' => $output['error']['exception'], 'payload' => $payload];
            $message = $output['error']['response_msg'];
            $message_code = $output['error']['response_code'];
            return ResponseService::success($message, $data, 200, $message_code);
        }
        
        $response = ['ownership_evidence' => $output, 'payload' => $payload];
        return ResponseService::success("Here's your data", $response);
    }
    
    
    public function getFuelTypes($state_code)
    {
        $payload = ['state' => $state_code];
        
        $output = $this->state->getFuelTypesByState($payload['state']);
        
        if (isset($output['error'])) {
            $data = ['error' => $output['error']['exception'], 'payload' => $payload];
            $message = $output['error']['response_msg'];
            $message_code = $output['error']['response_code'];
            return ResponseService::success($message, $data, 200, $message_code);
        }
        
        $response = ['fuel_types' => $output, 'payload' => $payload];
        return ResponseService::success("Here's your data", $response);
    }

    public function getValidationRules()
    {
        return [];
    }
}
