<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins\Louisiana;

use Thirty98\API\Calculator\Controllers\VehiclePlugins\LouisianaCalculator;
use Thirty98\API\Vehicle\Services\VehicleService;

class Truck extends LouisianaCalculator
{
    protected $service;
    protected $vehicle_type = 'Truck';

    public final function setVehicleService(VehicleService $service)
    {
        $this->service = $service;
    }

    public final function licenseFee($taxable_value = 0)
    {
        /*$pos_service = "Thirty98\\API\\POS\\Services\\POSService";
        $pos_service = App::make($pos_service);

        $gvw = isset($this->params['gvw']) ? $this->params['gvw'] : 0;
        $number_of_passengers = isset($this->params['number_of_passengers']) ? $this->params['number_of_passengers'] : 0;

        $result = $pos_service->getPOSPlateCalculation($this->params['pos_plate_calculation_rules'],
            $this->params['taxable_value'],
            $this->params['date_of_sale'],
            $gvw,
            $number_of_passengers
        );

        return $result;*/

        $result = (float) $this->service->getWeightedCalculation($this->state, $this->vehicle_type, $this->params['date_of_sale'], $this->params['gvw'], $this->params['farm_use']);

        return $result;
    }
}
