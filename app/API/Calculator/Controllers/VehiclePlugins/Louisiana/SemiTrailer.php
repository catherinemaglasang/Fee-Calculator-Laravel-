<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins\Louisiana;

use Thirty98\API\Calculator\Controllers\VehiclePlugins\LouisianaCalculator;
use Thirty98\API\Vehicle\Services\VehicleService;

class SemiTrailer extends LouisianaCalculator
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
        $type_of_plate = $this->params['type_of_plate'];

        if($type_of_plate === '1_yr_trailer_plate') {
            return (float) $this->service->getVehicleFeeByState($this->params['state']['code'], $this->params['vehicle_type']['slug'], '1_yr_trailer_plate');
        } else if($type_of_plate === '4_yr_trailer_plate') {
            return (float) $this->service->getVehicleFeeByState($this->params['state']['code'], $this->params['vehicle_type']['slug'], '4_yr_trailer_plate');
        } else if($type_of_plate === 'permanent_trailer_plate') {
            return (float) $this->service->getVehicleFeeByState($this->params['state']['code'], $this->params['vehicle_type']['slug'], 'permanent_trailer_plate');
        }


    }
}
