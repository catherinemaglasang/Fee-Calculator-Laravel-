<?php

namespace Thirty98\Http\Controllers\Calculations;

use Thirty98\Http\Requests\Validators\LouisianaRequestValidator;
use Thirty98\Http\Controllers\Controller;

class
LouisianaCalculationsController extends Controller
{
    public function mainCalculations(LouisianaRequestValidator $request)
    {
        $input = $request->all();

        return $input;
    }
}
