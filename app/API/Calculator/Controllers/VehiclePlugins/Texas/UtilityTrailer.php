<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins\Texas;

use Thirty98\API\Calculator\Controllers\VehiclePlugins\TexasCalculator;

class UtilityTrailer extends TexasCalculator
{
    protected $state = 'TX';
    protected $vehicle_type = 'utility_trailer';
    protected $fee = 'registration_fee';

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

    /**
     * Not included
     *
     * @return real
     */
    public function titleFee()
    {
        return 0.00;
    }

    /**
     * Same sa Registration FEE
     *
     * @return real
     */
    public function licenseFee($taxable_amount = 0)
    {
        $weight = \Thirty98\API\General\Entities\Helper::roundUpToHundreds($this->params['gvw']) + 100;

        if ($weight > 0 && $weight <= 6000) {
            return $this->vehicle_service->getVehicleFeeByState($this->state, $this->vehicle_type, $this->fee);
        }

        return 0; //if weight > 6000
    }
}