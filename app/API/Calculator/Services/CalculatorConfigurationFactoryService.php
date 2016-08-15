<?php

namespace Thirty98\API\Calculator\Services;

use Thirty98\API\Calculator\Services\TransactionTypeService;
use Thirty98\API\Stdlib\Services\StateService;
use Thirty98\Models\TXInspectionFee;
use DB;

class CalculatorConfigurationFactoryService
{
    protected $configuration;

    protected $ttl_service;
    protected $state;


    public function __construct(TransactionTypeService $ttl_service, StateService $state)
    {
        $this->ttl_service = $ttl_service;
        $this->state = $state;
    }

    public function configure(Array $payload)
    {
        $state = $payload['state']['code'];
        $source = isset($payload['source']) ? strtoupper($payload['source']) : "";

        $this->configuration['transaction_types'] = $this->getTransactionTypes($state);
        $this->configuration['vehicle_types'] = $this->getvehicleTypes($state);
        $this->configuration['calculator_options'] = $this->getOptions($state, $source);


        if (isset($payload['transaction_type'])) {
            $this->configuration['form_fields'] = $this->getFormFields($state, $payload['transaction_type']);
        }

        if ($state == "TX") {
            $this->configuration['inspection_fees'] = $this->getInspectionFees();
        }

        $this->configuration['counties'] = $this->getCounties($state);

        unset($state, $payload); //garbage collection

        return $this->configuration;
    }

    private function getTransactionTypes($state)
    {
        return $this->ttl_service->getTransactionTypesByState($state);
    }

    private function getvehicleTypes($state)
    {
        return $this->state->getVehicleTypes($state);
    }

