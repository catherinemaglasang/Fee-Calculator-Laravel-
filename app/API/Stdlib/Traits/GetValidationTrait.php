<?php

namespace Thirty98\API\Stdlib\Traits;

use Illuminate\Support\Facades\Validator;

trait GetValidationTrait
{
    public function getRequestValidator(Array $payload)
    {
        return Validator::make($payload, $this->getValidationRules());
    }
}