<?php

namespace Thirty98\API\Calculator\Middleware;

use Thirty98\API\Calculator\Services\TransactionTypeService;
use Thirty98\API\Stdlib\Middleware\AbstractPostMiddleware;

class TransactionTypeConfigurationMiddleware extends AbstractPostMiddleware
{
    protected $service;

    public function __construct(TransactionTypeService $service)
    {
        $this->service = $service;
    }

    /**
     * Filters TTL TYPE and get the Fee Calculator configuration on what taxes/fees are to be displayed
     * If configuration, it only check's if the transaction type exists.
     *
     * @param Request $request
     * @param Closure $next
     * @return Request
     */
    public function updateRequest(Array $payload)
    {
        if (isset($payload['transaction_type'])) {

            if($payload['transaction_type'] != "") {
                $type = $payload['transaction_type'];
                $types = $this->service->getType($type);

                if (isset($types['error'])) {
                    return [
                        'error' => [
                            'http_code' => 200,
                            'response_msg' => "No data found",
                            'response_code' => "NO_DATA_FOUND",
                            "exception" => "No transaction type code: {$type}"
                        ]
                    ];
                }

                $payload['transaction'] = $types;

                $calculations = $this->service->getFeeCalculationConfig($payload['state']['code'], $payload['transaction_type']);
                $request = array_replace_recursive($payload, $calculations);

                return $request;
            } else {
                return $payload;
            }


        } else {
            return $payload;
        }
    }

    protected function postValidationRules()
    {
        return [];
    }
}