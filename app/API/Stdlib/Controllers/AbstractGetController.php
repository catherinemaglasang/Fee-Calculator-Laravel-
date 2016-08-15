<?php

namespace Thirty98\API\Stdlib\Controllers;

use Thirty98\Http\Controllers\Controller;
use Thirty98\API\Stdlib\Traits\GetValidationTrait;

abstract class AbstractGetController extends Controller
{
    use GetValidationTrait;
    
    /**
     * Rules that needs to be validated
     * 
     * @return Array Laravel Validation Rules
     * @see http://laravel.com/docs/5.1/validation#available-validation-rules
     */
    abstract protected function getValidationRules();
}