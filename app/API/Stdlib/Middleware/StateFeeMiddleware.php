<?php

namespace Thirty98\API\Stdlib\Middleware;

use Thirty98\API\Stdlib\Services\FeeService;

class StateFeeMiddleware extends AbstractPostMiddleware
{
    protected $service;

    public function __construct(FeeService $service)
    {
        $this->service = $service;
    }

    protected function updateRequest(Array $payload)
    {
        $fee_name = $payload['fee']['slug'];
        $state_name = $payload['state']['code'];

        $fee = $this->service->fetchByState($state_name, $fee_name);

        if (isset($fee['error'])) {
            $data = ['error' => $fee['error']['exception'], 'payload' => $payload];
            $message = $fee['error']['response_msg'];
            $message_code = $fee['error']['response_code'];
            return ResponseService::success($message, $data, 200, $message_code);
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