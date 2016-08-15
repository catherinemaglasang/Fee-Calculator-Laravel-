<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins\Louisiana;

use Thirty98\API\Calculator\Controllers\VehiclePlugins\LouisianaCalculator;
use Thirty98\API\Vehicle\Services\VehicleService;

class Bus extends LouisianaCalculator
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
