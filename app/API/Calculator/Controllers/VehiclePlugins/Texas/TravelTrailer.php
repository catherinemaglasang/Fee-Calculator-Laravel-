<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins\Texas;

use Thirty98\API\Calculator\Controllers\VehiclePlugins\TexasCalculator;

class TravelTrailer extends TexasCalculator
{
    /**
     * Not included in computation
     * 
     * @return real
     */
    public function emmisionFee($taxable_value, $fuel_type, $gvw, $model_year)
    {
        return 0.00;
    }
    
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