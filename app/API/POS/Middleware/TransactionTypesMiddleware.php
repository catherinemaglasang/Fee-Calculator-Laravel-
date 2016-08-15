<?php

namespace Thirty98\API\POS\Middleware;

use Thirty98\API\POS\Services\POSService;
use Thirty98\API\Stdlib\Middleware\AbstractPostMiddleware;

class TransactionTypesMiddleware extends AbstractPostMiddleware
{
    protected $service;

    public function __construct(POSService $service)
    {
        $this->service = $service;
    }

    protected function updateRequest(Array $payload)
    {
        $response = $this->service->getTransactionType($payload['pos_transaction_type']);

        if(isset($response['error'])) {
            return $response;
        }

        return $payload;
    }

    public function postValidationRules()
    {
        return [
            "pos_transaction_type" => "required|string"
        ];
    }
}
