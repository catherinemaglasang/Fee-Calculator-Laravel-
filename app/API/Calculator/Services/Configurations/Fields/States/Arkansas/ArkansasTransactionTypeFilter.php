<?php

namespace Thirty98\API\Calculator\Services\Configurations\Fields\States\Arkansas;

class ArkansasTransactionTypeFilter
{
    public function filter($master_fields, $payload)
    {
        $transaction_type = $payload['transaction_type'];
        $transaction_type_fields = $this->getTransactionTypeFields();

        // Transaction type rule variables.
        $form_fields_transaction_types = $transaction_type_fields['form_fields'][$transaction_type];
        $calculator_options_transaction_types = $transaction_type_fields['calculator_options'];

        // Remove form fields not in the transaction type.
        foreach ($master_fields['form_fields'] as $key => $form_field) {
            $name = $form_field['name'];

            if (!isset($form_fields_transaction_types[$name])) {
                unset($master_fields['form_fields'][$key]);
            } else {
                $required = false;

                if ($form_fields_transaction_types[$name]['required'] === 'true') {
                    $required = true;
                }

                $master_fields['form_fields'][$key]['required'] = $required;
            }
        }

        // Remove calcualtor option fields not in the calculation options.
        foreach ($master_fields['calculator_options'] as $key => $calculator_option) {
            $name = $calculator_option['name'];

            if (!isset($calculator_options_transaction_types[$name])) {
                unset($master_fields['calculator_options'][$key]);
            } else {
                $selected = false;

                if ($calculator_options_transaction_types[$name]['selected'] === 'true') {
                    $selected = true;
                }

                $master_fields['calculator_options'][$key]['selected'] = $selected;
            }
        }

        return $master_fields;
    }


