<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins\Texas;

use Thirty98\API\Calculator\Controllers\VehiclePlugins\TexasCalculator;
use Thirty98\API\General\Entities\Avalara;
use Thirty98\Models\County;

class Motorcycle extends TexasCalculator
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
     * Fixed computation
     * 
     * @return real
     */
    public function individualLatePenalty($date_of_sale)
    {
        return 30.00;
    }
    
    /**
     * Fixed computation
     * 
     * @return real
     */
    public function licenseFee($taxable_amount = 0)
    {
        return $this->vehicle_service->getVehicleFeeByState($this->state, $this->params['vehicle_type']['slug'], "registration_fee");
    }

    public function salesTax($taxable_amount, $sales_tax_rate)
    {
        // return 3000;
        $avalara = new Avalara();
        $county_name = County::where('code', $this->params['processing_county'])->first()->name;

        return $avalara->salesTaxRate($county_name, $taxable_amount)['Tax'];
    }
}