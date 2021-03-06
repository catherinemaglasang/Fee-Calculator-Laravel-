<?php

namespace Thirty98\API\Calculator\Utils\Services\Fees\Arkansas;

use Thirty98\API\Calculator\Utils\Services\Fees\AbstractTitleFeeService;
use Thirty98\API\Calculator\Services\VehicleFeesService;

class LicenseFeeService extends AbstractTitleFeeService
{
    protected $state = 'AR';

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
        return $this->vehicle_service->getVehicleFeeByState($this->state, $this->vehicle_type, 'license_fee');
    }
}
