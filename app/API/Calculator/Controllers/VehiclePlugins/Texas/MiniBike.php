<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins\Texas;

use Thirty98\API\Calculator\Controllers\VehiclePlugins\TexasCalculator;

class MiniBike extends TexasCalculator
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

    public function salesTax($taxable_amount, $sales_tax_rate)
    {
        $avalara = new Avalara();
        $county_name = County::where('code', $this->params['processing_county'])->first()->name;

        return $avalara->salesTaxRate($county_name, $taxable_amount)['Tax'];
    }
}