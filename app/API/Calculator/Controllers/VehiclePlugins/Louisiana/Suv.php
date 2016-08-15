<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins\Louisiana;

use Thirty98\API\Calculator\Controllers\VehiclePlugins\LouisianaCalculator;
use Thirty98\API\Vehicle\Services\VehicleService;

class Suv extends LouisianaCalculator
{
    /**
     * @var Thirty98\API\Vehicle\Services\VehicleService
     */
    protected $service;

    public final function setVehicleService(VehicleService $service)
    {
        $this->service = $service;
    }

    public final function licenseFee($taxable_value = 0)
    {
        if(isset($this->params['gvw']) && $this->params['gvw'] >= 10000) {
            return (float) $this->service->getWeightedCalculation($this->state, 'car', $this->params['date_of_sale'], $this->params['gvw']);;
        } else if($this->params['type_of_plate'] === '1_yr_commercial_plate') {
            return (float) $this->service->getVehicleFeeByState($this->params['state']['code'], $this->params['vehicle_type']['slug'], '1_yr_commercial_plate');
        } else if($this->params['type_of_plate'] === '2_yr_commercial_plate') {
            return (float) $this->service->getVehicleFeeByState($this->params['state']['code'], $this->params['vehicle_type']['slug'], '2_yr_commercial_plate');
        } else {
            return (float) parent::licenseFee($taxable_value);
        }
    }
}
