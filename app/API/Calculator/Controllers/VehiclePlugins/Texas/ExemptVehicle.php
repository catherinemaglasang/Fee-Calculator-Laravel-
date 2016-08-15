<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins\Texas;

use Thirty98\API\Calculator\Controllers\VehiclePlugins\TexasCalculator;

class ExemptVehicle extends TexasCalculator
{
    /**
     * Manual computation
     * 
     * @return real
     */
    public function salesTax($taxable_value, $rate, Array $avalara = [])
    {
        return 0;
    }
    
    /**
     * Manual computation
     * 
     * @return real
     */
    public function salesTaxLatePenalty($sales_tax_value, $date_of_sale, Array $avalara = [])
    {
        return 0;
    }
}