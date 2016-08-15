<?php

namespace Thirty98\API\Calculator\Services;

use Illuminate\Support\Facades\App;
use Thirty98\API\Calculator\Services\Configurations\Fields\FieldsMasterList;
use Thirty98\API\Stdlib\Helpers\ArrayHelperService;
use Thirty98\API\Stdlib\Services\StateService;
use Thirty98\Models\TXInspectionFee;
use Thirty98\API\General\Contracts\CalculatorConfigurationMappingRulesInterface;
use DB;

class CalculatorConfigurationFactoryServiceNew implements CalculatorConfigurationMappingRulesInterface
{

    protected $configuration;

    protected $ttl_service;
    protected $state;
    protected $payload;
    protected $mapping_rules = [
        'state', 'transaction_type', 'vehicle_type', 'checkbox', 'state_data'
    ];

    public function __construct(TransactionTypeService $ttl_service, StateService $state)
    {
        $this->ttl_service = $ttl_service;
        $this->state = $state;
    }

    public function configure2($payload)
    {
        $this->payload = $payload;

        $master_fields = FieldsMasterList::getFieldMasterList();

        foreach ($this->mapping_rules as $mapping_rule) {
            $map_rule_box[] = $mapping_rule;

            switch ($mapping_rule) {
                case "state":
                    $master_fields = $this->getMappingRuleByState($master_fields);
                    break;
                case "transaction_type":
                    $master_fields = $this->getMappingRuleByTransactionType($master_fields, $this->payload);
                    break;
                case "vehicle_type":
                    $master_fields = $this->getMappingRuleByVehicleType($master_fields, $this->payload);
                    break;
                case "checkbox":
                    $master_fields = $this->getMappingRuleByCheckbox($master_fields, $this->payload);
                    break;
                default:
                    // Do nothing.
            }
        }

        foreach($master_fields['form_fields'] as $form_field) {
            if(!isset($form_field['display_order'])) {
                dd($form_field);
            }
        }

        foreach($master_fields['calculator_options'] as $calculator_option) {
            if(!isset($calculator_option['display_order'])) {
                dd($calculator_option);
            }
        }

        $master_fields = $this->getStateData($master_fields, $this->payload);
        $master_fields['form_fields'] = ArrayHelperService::sortArrayByKey($master_fields['form_fields'], 'display_order');
        $master_fields['calculator_options'] = ArrayHelperService::sortArrayByKey($master_fields['calculator_options'], 'display_order');

        return $master_fields;
    }

    public function getRequiredFeesByState($state, $transaction_type)
    {
        $master_fees = [
            "LA" => [
                "Title Fees" => [
                    [
                        "name" => "Title Fee",
                        "slug" => $this->slugit("Title Fee"),
                        "required" => false
                    ],
                    [
                        "name" => "Duplicate Title Fee",
                        "slug" => $this->slugit("Duplicate Title Fee"),
                        "required" => false
                    ],
                    [
                        "name" => "Title Correction Fee",
                        "slug" => $this->slugit("Title Correction Fee"),
                        "required" => false
                    ],
                    [
                        "name" => "Mortgage Fee",
                        "slug" => $this->slugit("Mortgage Fee"),
                        "required" => false
                    ],
                ],
                "License Fees" => [
                    [
                        "name" => "License Fee",
                        "slug" => $this->slugit("License Fee"),
                        "required" => false
                    ],
                    [
                        "name" => "License Transfer Fee",
                        "slug" => $this->slugit("License Transfer Fee"),
                        "required" => false
                    ],
                    [
                        "name" => "Temp Tag",
                        "slug" => $this->slugit("Temp Tag"),
                        "required" => false
                    ],
                ],
                "Other Fees" => [
                    [
                        "name" => "Handling Fee",
                        "slug" => $this->slugit("Handling Fee"),
                        "required" => false
                    ],
                    [
                        "name" => "Tow Fee",
                        "slug" => $this->slugit("Tow Fee"),
                        "required" => false
                    ],
                    [
                        "name" => "Notary Fee",
                        "slug" => $this->slugit("Notary Fee"),
                        "required" => false
                    ],
                    [
                        "name" => "Miscellaneous Fee",
                        "slug" => $this->slugit("Miscellaneous Fee"),
                        "required" => false
                    ],
                ],
                "Tax" => [
                    [
                        "name" => "Sales Tax",
                        "slug" => $this->slugit("Sales Tax"),
                        "required" => false
                    ],
                    [
                        "name" => "State Tourism Tax",
                        "slug" => $this->slugit("State Tourism Tax"),
                        "required" => false
                    ],
                    [
                        "name" => "Municipality Tax",
                        "slug" => $this->slugit("Municipality Tax"),
                        "required" => false
                    ],
                    [
                        "name" => "Parish Tax",
                        "slug" => $this->slugit("Parish Tax"),
                        "required" => false
                    ],
                ],
                "Late Fees" => [
                    [
                        "name" => "Sales Tax Penalty",
                        "slug" => $this->slugit("Sales Tax Penalty"),
                        "required" => false
                    ],
                    [
                        "name" => "Sales Tax Interest",
                        "slug" => $this->slugit("Sales Tax Interest"),
                        "required" => false
                    ],
                    [
                        "name" => "State Tourism Tax Penalty",
                        "slug" => $this->slugit("State Tourism Tax Penalty"),
                        "required" => false
                    ],
                    [
                        "name" => "State Tourism Interest",
                        "slug" => $this->slugit("State Tourism Interest"),
                        "required" => false
                    ],
                    [
                        "name" => "Parish Tax Penalty",
                        "slug" => $this->slugit("Parish Tax Penalty"),
                        "required" => false
                    ],
                    [
                        "name" => "Municipality Tax Penalty",
                        "slug" => $this->slugit("Municipality Tax Penalty"),
                        "required" => false
                    ],
                    [
                        "name" => "Parish Interest",
                        "slug" => $this->slugit("Parish Interest"),
                        "required" => false
                    ],
                    [
                        "name" => "Municipality Interest",
                        "slug" => $this->slugit("Municipality Interest"),
                        "required" => false
                    ],
                ],
                "Tag Agency Fees" => [
                    [
                        "name" => "Convenience Fee",
                        "slug" => $this->slugit("Convenience Fee"),
                        "required" => false
                    ],
                    [
                        "name" => "Processing Fee",
                        "slug" => $this->slugit("Processing Fee"),
                        "required" => false
                    ],
                    [
                        "name" => "Mail Fee",
                        "slug" => $this->slugit("Mail Fee"),
                        "required" => false
                    ],
                    [
                        "name" => "Vendors Comp",
                        "slug" => $this->slugit("Vendors Comp"),
                        "required" => false
                    ],
                    [
                        "name" => "Electronic Filing Fee",
                        "slug" => $this->slugit("Electronic Filing Fee"),
                        "required" => false
                    ],
                ]
            ]
        ];

        if ($state === "LA") {
            switch ($transaction_type) {
                case "NR":
                    $master_fees[$state]["Title Fees"][0]["required"] = true;
                    break;
                case "TP":

                    break;
                case "DT":

                    break;
                case "TRC":

                    break;
                default:
                    // Do nothing.
            }
        }

        if (!isset($master_fees[$state][$transaction_type])) {
            $master_fees = [];
        }


        return $master_fees[$state][$transaction_type];
    }

