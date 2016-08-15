<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins\Louisiana;

use Thirty98\API\Calculator\Controllers\VehiclePlugins\LouisianaCalculator;
use Thirty98\API\Vehicle\Services\VehicleService;

class UtilityTrailer extends LouisianaCalculator
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
        $gvw = isset($this->params['gvw']) ? $this->params['gvw'] : 0;

        if($gvw >= 0 && $gvw <= 500) {
            return (float) $this->service->getVehicleFeeByState($this->params['state']['code'], $this->params['vehicle_type']['slug'], 'trailer_plate');
        } else {
            return 0; // Supposed to be an error.
        }
    }
}