    private function getFormFields($state, $transaction_type)
    {
//        return $this->state->getFormFieldsByTransactionType($state, $transaction_type);
        $config = [
            "AR" => [
                "NR" => [
                    ["name" => "transaction_type", "title" => "Transaction Type", "required" => true],
                    ["name" => "vin", "title" => "VIN", "required" => true],
                    ["name" => "vehicle_type", "title" => "Vehicle Type", "required" => true],
                    ["name" => "model_year", "title" => "Model Year", "required" => true],
                    ["name" => "street_address", "title" => "Dealer Address", "required" => true],
                    ["name" => "zip", "title" => "Zip", "required" => true],
                    ["name" => "cc_displacement", "title" => "CC Displacement", "required" => false],
                    ["name" => "empty_weight", "title" => "Empty Weight", "required" => true],
                    ["name" => "trailer_weight", "title" => "Trailer Weight", "required" => false],
                    ["name" => "carrying_capacity", "title" => "Carrying Capacity", "required" => true],
                    ["name" => "gvw", "title" => "GVW", "required" => false],
                    ["name" => "gvwr", "title" => "GVWR", "required" => false],
                    ["name" => "number_of_axles", "title" => "Number of Axles", "required" => false],
                    ["name" => "freight", "title" => "Freight", "required" => false],
                    ["name" => "sales_price", "title" => "Sales Price", "required" => true],
                    ["name" => "accessories", "title" => "Accessories", "required" => false],
                    ["name" => "warranty", "title" => "Warranty", "required" => false],
                    ["name" => "rebate_discount", "title" => "Rebate / Discount", "required" => false],
                    ["name" => "trade_in_value", "title" => "Trade-in Value", "required" => false],
                    ["name" => "taxable_value", "title" => "Taxable Value ", "required" => false],
                    ["name" => "date_of_sale", "title" => "Date of Sale", "required" => true]
                ],
                "TP" => [
                    ["name" => "transaction_type", "title" => "Transaction Type", "required" => true],
                    ["name" => "new_or_used", "title" => "Select Vehicle Status", "required" => true],
                    ["name" => "vin", "title" => "VIN", "required" => true],
                    ["name" => "vehicle_type", "title" => "Vehicle Type", "required" => true],
                    ["name" => "model_year", "title" => "Model Year", "required" => true],
                    ["name" => "street_address", "title" => "Dealer Address", "required" => true],
                    ["name" => "zip", "title" => "Zip", "required" => true],
                    ["name" => "cc_displacement", "title" => "CC Displacement", "required" => false],
                    ["name" => "empty_weight", "title" => "Empty Weight", "required" => true],
                    ["name" => "trailer_weight", "title" => "Trailer Weight", "required" => true],
                    ["name" => "carrying_capacity", "title" => "Carrying Capacity", "required" => true],
                    ["name" => "gvw", "title" => "GVW", "required" => false],
                    ["name" => "gvwr", "title" => "GVWR", "required" => false],
                    ["name" => "number_of_axles", "title" => "Number of Axles", "required" => true],
                    ["name" => "freight", "title" => "Freight", "required" => true],
                    ["name" => "sales_price", "title" => "Sales Price", "required" => true],
                    ["name" => "accessories", "title" => "Accessories", "required" => true],
                    ["name" => "warranty", "title" => "Warranty", "required" => true],
                    ["name" => "rebate_discount", "title" => "Rebate / Discount", "required" => true],
                    ["name" => "trade_in_value", "title" => "Trade-in Value", "required" => true],
                    ["name" => "taxable_value", "title" => "Taxable Value ", "required" => false],
                    ["name" => "date_of_sale", "title" => "Date of Sale", "required" => true]
                ],
                "DT" => [
                    ["name" => "transaction_type", "title" => "Transaction Type", "required" => true],
                    ["name" => "new_or_used", "title" => "Select Vehicle Status", "required" => true],
                    ["name" => "vin", "title" => "VIN", "required" => true],
                    ["name" => "vehicle_type", "title" => "Vehicle Type", "required" => true],
                    ["name" => "cc_displacement", "title" => "CC Displacement", "required" => false],
                    ["name" => "model_year", "title" => "Model Year", "required" => true],
                    ["name" => "street_address", "title" => "Dealer Address", "required" => true],
                    ["name" => "zip", "title" => "Zip", "required" => true],
                    ["name" => "empty_weight", "title" => "Empty Weight", "required" => true],
                    ["name" => "trailer_weight", "title" => "Trailer Weight", "required" => true],
                    ["name" => "carrying_capacity", "title" => "Carrying Capacity", "required" => true],
                    ["name" => "gvw", "title" => "GVW", "required" => false],
                    ["name" => "gvwr", "title" => "GVWR", "required" => false],
                    /*["name" => "number_of_axles", "title" => "Number of Axles", "required" => false],
                    ["name" => "freight", "title" => "Freight", "required" => false],
                    ["name" => "sales_price", "title" => "Sales Price", "required" => false],
                    ["name" => "accessories", "title" => "Accessories", "required" => false],
                    ["name" => "warranty", "title" => "Warranty", "required" => false],
                    ["name" => "rebate_discount", "title" => "Rebate / Discount", "required" => false],
                    ["name" => "trade_in_value", "title" => "Trade-in Value", "required" => false],
                    ["name" => "taxable_value", "title" => "Taxable Value ", "required" => false],
                    ["name" => "date_of_sale", "title" => "Date of Sale", "required" => false]*/
                ],
                "TRC" => [
                    ["name" => "transaction_type", "title" => "Transaction Type", "required" => true],
                    ["name" => "new_or_used", "title" => "Select Vehicle Status", "required" => true],
                    ["name" => "vin", "title" => "VIN", "required" => true],
                    ["name" => "vehicle_type", "title" => "Vehicle Type", "required" => true],
                    ["name" => "cc_displacement", "title" => "CC Displacement", "required" => false],
                    ["name" => "model_year", "title" => "Model Year", "required" => true],
                    ["name" => "street_address", "title" => "Dealer Address", "required" => true],
                    ["name" => "zip", "title" => "Zip", "required" => true],
                    ["name" => "empty_weight", "title" => "Empty Weight", "required" => true],
                    ["name" => "trailer_weight", "title" => "Trailer Weight", "required" => true],
                    ["name" => "carrying_capacity", "title" => "Carrying Capacity", "required" => true],
                    ["name" => "gvw", "title" => "GVW", "required" => false],
                    ["name" => "gvwr", "title" => "GVWR", "required" => false],
                    /*["name" => "number_of_axles", "title" => "Number of Axles", "required" => false],
                    ["name" => "freight", "title" => "Freight", "required" => false],
                    ["name" => "sales_price", "title" => "Sales Price", "required" => false],
                    ["name" => "accessories", "title" => "Accessories", "required" => false],
                    ["name" => "warranty", "title" => "Warranty", "required" => false],
                    ["name" => "rebate_discount", "title" => "Rebate / Discount", "required" => false],
                    ["name" => "trade_in_value", "title" => "Trade-in Value", "required" => false],
                    ["name" => "taxable_value", "title" => "Taxable Value ", "required" => false],
                    ["name" => "date_of_sale", "title" => "Date of Sale", "required" => false]*/
                ]
            ],
            "TX" => [
                "NR" => [
                    ["name" => "transaction_type", "title" => "Transaction Type", "required" => true],
                    ["name" => "new_or_used", "title" => "Select Vehicle Status", "required" => true],
                    ["name" => "vin", "title" => "VIN", "required" => true],
                    ["name" => "vehicle_type", "title" => "Vehicle Type", "required" => true],
                    ["name" => "model_year", "title" => "Model Year", "required" => true],
                    ["name" => "street_address", "title" => "Dealer Address", "required" => false],
                    ["name" => "zip", "title" => "Zip", "required" => false],
                    ["name" => "resident_county", "label" => "Select Resident County", "required" => false],
                    ["name" => "processing_county", "label" => "Select Processing County", "required" => true],
                    ["name" => "empty_weight", "title" => "Empty Weight", "required" => true],
                    ["name" => "trailer_weight", "title" => "Trailer Weight", "required" => false],
                    ["name" => "carrying_capacity", "title" => "Carrying Capacity", "required" => false],
                    ["name" => "gvw", "title" => "GVW", "required" => false],
                    ["name" => "gvwr", "title" => "GVWR", "required" => false],
                    ["name" => "inspection_type", "title" => "Select Inspection Type", "required" => false],
                    ["name" => "freight", "title" => "Freight", "required" => false],
                    ["name" => "sales_price", "title" => "Sales Price", "required" => false],
                    ["name" => "rebate_discount", "title" => "Rebate / Discount", "required" => false],
                    ["name" => "trade_in_value", "title" => "Trade-in Value", "required" => false],
                    ["name" => "taxable_value", "title" => "Taxable Value ", "required" => false],
                    ["name" => "fuel_type", "title" => "Fuel Type", "required" => false],
                    ["name" => "date_of_sale", "title" => "Date of Sale", "required" => false],
                    ["name" => "miscellaneous_fee", "title" => "Miscellaneous Fees", "required" => false],
                ],
                "TP" => [
                    ["name" => "transaction_type", "title" => "Transaction Type", "required" => true],
                    ["name" => "new_or_used", "title" => "Select Vehicle Status", "required" => true],
                    ["name" => "vin", "title" => "VIN", "required" => true],
                    ["name" => "vehicle_type", "title" => "Vehicle Type", "required" => true],
                    ["name" => "model_year", "title" => "Model Year", "required" => true],
                    ["name" => "street_address", "title" => "Dealer Address", "required" => false],
                    ["name" => "zip", "title" => "Zip", "required" => false],
                    ["name" => "resident_county", "label" => "Select Resident County", "required" => false],
                    ["name" => "processing_county", "label" => "Select Processing County", "required" => true],
                    ["name" => "empty_weight", "title" => "Empty Weight", "required" => true],
                    ["name" => "trailer_weight", "title" => "Trailer Weight", "required" => false],
                    ["name" => "carrying_capacity", "title" => "Carrying Capacity", "required" => false],
                    ["name" => "gvw", "title" => "GVW", "required" => false],
                    ["name" => "gvwr", "title" => "GVWR", "required" => false],
                    ["name" => "inspection_type", "title" => "Select Inspection Type", "required" => true],
                    ["name" => "freight", "title" => "Freight", "required" => false],
                    ["name" => "sales_price", "title" => "Sales Price", "required" => true],
                    ["name" => "rebate_discount", "title" => "Rebate / Discount", "required" => true],
                    ["name" => "trade_in_value", "title" => "Trade-in Value", "required" => true],
                    ["name" => "taxable_value", "title" => "Taxable Value ", "required" => false],
                    ["name" => "fuel_type", "title" => "Fuel Type", "required" => true],
                    ["name" => "date_of_sale", "title" => "Date of Sale", "required" => false],
                    ["name" => "miscellaneous_fee", "title" => "Miscellaneous Fees", "required" => false],
                ],
                "DT" => [
                    ["name" => "transaction_type", "title" => "Transaction Type", "required" => true],
                    ["name" => "new_or_used", "title" => "Select Vehicle Status", "required" => true],
                    ["name" => "vin", "title" => "VIN", "required" => true],
                    ["name" => "vehicle_type", "title" => "Vehicle Type", "required" => true],
                    ["name" => "model_year", "title" => "Model Year", "required" => true],
                    ["name" => "miscellaneous_fee", "title" => "Miscellaneous Fees", "required" => false],
//                    ["name" => "street_address", "title" => "Dealer Address", "required" => false],
//                    ["name" => "zip", "title" => "Zip", "required" => false],
//                    ["name" => "resident_county", "label" => "Select Resident County", "required" => false],
//                    ["name" => "processing_county", "label" => "Select Processing County", "required" => true],
//                    ["name" => "empty_weight", "title" => "Empty Weight", "required" => false],
//                    ["name" => "trailer_weight", "title" => "Trailer Weight", "required" => false],
//                    ["name" => "carrying_capacity", "title" => "Carrying Capacity", "required" => false],
//                    ["name" => "gvw", "title" => "GVW", "required" => false],
//                    ["name" => "gvwr", "title" => "GVWR", "required" => false],
//                    ["name" => "inspection_type", "title" => "Select Inspection Type", "required" => false],
//                    ["name" => "freight", "title" => "Freight", "required" => false],
//                    ["name" => "sales_price", "title" => "Sales Price", "required" => false],             
//                    ["name" => "rebate_discount", "title" => "Rebate / Discount", "required" => false],             
//                    ["name" => "trade_in_value", "title" => "Trade-in Value", "required" => false],             
//                    ["name" => "taxable_value", "title" => "Taxable Value ", "required" => false],             
//                    ["name" => "fuel_type", "title" => "Fuel Type", "required" => false],
//                    ["name" => "date_of_sale", "title" => "Date of Sale", "required" => false],
                ],
                "TO" => [
                    ["name" => "transaction_type", "title" => "Transaction Type", "required" => true],
                    ["name" => "new_or_used", "title" => "Select Vehicle Status", "required" => true],
                    ["name" => "vin", "title" => "VIN", "required" => true],
                    ["name" => "vehicle_type", "title" => "Vehicle Type", "required" => true],
                    ["name" => "model_year", "title" => "Model Year", "required" => true],
                    ["name" => "street_address", "title" => "Dealer Address", "required" => false],
                    ["name" => "zip", "title" => "Zip", "required" => false],
                    ["name" => "resident_county", "label" => "Select Resident County", "required" => false],
                    ["name" => "processing_county", "label" => "Select Processing County", "required" => true],
                    ["name" => "empty_weight", "title" => "Empty Weight", "required" => true],
                    ["name" => "trailer_weight", "title" => "Trailer Weight", "required" => false],
                    ["name" => "carrying_capacity", "title" => "Carrying Capacity", "required" => false],
                    ["name" => "gvw", "title" => "GVW", "required" => false],
                    ["name" => "gvwr", "title" => "GVWR", "required" => false],
                    ["name" => "inspection_type", "title" => "Select Inspection Type", "required" => true],
                    ["name" => "freight", "title" => "Freight", "required" => false],
                    ["name" => "sales_price", "title" => "Sales Price", "required" => true],
                    ["name" => "rebate_discount", "title" => "Rebate / Discount", "required" => true],
                    ["name" => "trade_in_value", "title" => "Trade-in Value", "required" => true],
                    ["name" => "taxable_value", "title" => "Taxable Value ", "required" => false],
                    ["name" => "fuel_type", "title" => "Fuel Type", "required" => true],
                    ["name" => "date_of_sale", "title" => "Date of Sale", "required" => false],
                    ["name" => "miscellaneous_fee", "title" => "Miscellaneous Fees", "required" => false],
                ],
                "RO" => [
                    ["name" => "transaction_type", "title" => "Transaction Type", "required" => true],
                    ["name" => "new_or_used", "title" => "Select Vehicle Status", "required" => true],
                    ["name" => "vin", "title" => "VIN", "required" => true],
                    ["name" => "vehicle_type", "title" => "Vehicle Type", "required" => true],
                    ["name" => "model_year", "title" => "Model Year", "required" => true],
                    ["name" => "street_address", "title" => "Dealer Address", "required" => false],
                    ["name" => "zip", "title" => "Zip", "required" => false],
                    ["name" => "resident_county", "label" => "Select Resident County", "required" => false],
                    ["name" => "processing_county", "label" => "Select Processing County", "required" => true],
                    ["name" => "empty_weight", "title" => "Empty Weight", "required" => true],
                    ["name" => "trailer_weight", "title" => "Trailer Weight", "required" => false],
                    ["name" => "carrying_capacity", "title" => "Carrying Capacity", "required" => false],
                    ["name" => "gvw", "title" => "GVW", "required" => false],
                    ["name" => "gvwr", "title" => "GVWR", "required" => false],
                    ["name" => "inspection_type", "title" => "Select Inspection Type", "required" => true],
//                    ["name" => "freight", "title" => "Freight", "required" => false],
//                    ["name" => "sales_price", "title" => "Sales Price", "required" => false],   
//                    ["name" => "rebate_discount", "title" => "Rebate / Discount", "required" => false],
//                    ["name" => "trade_in_value", "title" => "Trade-in Value", "required" => false],
//                    ["name" => "taxable_value", "title" => "Taxable Value ", "required" => false],  
                    ["name" => "fuel_type", "title" => "Fuel Type", "required" => true],
                    ["name" => "date_of_sale", "title" => "Date of Sale", "required" => false],
                    ["name" => "miscellaneous_fee", "title" => "Miscellaneous Fees", "required" => false],
                ],
                "TRC" => [
                    ["name" => "transaction_type", "title" => "Transaction Type", "required" => true],
                    ["name" => "new_or_used", "title" => "Select Vehicle Status", "required" => true],
                    ["name" => "vin", "title" => "VIN", "required" => true],
                    ["name" => "vehicle_type", "title" => "Vehicle Type", "required" => true],
                    ["name" => "model_year", "title" => "Model Year", "required" => true],
//                    ["name" => "street_address", "title" => "Dealer Address", "required" => false],
//                    ["name" => "zip", "title" => "Zip", "required" => false],
//                    ["name" => "resident_county", "label" => "Select Resident County", "required" => false],
//                    ["name" => "processing_county", "label" => "Select Processing County", "required" => true],
//                    ["name" => "empty_weight", "title" => "Empty Weight", "required" => false],
//                    ["name" => "trailer_weight", "title" => "Trailer Weight", "required" => false],
//                    ["name" => "carrying_capacity", "title" => "Carrying Capacity", "required" => false],
//                    ["name" => "gvw", "title" => "GVW", "required" => false],
//                    ["name" => "gvwr", "title" => "GVWR", "required" => false],
//                    ["name" => "inspection_type", "title" => "Select Inspection Type", "required" => true],
//                    ["name" => "freight", "title" => "Freight", "required" => false],
//                    ["name" => "sales_price", "title" => "Sales Price", "required" => false],             
//                    ["name" => "rebate_discount", "title" => "Rebate / Discount", "required" => false],             
//                    ["name" => "trade_in_value", "title" => "Trade-in Value", "required" => false],             
//                    ["name" => "taxable_value", "title" => "Taxable Value ", "required" => false],             
//                    ["name" => "fuel_type", "title" => "Fuel Type", "required" => false],
//                    ["name" => "date_of_sale", "title" => "Date of Sale", "required" => false],
                ]
            ],
            "LA" => [
                "NR" => [
                    ["name" => "transaction_type", "title" => "Transaction Type", "required" => true],
                    ["name" => "type_of_plate", "title" => "Type of Plate", "required" => true],
                    ["name" => "vin", "title" => "VIN", "required" => true],
                    ["name" => "vehicle_type", "title" => "Vehicle Type", "required" => true],
                    ["name" => "model_year", "title" => "Model Year", "required" => false],
                    ["name" => "mortgage_fee", "title" => "Mortgage Fee", "required" => false],
                    ["name" => "street_address", "title" => "Customer Address", "required" => true],
                    ["name" => "zip", "title" => "Zip", "required" => true],
                    ["name" => "county", "title" => "Select Parish", "required" => false],
                    ["name" => "city_limits", "title" => "City Limits?", "required" => false],
                    ["name" => "number_of_passengers", "title" => "No of Passengers?", "required" => false],
                    ["name" => "empty_weight", "title" => "Empty Weight", "required" => true],
                    ["name" => "trailer_weight", "title" => "Trailer Weight", "required" => false],
                    ["name" => "carrying_capacity", "title" => "Carrying Capacity", "required" => false],
                    ["name" => "gvw", "title" => "GCVW", "required" => false],
                    ["name" => "sales_price", "title" => "Sales Price", "required" => true],
                    ["name" => "rebate_discount", "title" => "Rebate / Discount", "required" => false],
                    ["name" => "trade_in_value", "title" => "Trade-in Value", "required" => false],
                    ["name" => "taxable_value", "title" => "Taxable Value ", "required" => false],
                    ["name" => "sales_tax_credit", "title" => "Sales Tax Credit", "required" => false],
                    ["name" => "date_of_sale", "title" => "Date of Sale", "required" => false],
                ],
                "TP" => [
                    ["name" => "transaction_type", "title" => "Transaction Type", "required" => true],
                    ["name" => "type_of_plate", "title" => "Type of Plate", "required" => true],
                    ["name" => "vin", "title" => "VIN", "required" => true],
                    ["name" => "vehicle_type", "title" => "Vehicle Type", "required" => true],
                    ["name" => "model_year", "title" => "Model Year", "required" => false],
                    ["name" => "mortgage_fee", "title" => "Mortgage Fee", "required" => false],
                    ["name" => "street_address", "title" => "Customer Address", "required" => true],
                    ["name" => "zip", "title" => "Zip", "required" => true],
                    ["name" => "county", "title" => "Select Parish", "required" => false],
                    ["name" => "city_limits", "title" => "City Limits?", "required" => false],
                    ["name" => "number_of_passengers", "title" => "No of Passengers?", "required" => false],
                    ["name" => "empty_weight", "title" => "Empty Weight", "required" => true],
                    ["name" => "trailer_weight", "title" => "Trailer Weight", "required" => false],
                    ["name" => "carrying_capacity", "title" => "Carrying Capacity", "required" => false],
                    ["name" => "gvw", "title" => "GCVW", "required" => false],
                    ["name" => "sales_price", "title" => "Sales Price", "required" => true],
                    ["name" => "rebate_discount", "title" => "Rebate / Discount", "required" => false],
                    ["name" => "trade_in_value", "title" => "Trade-in Value", "required" => false],
                    ["name" => "taxable_value", "title" => "Taxable Value ", "required" => false],
                    ["name" => "sales_tax_credit", "title" => "Sales Tax Credit", "required" => false],
                    ["name" => "date_of_sale", "title" => "Date of Sale", "required" => false],
                ],
                "DT" => [
                    ["name" => "transaction_type", "title" => "Transaction Type", "required" => true],
                    ["name" => "type_of_plate", "title" => "Type of Plate", "required" => true],
                    ["name" => "vin", "title" => "VIN", "required" => true],
                    ["name" => "vehicle_type", "title" => "Vehicle Type", "required" => true],
                    ["name" => "model_year", "title" => "Model Year", "required" => false],
//                    ["name" => "mortgage_fee", "title" => "Mortgage Fee", "required" => false],
//                    ["name" => "street_address", "title" => "Customer Address", "required" => true],
//                    ["name" => "zip", "title" => "Zip", "required" => true],
//                    ["name" => "county", "title" => "Select Prish", "required" => false],
//                    ["name" => "city_limits", "title" => "City Limits?", "required" => false],
//                    ["name" => "number_of_passengers", "title" => "No of Passengers?", "required" => false],
//                    ["name" => "empty_weight", "title" => "Empty Weight", "required" => true],
//                    ["name" => "trailer_weight", "title" => "Trailer Weight", "required" => false],
//                    ["name" => "carrying_capacity", "title" => "Carrying Capacity", "required" => false],
//                    ["name" => "gvw", "title" => "GCVW", "required" => false],
//                    ["name" => "sales_price", "title" => "Sales Price", "required" => true], 
//                    ["name" => "rebate_discount", "title" => "Rebate / Discount", "required" => false],  
//                    ["name" => "trade_in_value", "title" => "Trade-in Value", "required" => false],             
//                    ["name" => "taxable_value", "title" => "Taxable Value ", "required" => false],             
//                    ["name" => "sales_tax_credit", "title" => "Sales Tax Credit", "required" => false],
//                    ["name" => "date_of_sale", "title" => "Date of Sale", "required" => false],
                ],
                "TRC" => [
                    ["name" => "transaction_type", "title" => "Transaction Type", "required" => true],
                    ["name" => "type_of_plate", "title" => "Type of Plate", "required" => true],
                    ["name" => "vin", "title" => "VIN", "required" => true],
                    ["name" => "vehicle_type", "title" => "Vehicle Type", "required" => true],
                    ["name" => "model_year", "title" => "Model Year", "required" => false],
//                    ["name" => "mortgage_fee", "title" => "Mortgage Fee", "required" => false],
//                    ["name" => "street_address", "title" => "Customer Address", "required" => true],
//                    ["name" => "zip", "title" => "Zip", "required" => true],
//                    ["name" => "county", "title" => "Select Prish", "required" => false],
//                    ["name" => "city_limits", "title" => "City Limits?", "required" => false],
//                    ["name" => "number_of_passengers", "title" => "No of Passengers?", "required" => false],
//                    ["name" => "empty_weight", "title" => "Empty Weight", "required" => true],
//                    ["name" => "trailer_weight", "title" => "Trailer Weight", "required" => false],
//                    ["name" => "carrying_capacity", "title" => "Carrying Capacity", "required" => false],
//                    ["name" => "gvw", "title" => "GCVW", "required" => false],
//                    ["name" => "sales_price", "title" => "Sales Price", "required" => true], 
//                    ["name" => "rebate_discount", "title" => "Rebate / Discount", "required" => false],             
//                    ["name" => "trade_in_value", "title" => "Trade-in Value", "required" => false],             
//                    ["name" => "taxable_value", "title" => "Taxable Value ", "required" => false],   
//                    ["name" => "sales_tax_credit", "title" => "Sales Tax Credit", "required" => false],
//                    ["name" => "date_of_sale", "title" => "Date of Sale", "required" => false]
                ]
            ]
        ];

        return $config[$state][$transaction_type];
    }