    /**
     * These classes dynamically call other classes via State and mapping rule name.
     */

    /**
     * Fields to filter based on state.
     * @param $fields
     */
    public function getMappingRuleByState($fields)
    {
        $state = $this->payload['state']['class'];

        $class = "Thirty98\\API\\Calculator\\Services\\Configurations\\Fields\\States\\" . $state . "\\" . $state . "StateFilter";

        if (!class_exists($class)) {
            return $fields;
        }

        $class = new $class();

        $result = $class->filter($fields);

        return $result;
    }

    public function getMappingRuleByTransactionType($fields, $payload)
    {
        $state = $this->payload['state']['class'];

        $class = "Thirty98\\API\\Calculator\\Services\\Configurations\\Fields\\States\\" . $state . "\\" . $state . "TransactionTypeFilter";

        if (!class_exists($class)) {
            return $fields;
        }

        $class = new $class();

        $result = $class->filter($fields, $payload);

        return $result;
    }

    public function getMappingRuleByVehicleType($fields, $payload)
    {
        $state = $this->payload['state']['class'];

        $class = "Thirty98\\API\\Calculator\\Services\\Configurations\\Fields\\States\\" . $state . "\\" . $state . "VehicleTypeFilter";

        if (!class_exists($class)) {
            return $fields;
        }

        $class = new $class();

        $result = $class->filter($fields, $payload);

        return $result;
    }

    public function getMappingRuleByCheckbox($fields, $payload)
    {
        $state = $this->payload['state']['class'];

        $class = "Thirty98\\API\\Calculator\\Services\\Configurations\\Fields\\States\\" . $state . "\\" . $state . "CheckboxFilter";

        if (!class_exists($class)) {
            return $fields;
        }

        $class = new $class();

        $result = $class->filter($fields, $payload);

        return $result;
    }

    public function getStateData($fields, $payload)
    {
        $state = $this->payload['state']['class'];

        $class = "Thirty98\\API\\Calculator\\Services\\Configurations\\Fields\\States\\" . $state . "\\" . $state . "StateData";

        if (!class_exists($class)) {
            return $fields;
        }

        $class = App::make($class);

        $result = $class->filter($fields, $payload);

        return $result;
    }

    /**
     * Gab's implementation.
     */

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
                    ["name" => "taxable_value", "title" => "Taxable Value", "required" => false],
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
        return $this->state->getCountiesByState($state);
    }

    public function slugit($text, $separator = "_")
    {
        return Slugifier::slugify($text, $separator);
    }
}

