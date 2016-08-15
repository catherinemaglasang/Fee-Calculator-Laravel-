<?php

namespace Thirty98\API\General\Contracts;

use Thirty98\API\General\Entities\CalculatorResponse;

interface CalculatorInterface
{
    /**
     * Category-Type calculator.
     * This do the calculation depending on the category and type given.
     *
     * @return CalculatorResponse
     */
    public function calculate();
}
#END OF PHP FILE