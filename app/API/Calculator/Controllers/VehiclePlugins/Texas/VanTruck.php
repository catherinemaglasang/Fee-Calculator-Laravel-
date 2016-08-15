<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins\Texas;

use Thirty98\API\Calculator\Controllers\VehiclePlugins\TexasCalculator;

class VanTruck extends TexasCalculator
{
    public function licenseFee($taxable_value = 0)
    {
        $fee = parent::licenseFee($taxable_value);
        
        if ($this->params['farm_ranch'] === true) {
            return $fee * 0.5;
        }
        
        return $fee;
    }
}