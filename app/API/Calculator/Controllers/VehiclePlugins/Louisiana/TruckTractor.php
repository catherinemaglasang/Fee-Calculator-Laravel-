<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins\Louisiana;

use Thirty98\API\Calculator\Controllers\VehiclePlugins\LouisianaCalculator;
use Thirty98\API\Vehicle\Services\VehicleService;

class TruckTractor extends LouisianaCalculator
{
    protected $service;
    protected $vehicle_type = 'Truck';

    public final function setVehicleService(VehicleService $service)
    {
        $this->service = $service;
    }

    public final function licenseFee($taxable_value = 0)
    {
        return (float) $this->service->getWeightedCalculation($this->state, $this->vehicle_type, $this->params['date_of_sale'], $this->params['gvw'], $this->params['farm_use']);
    }
}
