<?php

namespace Thirty98\API\Calculator\Utils\Services\Taxes;

abstract class AbstractSalesTaxRateService
{
    protected $state;
    protected $vehicle_category;
    
    public function setVehicleCategory($vehicle_category)
    {
        $this->vehicle_category = $vehicle_category;
    }

    abstract function getRate();
}