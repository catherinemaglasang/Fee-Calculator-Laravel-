<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins\Texas;

use Thirty98\API\Calculator\Controllers\VehiclePlugins\TexasCalculator;

class CityBus extends TexasCalculator
{
    /**
     * Use database value 
     * 
     * @return real
     */
    public function youngFarmerFee()
    {
        return 0.00;
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