<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins\Texas;

use Thirty98\API\Calculator\Controllers\VehiclePlugins\TexasCalculator;

class CombinationTruck extends TexasCalculator
{
    /**
     * 10% X REG_FEE
     * 
     * @return real
     */
    public function emmisionSurcharge()
    {
        return $this->licenseFee() * 0.1;
    }
    

}