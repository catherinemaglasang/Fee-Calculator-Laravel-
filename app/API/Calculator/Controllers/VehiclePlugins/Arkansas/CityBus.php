<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins\Arkansas;

use Thirty98\API\Calculator\Controllers\VehiclePlugins\ArkansasCalculator;
use Thirty98\API\Vehicle\Services\VehicleService;

class CityBus extends ArkansasCalculator
{
    /**
     * @var Thirty98\API\Vehicle\Services\VehicleService
     */
    protected $service;

    public final function setVehicleService(VehicleService $service)
    {
        $this->service = $service;
    }

    public function licenseFee()
    {
        return 0;
    }
}
