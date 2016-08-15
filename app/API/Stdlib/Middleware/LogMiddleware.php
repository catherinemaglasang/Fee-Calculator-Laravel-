<?php

namespace Thirty98\API\Stdlib\Middleware;

class LogMiddleware extends AbstractPostMiddleware
{
    protected function updateRequest(Array $payload)
    {
        $payload['state_code'] = $payload['state']['code'];

        return $payload;
    }

    protected function postValidationRules()
    {
        return [
            'log_params' => 'required',
            'status' => 'required'
        ];
    }
}