<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins\Texas;

use Thirty98\API\Calculator\Controllers\VehiclePlugins\TexasCalculator;

class CollectorVehicle extends TexasCalculator
{
    /**
     * Not included
     * 
     * @return real
     */
    public function youngFarmerFee()
    {
        return 0.00;
    }
}