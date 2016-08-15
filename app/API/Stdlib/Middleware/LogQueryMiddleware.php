<?php

namespace Thirty98\API\Stdlib\Middleware;

class LogQueryMiddleware extends AbstractPostMiddleware
{
    protected function updateRequest(Array $payload)
    {
        $payload['state_code'] = $payload['state']['code'];

        return $payload;
    }

    protected function postValidationRules()
    {
        return [
            'status' => 'required|in:SUCCESS,FAILURE,ALL'
        ];
    }
}