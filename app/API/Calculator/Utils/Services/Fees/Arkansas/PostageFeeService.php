<?php

namespace Thirty98\API\Calculator\Utils\Services\Fees\Arkansas;

use Thirty98\API\Calculator\Utils\Services\Fees\AbstractTitleFeeService;
use Thirty98\API\Calculator\Services\VehicleFeesService;

class PostageFeeService  extends AbstractTitleFeeService
{
    protected $vehicle_service;
    protected $state = 'AR';

    public final function setVehicleFeeService(VehicleFeesService $service)
    {
        $this->vehicle_service = $service;
    }

    public function getRate()
    {
        return $this->vehicle_service->getVehicleFeeByState($this->state, $this->vehicle_type, 'postage_fee');
    }
}