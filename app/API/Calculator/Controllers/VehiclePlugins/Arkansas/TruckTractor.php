<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins\Arkansas;

use Thirty98\API\Calculator\Controllers\VehiclePlugins\ArkansasCalculator;
use Thirty98\API\Vehicle\Services\VehicleService;

class TruckTractor extends ArkansasCalculator
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
        $gvw = $this->params['gvw'];

        if ($gvw >= 4501) {
            $gvw = 4501;
        }

        return $this->service->fetchArkansasPassengerWeightFees($gvw);


    }
}
