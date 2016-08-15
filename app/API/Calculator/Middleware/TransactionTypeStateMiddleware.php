<?php

namespace Thirty98\API\Calculator\Middleware;

use Thirty98\API\Calculator\Services\TransactionTypeService;
use Thirty98\API\Stdlib\Middleware\AbstractPostMiddleware;

class TransactionTypeStateMiddleware extends AbstractPostMiddleware
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
        $type = $payload['transaction_type'];
        $state = $payload['state']['code'];

        $types = $this->service->getSingleTransactionTypeByState($state, $type);

        if(isset($types['error'])) {
            return [
                'error' => [
                    'http_code'     => 200,
                    'response_msg'  => "No data found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception"     => "No transaction type code: {$type} in the state of: {$state}"
                ]
            ];
        }

        $payload['transaction'] = $types->toArray();

        $calculations = $this->service->getFeeCalculationConfig($payload['state']['code'], $payload['transaction_type']);
        $request = array_replace_recursive($payload, $calculations);

        return $request;
    }

    protected function postValidationRules()
    {
        return [
            'transaction_type'  => 'required|string'
        ];
    }
}