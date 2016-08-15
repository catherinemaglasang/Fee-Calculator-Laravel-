<?php

namespace Thirty98\API\Calculator\Utils\Services\Taxes\Texas;

use Thirty98\API\Calculator\Utils\Services\Taxes\AbstractTaxFeeService;
use Thirty98\API\Calculator\Services\VehicleFeesService;

class NewResidentTaxFeeService extends AbstractTaxFeeService
{
    protected $state = 'TX';

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
        return $this->vehicle_service->getVehicleFeeByState($this->state, $this->vehicle_type, 'new_resident_tax');
    }
}
