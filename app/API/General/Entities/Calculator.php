<?php

namespace Thirty98\API\General\Entities;

use Thirty98\API\General\Contracts\CalculatorInputInterface;
use Thirty98\API\General\Contracts\CalculatorInterface;

class Calculator implements CalculatorInterface
{
    protected $calculatorInput;

    public function __construct(CalculatorInputInterface $calculatorInput)
    {
        $this->calculatorInput = $calculatorInput;
    }

    /**
     * Category-Type calculator.
     * This do the calculation depending on the category and type given.
     *
     * @return CalculatorResponse
     */
    public function calculate()
    {
        // TODO: Hey, I'm doing nothing. Make me work!
    }
}