    /**
     * Transaction type filter settings.
     * Further filters state fields based on their transaction type (required or not required)
     *
     * @return array
     */
    public function getTransactionTypeFields()
    {
        return [
            'form_fields' => [
                "NR" => [
                    'transaction_type' => ['title' => 'Transaction Type', 'required' => 'true'],
                    'vin' => ['title' => 'VIN', 'required' => 'true'],
                    'vehicle_type' => ['title' => 'Vehicle Type', 'required' => 'true'],
                    'model_year' => ['title' => 'Model Year', 'required' => 'true'],
                    'street_address' => ['title' => 'Dealer Address', 'required' => 'true'],
                    'zip' => ['title' => 'Zip', 'required' => 'true'],
                    'cc_displacement' => ['title' => 'CC Displacement', 'required' => 'true'],
                    'empty_weight' => ['title' => 'Empty Weight', 'required' => 'true'],
                    /*'trailer_weight' => ['title' => 'Trailer Weight', 'required' => 'true'],*/
                    /*'carrying_capacity' => ['title' => 'Carrying Capacity', 'required' => 'true'],*/
                    /*'gvw' => ['title' => 'GVW', 'required' => 'true'],*/
                    /*'gvwr' => ['title' => 'GVWR', 'required' => 'true'],*/
                    /*'number_of_axles' => ['title' => 'Number of Axles', 'required' => 'true'],*/
                    /*'freight' => ['title' => 'Freight', 'required' => 'true'],*/
                    'sales_price' => ['title' => 'Sales Price', 'required' => 'true'],
                    'accessories' => ['title' => 'Accessories', 'required' => 'true'],
                    'warranty' => ['title' => 'Warranty', 'required' => 'true'],
                    'rebate_discount' => ['title' => 'Rebate / Discount', 'required' => 'true'],
                    'trade_in_value' => ['title' => 'Trade-in Value', 'required' => 'true'],
                    'taxable_value' => ['title' => 'Taxable Value ', 'required' => 'true'],
                    'date_of_sale' => ['title' => 'Date of Sale', 'required' => 'true']
                ],
                "TP" => [
                    'transaction_type' => ['title' => 'Transaction Type', 'required' => 'true'],
                    'new_or_used' => ['title' => 'Select Vehicle Status', 'required' => 'true'],
                    'vin' => ['title' => 'VIN', 'required' => 'true'],
                    'vehicle_type' => ['title' => 'Vehicle Type', 'required' => 'true'],
                    'model_year' => ['title' => 'Model Year', 'required' => 'true'],
                    'street_address' => ['title' => 'Dealer Address', 'required' => 'true'],
                    'zip' => ['title' => 'Zip', 'required' => 'true'],
                    'cc_displacement' => ['title' => 'CC Displacement', 'required' => 'true'],
                    'empty_weight' => ['title' => 'Empty Weight', 'required' => 'true'],
                    /*'trailer_weight' => ['title' => 'Trailer Weight', 'required' => 'true'],*/
                    /*'carrying_capacity' => ['title' => 'Carrying Capacity', 'required' => 'true'],*/
                    /*'gvw' => ['title' => 'GVW', 'required' => 'true'],*/
                    /*'gvwr' => ['title' => 'GVWR', 'required' => 'true'],*/
                    /*'number_of_axles' => ['title' => 'Number of Axles', 'required' => 'true'],*/
                    /*'freight' => ['title' => 'Freight', 'required' => 'true'],*/
                    'sales_price' => ['title' => 'Sales Price', 'required' => 'true'],
                    'accessories' => ['title' => 'Accessories', 'required' => 'true'],
                    'warranty' => ['title' => 'Warranty', 'required' => 'true'],
                    'rebate_discount' => ['title' => 'Rebate / Discount', 'required' => 'true'],
                    'trade_in_value' => ['title' => 'Trade-in Value', 'required' => 'true'],
                    'taxable_value' => ['title' => 'Taxable Value ', 'required' => 'true'],
                    'date_of_sale' => ['title' => 'Date of Sale', 'required' => 'true']
                ],
                "DT" => [
                    'transaction_type' => ['title' => 'Transaction Type', 'required' => 'true'],
                    'new_or_used' => ['title' => 'Select Vehicle Status', 'required' => 'true'],
                    'vin' => ['title' => 'VIN', 'required' => 'true'],
                    'vehicle_type' => ['title' => 'Vehicle Type', 'required' => 'true'],
                    'cc_displacement' => ['title' => 'CC Displacement', 'required' => 'true'],
                    'model_year' => ['title' => 'Model Year', 'required' => 'true'],
                    'street_address' => ['title' => 'Dealer Address', 'required' => 'true'],
                    'zip' => ['title' => 'Zip', 'required' => 'true'],
                    'empty_weight' => ['title' => 'Empty Weight', 'required' => 'true'],
                    /*'trailer_weight' => ['title' => 'Trailer Weight', 'required' => 'true'],*/
                    /*'carrying_capacity' => ['title' => 'Carrying Capacity', 'required' => 'true'],*/
                    /*'gvw' => ['title' => 'GVW', 'required' => 'true'],*/
                    'gvwr' => ['title' => 'GVWR', 'required' => 'true']
                ],
                "TO" => [
                    'transaction_type' => ['title' => 'Transaction Type', 'required' => 'true'],
                    'new_or_used' => ['title' => 'Select Vehicle Status', 'required' => 'true'],
                    'vin' => ['title' => 'VIN', 'required' => 'true'],
                    'vehicle_type' => ['title' => 'Vehicle Type', 'required' => 'true'],
                    'model_year' => ['title' => 'Model Year', 'required' => 'true'],
                    'street_address' => ['title' => 'Dealer Address', 'required' => 'true'],
                    'zip' => ['title' => 'Zip', 'required' => 'true'],
                    'resident_county' => ['label' => 'Select Resident County', 'required' => 'true'],
                    'processing_county' => ['label' => 'Select Processing County', 'required' => 'true'],
                    'empty_weight' => ['title' => 'Empty Weight', 'required' => 'true'],
                    /*'trailer_weight' => ['title' => 'Trailer Weight', 'required' => 'true'],*/
                    /*'carrying_capacity' => ['title' => 'Carrying Capacity', 'required' => 'true'],*/
                    /*'gvw' => ['title' => 'GVW', 'required' => 'true'],*/
                    /*'gvwr' => ['title' => 'GVWR', 'required' => 'true'],*/
                    'inspection_type' => ['title' => 'Select Inspection Type', 'required' => 'true'],
                    /*'freight' => ['title' => 'Freight', 'required' => 'true'],*/
                    'sales_price' => ['title' => 'Sales Price', 'required' => 'true'],
                    'rebate_discount' => ['title' => 'Rebate / Discount', 'required' => 'true'],
                    'trade_in_value' => ['title' => 'Trade-in Value', 'required' => 'true'],
                    'taxable_value' => ['title' => 'Taxable Value ', 'required' => 'true'],
                    'fuel_type' => ['title' => 'Fuel Type', 'required' => 'true'],
                    'date_of_sale' => ['title' => 'Date of Sale', 'required' => 'true'],
                    'miscellaneous_fee' => ['title' => 'Miscellaneous Fees', 'required' => 'true']
                ],
                "TRC" => [
                    'transaction_type' => ['title' => 'Transaction Type', 'required' => 'true'],
                    'new_or_used' => ['title' => 'Select Vehicle Status', 'required' => 'true'],
                    'vin' => ['title' => 'VIN', 'required' => 'true'],
                    'vehicle_type' => ['title' => 'Vehicle Type', 'required' => 'true'],
                    'cc_displacement' => ['title' => 'CC Displacement', 'required' => 'true'],
                    'model_year' => ['title' => 'Model Year', 'required' => 'true'],
                    'street_address' => ['title' => 'Dealer Address', 'required' => 'true'],
                    'zip' => ['title' => 'Zip', 'required' => 'true'],
                    'empty_weight' => ['title' => 'Empty Weight', 'required' => 'true'],
                    /*'trailer_weight' => ['title' => 'Trailer Weight', 'required' => 'true'],*/
                    /*'carrying_capacity' => ['title' => 'Carrying Capacity', 'required' => 'true'],*/
                    /*'gvw' => ['title' => 'GVW', 'required' => 'true'],*/
                    'gvwr' => ['title' => 'GVWR', 'required' => 'true']
                ]
            ],
            'calculator_options' => [
                // List generic fields.
                'no_fees' => ['selected' => 'false'],
                'temp_tag' => ['selected' => 'true'],
                'exempt_from_sales_tax' => ['selected' => 'false'],
                'transfer_plate' => ['selected' => 'false'],
                'vehicle_financed' => ['selected' => 'true'],
                // 'farm_use' => ['selected' => 'false'],
                'add_accessories' => ['selected' => 'true'],
                'add_warranty' => ['selected' => 'true'],
                'include_late_fees' => ['selected' => 'true'],
            ]
        ];
    }
}