<?php

namespace Thirty98\API\Calculator\Utils\Services\Taxes\Texas;

use Thirty98\API\Calculator\Utils\Services\Taxes\AbstractSalesTaxRateService;

class SalesTaxRateService extends AbstractSalesTaxRateService
{
    protected $state = 'TX';

    public function getRate()
    {
        if ($this->vehicle_category === "motorcycle") {
            return 0.0397;
        }
        
        return 0.0625;
    }
}
