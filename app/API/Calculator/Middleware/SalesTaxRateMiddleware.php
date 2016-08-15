<?php

namespace Thirty98\API\Calculator\Middleware;

use Thirty98\API\Stdlib\Middleware\AbstractPostMiddleware;
use Thirty98\API\Calculator\Services\SalesTaxRateFactoryService;

class SalesTaxRateMiddleware extends AbstractPostMiddleware
{
    
    protected $factory;

    public function __construct(SalesTaxRateFactoryService $factory)
    {
        $this->factory = $factory;
    }
    
    protected function updateRequest(Array $payload)
    {
        /**
         * @todo Override taxable amount if applicable and add sales tax rate in the payload
         */
        //$config = $this->factory->setConfiguration($payload['state']['code'], $payload['vehicle_type']);
        //$payload['sales_tax_rate'] = $this->factory->getSalesTaxRate($payload['state']['code'], $payload['vehicle_type']);        
        $state = $payload['state']['class'];
        $sales_class = "Thirty98\\API\\Calculator\\Utils\\Services\\Taxes\\" .$state ."\\SalesTaxRateService";
        $sales = new $sales_class();
        $sales->setVehicleCategory($payload['vehicles']['category']);
        $payload['sales_tax_rate'] = $sales->getSalesTaxRate();
        
        if ($payload['state']['code'] == "TX") {
            $payload["vit_tax_rate"] = 0.002060;
        }
        
        if ($payload['state']['code'] == "LA") {
            $payload["vendor_comp_rate"] =  0.009350;
        }
        
        return $payload;
    }
    
    protected function postValidationRules()
    {
        return [];
    }
}
