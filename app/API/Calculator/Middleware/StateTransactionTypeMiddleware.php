<?php

namespace Thirty98\API\Calculator\Middleware;

use Thirty98\API\Calculator\Services\TransactionTypeService;
use Thirty98\API\Stdlib\Middleware\AbstractPostMiddleware;

class StateTransactionTypeMiddleware extends AbstractPostMiddleware
{
    protected $service;
    
    public function __construct(TransactionTypeService $service)
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
    public function updateRequest(Array $payload)
    {
        $state = $payload['state']['code'];
        
        $data = $this->service->getStateTransactionTypes($state);
        
        if(emptyArray($data)) {
            return [
                'error' => [
                    'http_code'     => 200,
                    'response_msg'  => "No data found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception"     => "No transaction types for {$payload['state']['name']}"
                ]
            ];
        }
        
        $payload['transaction_types'] = $data->toArray();
        //unset($payload['transaction_type']);

        return $payload;        
    }
    
    protected function postValidationRules()
    {
        return [
//            'transaction.code'  => 'required_if:transaction,array|string'            
        ];
    }
}