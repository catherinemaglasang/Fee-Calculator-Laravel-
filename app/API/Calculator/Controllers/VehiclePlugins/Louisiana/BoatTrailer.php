<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins\Louisiana;

use Thirty98\API\Calculator\Controllers\VehiclePlugins\LouisianaCalculator;
use Thirty98\API\Vehicle\Services\VehicleService;

class BoatTrailer extends LouisianaCalculator
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

        if($gvw >= 0 && $gvw <= 1500) {
            return (float) $this->service->getVehicleFeeByState($this->params['state']['code'], $this->params['vehicle_type']['slug'], 'boat_trailer_plate');
        } else {
            return 0; // Supposed to be an error.
        }
    }
}
