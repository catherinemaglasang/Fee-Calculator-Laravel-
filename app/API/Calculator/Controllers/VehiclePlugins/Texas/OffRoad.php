<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins\Texas;

use Thirty98\API\Calculator\Controllers\VehiclePlugins\TexasCalculator;

class OffRoad extends TexasCalculator
{
    /**
     * Not included
     * 
     * @return real
     */
    public function regDpsFee()
    {
        return 0.00;
    }
    
    /**
     * Not included
     * 
     * @return real
     */
    public function automateFee()
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
    
    /**
     * No registration
     * 
     * @return real
     */
    public function licenseFee($taxable_amount = 0)
    {
        return 0.00;
    }
}