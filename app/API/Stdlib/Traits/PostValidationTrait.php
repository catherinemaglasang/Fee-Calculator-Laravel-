<?php

namespace Thirty98\API\Stdlib\Traits;

use Illuminate\Support\Facades\Validator;

trait PostValidationTrait
{
    public function postRequestValidator(Array $payload)
    {
        return Validator::make($payload, $this->postValidationRules());
    }
}