<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins\Louisiana;

use Thirty98\API\Calculator\Controllers\VehiclePlugins\LouisianaCalculator;
use Thirty98\API\Vehicle\Services\VehicleService;

class PrivateBus extends LouisianaCalculator
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
        $number_of_passengers = isset($this->params['number_of_passengers']) ? $this->params['number_of_passengers'] : 0;
        $fee = 0;

        if ($type_of_plate === 'private_bus_plate') {
            $fee = (float)$this->service->getVehicleFeeByState($this->params['state']['code'], $this->params['vehicle_type']['slug'], 'private_bus_plate');
        } else if ($type_of_plate === 'hire_passenger_plate') {
            $fee = (float)($number_of_passengers * $this->service->getVehicleFeeByState($this->params['state']['code'], $this->params['vehicle_type']['slug'], 'hire_passenger_plate'));
            $fee = $this->service->prorateFee($fee, $this->params['date_of_sale'], "July");
        }

        return $fee;
    }
}
