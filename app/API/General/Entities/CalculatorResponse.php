<?php

namespace Thirty98\API\General\Entities;

use Thirty98\API\General\Contracts\CalculatorResponseInterface;

class CalculatorResponse implements CalculatorResponseInterface
{
    private $fees;
    private $tax;
    private $penalties;

    public function __construct($fees = [], $tax = [], $penalties = [])
    {
        $this->fees = $fees;
        $this->tax = $tax;
        $this->penalties = $penalties;

        return $this;
    }

    /**
     * Group and return the response as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return ['fees' => $this->fees, 'tax' => $this->tax, 'penalties' => $this->penalties];
    }
}
#END OF PHP FILE