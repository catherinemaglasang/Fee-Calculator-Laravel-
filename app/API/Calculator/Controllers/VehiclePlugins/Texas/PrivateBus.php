<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins\Texas;

use Thirty98\API\Calculator\Controllers\VehiclePlugins\TexasCalculator;

class PrivateBus extends TexasCalculator
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
}