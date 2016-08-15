<?php

namespace Thirty98\API\Calculator\Controllers;

use Thirty98\API\Calculator\Services\TransactionTypeService;
use Thirty98\API\Stdlib\Controllers\AbstractPostController;
use Thirty98\API\Stdlib\Services\ResponseService;
use Illuminate\Http\Request;

class TransactionTypeController extends AbstractPostController
{
    protected $service;
    
    public function __construct(TransactionTypeService $service)
    {
        $this->service = $service;
    }
    
    public function getTypes()
    {
        $data = $this->service->fetchAll();
        if (is_array($data) && count($data) > 0) {
            $response = ['errors' => "No available transaction types"];
            return ResponseService::success("No data found", $response, 200, "NO_DATA_FOUND");
        }
        
        $response = ['transaction_types' => $data->toArray()];
        return ResponseService::success("Following are the transaction types available", $response);
    }
    
    public function postStateTypes(Request $request)
    {
        $payload = $request->all();
        
        $validator = $this->postRequestValidator($payload);
        if ($validator->fails()) {
            $response = ['errors' => $validator->errors(), 'payload' => $payload];
            return ResponseService::success("Validation failed", $response, 200, "FAILED_VALIDATION");
        }
        
        $output = $this->service->getTransactionTypesByState($payload['state']['code']);
        if (isset($output['error'])) {
            $data = ['error' => $output['error']['exception'], 'payload' => $payload];
            $message = $output['error']['response_msg'];
            $message_code = $output['error']['response_code'];
            return ResponseService::success($message, $data, 200, $message_code);
        }
        
        $response = ['transaction_types' => $output, 'payload' => $payload];
        return ResponseService::success("Here are the transaction types ", $response);
    }

    public function postRules(Request $request)
    {
        $payload = $request->all();
    }
    
    protected function postValidationRules()
    {
        return [
//            "transaction_type"  => "required|string",
            "state.code"        => "required_if:state,array|string"
        ];
    }
}