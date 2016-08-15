<?php

namespace Thirty98\API\Calculator\Middleware;

use Thirty98\API\Stdlib\Middleware\AbstractPostMiddleware;
use Thirty98\API\Calculator\Services\VehicleFeesService;

//use Thirty98\API\Calculator\Services\FeesConfigurationFactoryService;

class FeesFactoryLateFeesMiddleware extends AbstractPostMiddleware
{
    protected $state;
    protected $vehicle;
    protected $vehicle_service;

    public function __construct(VehicleFeesService $vehicle)
    {
        $this->vehicle_service = $vehicle;
    }

    protected function postValidationRules()
    {
        $payload = $this->payload;
        $state = $payload['state']['code'];

        $validations = [];

        // Common.
        $validations = [
            'taxable_value' => 'required',
            'deal_id' => 'required|numeric',
            'ends' => 'required|array',
            'days_elapsed' => 'required|numeric'
        ];

        if ($state === 'LA') {
            $validations['city'] = 'required';
            $validations['county'] = 'required';
        }

        if ($state === 'TX') {

        }

        return $validations;
    }

    protected function updateRequest(Array $payload)
    {
        $this->state = $payload['state'];
        $state = $payload['state']['code'];

        // For all states
        $payload['calc_config'] = [];
        $payload['fee_rates'] = [];
        $payload['transaction_type'] = 'NR';
        $payload['late_fees_only'] = true;

        if ($state === 'LA') {
            $payload['exempt_from_sales_tax'] = false;
            $payload['no_fees'] = false;
            $payload['include_late_fees'] = true;
        }

        if ($state === 'TX') {
            $payload['exempt_from_sales_tax'] = false;
            $payload['no_fees'] = false;
            $payload['include_late_fees'] = true;
            $payload['new_registration_tax'] = false;
            $payload['even_trade_tax'] = false;
            $payload['sales_tax'] = true;
            $payload['gift_tax'] = false;
            $payload['model_year'] = 0;
            $payload['member_of_military'] = false;
        }

        $payload['fee_rates']['sales_tax_rate'] = $this->getSalesTaxRate();
        $payload['fee_rates']['tourism_tax_rate'] = $this->getTourismTaxRate();
        $payload['fee_rates']['parish_tax_rate'] = isset($payload['Sales Tax Rate']['parish_tax']) ? $payload['Sales Tax Rate']['parish_tax'] : 0;
        $payload['fee_rates']['area_tax_rate'] = isset($payload['Sales Tax Rate']['area_tax']) ? $payload['Sales Tax Rate']['area_tax'] : 0;
        $payload['fee_rates']['area_vendor_comp_rate'] = isset($payload['Sales Tax Rate']['area_vendor_desc']) ? $payload['Sales Tax Rate']['area_vendor_desc'] : 0;
        $payload['fee_rates']['parish_tax_rate'] = isset($payload['Sales Tax Rate']['parish_tax']) ? $payload['Sales Tax Rate']['parish_tax'] : 0;
        $payload['fee_rates']['parish_vendor_comp_rate'] = isset($payload['Sales Tax Rate']['parish_vendor_desc']) ? $payload['Sales Tax Rate']['parish_vendor_desc'] : 0;

        return $payload;
    }

    private function getSalesTaxRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Taxes\\" . $this->state['class'] . "\\SalesTaxRateService";

        if (!class_exists($class)) {
            return 0;
        }

        $sales = new $class();
        $sales->setVehicleCategory($this->vehicle['slug']);


        return $sales->getRate();
    }

    private function getTourismTaxRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Fees\\" . $this->state['class'] . "\\TourismTaxRateService";

        if (!class_exists($class)) {
            return 0;
        }

        $title = new $class($this->county, $this->vehicle['slug']);

        return $title->getRate();
    }
}