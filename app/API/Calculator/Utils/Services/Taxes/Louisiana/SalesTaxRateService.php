<?php

namespace Thirty98\API\Calculator\Utils\Services\Taxes\Louisiana;

use Thirty98\API\Calculator\Utils\Services\Taxes\AbstractSalesTaxRateService;

class SalesTaxRateService extends AbstractSalesTaxRateService
{
    protected $state = 'LA';
    
    public function getRate()
    {
        $taxable_value = 11551.45;
        $state_sales_tax_rate = 0.0397;
        $state_vendors_comp_rate = 0.00935;
        $state_tourism_rate = 0.0002972;
        $area_tax_rate = 0.01;
        $area_vendor_comp = 0.02;
        $parish_tax = 0.0325;
        $parish_vendor_comp = 0.02;
        
        return 0.039700;
    }
}
