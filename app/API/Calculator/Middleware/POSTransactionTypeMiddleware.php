<?php

namespace Thirty98\API\Calculator\Middleware;

use Thirty98\API\Calculator\Services\TransactionTypeService;
use Thirty98\API\Stdlib\Middleware\AbstractPostMiddleware;

class POSTransactionTypeMiddleware extends AbstractPostMiddleware
{
    protected $service;

    public function __construct(TransactionTypeService $service)
    {
        $this->service = $service;
    }

    public function updateRequest(Array $payload)
    {
        if ($payload['state']['code'] === "LA") {
            $pos_transaction_types = [
                "QT33",
                "QT41",
                "QT51V",
                "QT51LP",
                "QT61",
                "QT62",
                "TT11",
                "TT19",
                "TT21",
                "TT24",
                "TT25",
                "TT25ST",
                "TT28",
                "TT29",
                "TT57",
                "TT60",
                "TT64",
                "TT65",
            ];

            if (!in_array($payload['pos_transaction_type'], $pos_transaction_types)) {
                return [
                    'error' => [
                        'http_code' => 200,
                        'response_msg' => "No data found",
                        'response_code' => "NO_DATA_FOUND",
                        "exception" => "No pos transaction type code: {$payload['pos_transaction_type']}"
                    ]
                ];
            }
        }

        // Mortgage fee no longer required.
        $payload['mortgage_fee'] = 15.00;

        if ($this->payload['pos_transaction_type'] === "TT64" || $this->payload['pos_transaction_type'] === "TT65") {
            $payload['no_fees'] = true;
            $payload['exempt_from_sales_tax'] = true;
        } else {

        }

        return $payload;
    }

    protected function postValidationRules()
    {
        return [
            'pos_transaction_type' => 'required|string'
        ];
    }
}