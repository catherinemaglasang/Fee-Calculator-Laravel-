<?php

namespace Thirty98\API\Stdlib\Middleware;

use Thirty98\API\Stdlib\Services\StateService;

class StateMiddleware extends AbstractPostMiddleware
{
    protected $service;
    public function __construct(StateService $service)
    {
        $this->service = $service;
    }
    
    protected function updateRequest(Array $payload)
    {
       $state = $this->service->fetchByCode($payload['state'])->first();

        if (!$state) {
            return [
                'error' => [
                    "http_code"     => 200,
                    "response_msg"  => "No data found.",
                    "response_code" => "NO_DATA_FOUND",
                    "exception"     => "No available state for {$payload['state']}"
                ]
            ];
        }

        $data = $state->toArray();
        $data['class'] = str_replace(" ", "", ucwords($data['name']));
        $payload['state'] = $data;

        return $payload;
    }

    protected function postValidationRules()
    {
        return ['state' => 'required'];
    }
}