    private function getOptions($state, $source)
    {
        $options = [
            'AR' => [
                ['name' => "no_fees", "title" => "No Fees", "selected" => false],
                ['name' => "temp_tag", "title" => "Temp Tag", "selected" => true],
                ['name' => "exempt_from_sales_tax", "title" => "Exempt From Sales Tax", "selected" => false],
                ['name' => "transfer_plate", "title" => "Transfer Plate", "selected" => false],
                ['name' => "vehicle_financed", "title" => "Vehicle Financed", "selected" => true],
                // Not included.
                ['name' => "farm_use", "title" => "Farm Use?", "selected" => false],
                /*['name' => "off_road", "title" => "Off-Road?", "selected" => false],*/
                ['name' => "add_accessories", "title" => "Add Accessories?", "selected" => true],
                ['name' => "add_warranty", "title" => "Add Warranty?", "selected" => true],
                ['name' => "include_late_fees", "title" => "Include Late Fees?", "selected" => true]
            ],
            'LA' => [
                ['name' => "no_fees", "title" => "No Fees", "selected" => false],
                ['name' => "temp_tag", "title" => "Temp Tag", "selected" => true], //if user type is dealer
                ['name' => "farm_use", "title" => "Farm Use?", "selected" => false],
//                    ['name' => "did_pull_a_trailer", "title" => "Do you ever pull a Trailer?", "selected" => false],
                ['name' => "exempt_from_sales_tax", "title" => "Exempt From Sales Tax", "selected" => false],
                ['name' => "include_late_fees", "title" => "Include Late Fees?", "selected" => true]
            ],
            'TX' => [
                ['name' => "no_fees", "title" => "No Fees", "selected" => false],
                ['name' => "temp_tag", "title" => "Temp Tag", "selected" => true], //if user type is dealer
                ['name' => "is_trade_in_leased", "title" => "Is Trade-in Leased?", "selected" => false],
                ['name' => "farm_ranch", "title" => "Farm/Ranch", "selected" => false],
                ['name' => "member_of_military", "title" => "Member of Military", "selected" => false],
                ['name' => "off_highway_use", "title" => "Off Highway Use", "selected" => false],
                ['name' => "rebuilt_salvage", "title" => "Rebuilt/Salvage", "selected" => false],
                ['name' => "exempt_from_sales_tax", "title" => "Exempt From Sales Tax", "selected" => false],
//                    ['name' => "did_pull_a_trailer", "title" => "Do you ever pull a Trailer?", "selected" => false],
                ['name' => "include_inspection_fee", "title" => "Include Inspection Fees?", "selected" => false],
                ['name' => "include_vit_tax", "title" => "Include VIT Tax?", "selected" => false],
                ['name' => "include_late_fees", "title" => "Include Late Fees?", "selected" => true]
            ]
        ];

        $data = $options[strtoupper($state)];

        if ($source !== "FI") {
            $data [] = ['name' => "did_pull_a_trailer", "title" => "Do you ever pull a Trailer?", "selected" => false];
        }

        return $data;
    }

    protected function getInspectionFees()
    {
        return TXInspectionFee::select('code', 'name as description', DB::raw('CONCAT(name, " - ", code) AS title'))->get();
    }

    protected function getCounties($state)
    {
        $counties = $this->state->getCountiesByState($state);

        return $counties;
    }
}

