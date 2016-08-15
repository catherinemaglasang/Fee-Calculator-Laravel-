<?php

namespace Thirty98\API\Calculator\Services\Configurations\Fields\States\Texas;

class TexasTransactionTypeFilter
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
                    'new_or_used' => ['title' => 'Select Vehicle Status', 'required' => 'true'],
                    'vin' => ['title' => 'VIN', 'required' => 'true'],
                    'vehicle_type' => ['title' => 'Vehicle Type', 'required' => 'true'],
                    'model_year' => ['title' => 'Model Year', 'required' => 'true'],
                    'street_address' => ['title' => 'Dealer Address', 'required' => 'false'],
                    'zip' => ['title' => 'Zip', 'required' => 'false'],
                    'resident_county' => ['label' => 'Select Resident County', 'required' => 'false'],
                    'processing_county' => ['label' => 'Select Processing County', 'required' => 'true'],
                    'empty_weight' => ['title' => 'Empty Weight', 'required' => 'true'],
                    'trailer_weight' => ['title' => 'Trailer Weight', 'required' => 'false'],
                    'carrying_capacity' => ['title' => 'Carrying Capacity', 'required' => 'false'],
                    'gvw' => ['title' => 'GVW', 'required' => 'false'],
                    'gvwr' => ['title' => 'GVWR', 'required' => 'false'],
                    'inspection_type' => ['title' => 'Select Inspection Type', 'required' => 'false'],
                    'freight' => ['title' => 'Freight', 'required' => 'false'],
                    'sales_price' => ['title' => 'Sales Price', 'required' => 'false'],
                    'rebate_discount' => ['title' => 'Rebate / Discount', 'required' => 'false'],
                    'trade_in_value' => ['title' => 'Trade-in Value', 'required' => 'false'],
                    'taxable_value' => ['title' => 'Taxable Value ', 'required' => 'false'],
                    'fuel_type' => ['title' => 'Fuel Type', 'required' => 'false'],
                    'date_of_sale' => ['title' => 'Date of Sale', 'required' => 'false'],
                    'miscellaneous_fee' => ['title' => 'Miscellaneous Fees', 'required' => 'false']
                ],
                "TP" => [
                    'transaction_type' => ['title' => 'Transaction Type', 'required' => 'true'],
                    'new_or_used' => ['title' => 'Select Vehicle Status', 'required' => 'true'],
                    'vin' => ['title' => 'VIN', 'required' => 'true'],
                    'vehicle_type' => ['title' => 'Vehicle Type', 'required' => 'true'],
                    'model_year' => ['title' => 'Model Year', 'required' => 'true'],
                    'street_address' => ['title' => 'Dealer Address', 'required' => 'false'],
                    'zip' => ['title' => 'Zip', 'required' => 'false'],
                    'resident_county' => ['label' => 'Select Resident County', 'required' => 'false'],
                    'processing_county' => ['label' => 'Select Processing County', 'required' => 'true'],
                    'empty_weight' => ['title' => 'Empty Weight', 'required' => 'true'],
                    'trailer_weight' => ['title' => 'Trailer Weight', 'required' => 'false'],
                    'carrying_capacity' => ['title' => 'Carrying Capacity', 'required' => 'false'],
                    'gvw' => ['title' => 'GVW', 'required' => 'false'],
                    'gvwr' => ['title' => 'GVWR', 'required' => 'false'],
                    'inspection_type' => ['title' => 'Select Inspection Type', 'required' => 'true'],
                    'freight' => ['title' => 'Freight', 'required' => 'false'],
                    'sales_price' => ['title' => 'Sales Price', 'required' => 'true'],
                    'rebate_discount' => ['title' => 'Rebate / Discount', 'required' => 'true'],
                    'trade_in_value' => ['title' => 'Trade-in Value', 'required' => 'true'],
                    'taxable_value' => ['title' => 'Taxable Value ', 'required' => 'false'],
                    'fuel_type' => ['title' => 'Fuel Type', 'required' => 'true'],
                    'date_of_sale' => ['title' => 'Date of Sale', 'required' => 'false'],
                    'miscellaneous_fee' => ['title' => 'Miscellaneous Fees', 'required' => 'false']
                ],
                "DT" => [
                    'transaction_type' => ['title' => 'Transaction Type', 'required' => 'true'],
                    'new_or_used' => ['title' => 'Select Vehicle Status', 'required' => 'true'],
                    'vin' => ['title' => 'VIN', 'required' => 'true'],
                    'vehicle_type' => ['title' => 'Vehicle Type', 'required' => 'true'],
                    'model_year' => ['title' => 'Model Year', 'required' => 'true'],
                    'miscellaneous_fee' => ['title' => 'Miscellaneous Fees', 'required' => 'false']
                ],
                "TO" => [
                    'transaction_type' => ['title' => 'Transaction Type', 'required' => 'true'],
                    'new_or_used' => ['title' => 'Select Vehicle Status', 'required' => 'true'],
                    'vin' => ['title' => 'VIN', 'required' => 'true'],
                    'vehicle_type' => ['title' => 'Vehicle Type', 'required' => 'true'],
                    'model_year' => ['title' => 'Model Year', 'required' => 'true'],
                    'street_address' => ['title' => 'Dealer Address', 'required' => 'false'],
                    'zip' => ['title' => 'Zip', 'required' => 'false'],
                    'resident_county' => ['label' => 'Select Resident County', 'required' => 'false'],
                    'processing_county' => ['label' => 'Select Processing County', 'required' => 'true'],
                    'empty_weight' => ['title' => 'Empty Weight', 'required' => 'true'],
                    'trailer_weight' => ['title' => 'Trailer Weight', 'required' => 'false'],
                    'carrying_capacity' => ['title' => 'Carrying Capacity', 'required' => 'false'],
                    'gvw' => ['title' => 'GVW', 'required' => 'false'],
                    'gvwr' => ['title' => 'GVWR', 'required' => 'false'],
                    'inspection_type' => ['title' => 'Select Inspection Type', 'required' => 'true'],
                    'freight' => ['title' => 'Freight', 'required' => 'false'],
                    'sales_price' => ['title' => 'Sales Price', 'required' => 'true'],
                    'rebate_discount' => ['title' => 'Rebate / Discount', 'required' => 'true'],
                    'trade_in_value' => ['title' => 'Trade-in Value', 'required' => 'true'],
                    'taxable_value' => ['title' => 'Taxable Value ', 'required' => 'false'],
                    'fuel_type' => ['title' => 'Fuel Type', 'required' => 'true'],
                    'date_of_sale' => ['title' => 'Date of Sale', 'required' => 'false'],
                    'miscellaneous_fee' => ['title' => 'Miscellaneous Fees', 'required' => 'false']
                ],
                "RO" => [
                    'transaction_type' => ['title' => 'Transaction Type', 'required' => 'true'],
                    'new_or_used' => ['title' => 'Select Vehicle Status', 'required' => 'true'],
                    'vin' => ['title' => 'VIN', 'required' => 'true'],
                    'vehicle_type' => ['title' => 'Vehicle Type', 'required' => 'true'],
                    'model_year' => ['title' => 'Model Year', 'required' => 'true'],
                    'street_address' => ['title' => 'Dealer Address', 'required' => 'false'],
                    'zip' => ['title' => 'Zip', 'required' => 'false'],
                    'resident_county' => ['label' => 'Select Resident County', 'required' => 'false'],
                    'processing_county' => ['label' => 'Select Processing County', 'required' => 'true'],
                    'empty_weight' => ['title' => 'Empty Weight', 'required' => 'true'],
                    'trailer_weight' => ['title' => 'Trailer Weight', 'required' => 'false'],
                    'carrying_capacity' => ['title' => 'Carrying Capacity', 'required' => 'false'],
                    'gvw' => ['title' => 'GVW', 'required' => 'false'],
                    'gvwr' => ['title' => 'GVWR', 'required' => 'false'],
                    'inspection_type' => ['title' => 'Select Inspection Type', 'required' => 'true'],
                    'fuel_type' => ['title' => 'Fuel Type', 'required' => 'true'],
                    'date_of_sale' => ['title' => 'Date of Sale', 'required' => 'false'],
                    'miscellaneous_fee' => ['title' => 'Miscellaneous Fees', 'required' => 'false']
                ],
                "TRC" => [
                    'transaction_type' => ['title' => 'Transaction Type', 'required' => 'true'],
                    'new_or_used' => ['title' => 'Select Vehicle Status', 'required' => 'true'],
                    'vin' => ['title' => 'VIN', 'required' => 'true'],
                    'vehicle_type' => ['title' => 'Vehicle Type', 'required' => 'true'],
                    'model_year' => ['title' => 'Model Year', 'required' => 'true']
                ]
            ],
            'calculator_options' => [
                // List generic fields.
                'no_fees' => ['selected' => 'false'],
                'temp_tag' => ['selected' => 'true'],
                'is_trade_in_leased' => ['selected' => 'false'],
                'member_of_military' => ['selected' => 'false'],
                'off_highway_use' => ['selected' => 'false'],
                'rebuilt_salvage' => ['selected' => 'false'],
                'exempt_from_sales_tax' => ['selected' => 'false'],
                'include_inspection_fee' => ['selected' => 'false'],
                'include_vit_tax' => ['selected' => 'false'],
                'include_late_fees' => ['selected' => 'true'],
            ]
        ];
    }
}