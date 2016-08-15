<?php

namespace Thirty98\API\Calculator\Controllers;

use Thirty98\API\Stdlib\Controllers\AbstractPostController;
use Thirty98\API\Stdlib\Services\ResponseService;

class CalculatorOptionController extends AbstractPostController
{
    protected function postValidationRules()
    {
        return [];
    }
}