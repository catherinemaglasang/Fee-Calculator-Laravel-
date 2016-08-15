<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins\Texas;

use Thirty98\API\Calculator\Controllers\VehiclePlugins\TexasCalculator;

class Trailer extends TexasCalculator
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

    public function licenseFee($taxable_value = 0)
    {
        $gvw = isset($this->params['gvw']) ? $this->params['gvw'] : 0;
        $gvw = (double) str_replace(',', '', $gvw);

        if($this->params['gvw'] > 6000) {
            return parent::licenseFee($gvw);
        }

        return 0;
    }
}