<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins\Texas;

use Thirty98\API\Calculator\Controllers\VehiclePlugins\TexasCalculator;

class PickupTruckOverTon extends TexasCalculator
{
    public function licenseFee($taxable_value = 0)
    {
        $fee = parent::licenseFee($taxable_value);
        
        if ($this->params['farm_ranch'] === true) {
            return $fee * 0.5;
        }
        
        return $fee;
    }
    
    /**
     * Manual Computation
     * 
     * @return real
     */
    public function dieselFee()
    {
        $weight = intval(str_replace(",", '', $this->params['gvw']));
        
        if ($weight > 18000) {
            return parent::licenseFee() * 0.11;
        }

        return 0.00;
    }
}