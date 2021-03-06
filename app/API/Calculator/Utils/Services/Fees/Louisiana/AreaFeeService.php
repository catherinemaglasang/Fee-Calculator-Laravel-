<?php

namespace Thirty98\API\Calculator\Utils\Services\Fees\Louisiana;

use Thirty98\API\Calculator\Utils\Services\Fees\AbstractLocationRateService;
use Thirty98\API\Calculator\Services\VehicleFeesService;

class AreaFeeService extends AbstractLocationRateService
{
    protected $state = 'LA';

    /**
     * @var Thirty98\API\Calculator\Services\VehicleFeesService
     */
    protected $vehicle_service;

    public final function setVehicleFeeService(VehicleFeesService $service)
    {
        $this->vehicle_service = $service;
    }

    public function getRate()
    {
        return $this->vehicle_service-> $this->service->fetchAreaTaxRates($this->county, $this->city);
    }
}
