<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins\Louisiana;

use Thirty98\API\Calculator\Controllers\VehiclePlugins\LouisianaCalculator;
use Thirty98\API\Vehicle\Services\VehicleService;
use App;

class Car extends LouisianaCalculator
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


       /* $gvw = isset($this->params['gwv']) ? $this->params['gwv'] : false;
        $number_of_passengers = isset($this->params['number_of_passengers']) ? $this->params['number_of_passengers'] : false;

        $result = $this->pos_service->getPOSPlateCalculation($this->params['pos_plate_calculation_rules'], $this->params['taxable_value'], $this->params['date_of_sale'], $gvw, $number_of_passengers);*/

        return (float)parent::licenseFee($this->params['taxable_value']);

        /*if (isset($this->params['gvw']) && $this->params['gvw'] >= 10000) {
            return (float)$this->service->getWeightedCalculation($this->state, 'car', $this->params['date_of_sale'], $this->params['gvw']);
        } else if ($this->params['type_of_plate'] === '1_yr_commercial_plate') {
            return (float)$this->service->getVehicleFeeByState($this->params['state']['code'], $this->params['vehicle_type']['slug'], '1_yr_commercial_plate');
        } else if ($this->params['type_of_plate'] === '2_yr_commercial_plate') {
            return (float)$this->service->getVehicleFeeByState($this->params['state']['code'], $this->params['vehicle_type']['slug'], '2_yr_commercial_plate');
        } else {
            return (float)parent::licenseFee($taxable_value);
        }*/
    }
}
