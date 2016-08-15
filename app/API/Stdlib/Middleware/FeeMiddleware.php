<?php

namespace Thirty98\API\Stdlib\Middleware;

use Thirty98\API\Stdlib\Services\FeeService;

class FeeMiddleware extends AbstractPostMiddleware
{
    protected $service;

    public function __construct(FeeService $service)
    {
        $this->service = $service;
    }

    protected function updateRequest(Array $payload)
    {
        $fee = $this->service->fetchFee($payload['fee']);

        if (isset($fee['error'])) {
            return [
                'error' => [
                    "http_code"     => 200,
                    "response_msg"  => "No data found.",
                    "response_code" => "NO_DATA_FOUND",
                    "exception"     => "No available fee for query: {$payload['fee']}"
                ]
            ];
        }

        $data = $fee;
        $payload['fee'] = $data;

        return $payload;
    }

    protected function postValidationRules()
    {
        return ['fee' => 'required'];
    }
}