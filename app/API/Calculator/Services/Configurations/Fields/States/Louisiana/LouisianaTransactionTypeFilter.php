<?php

namespace Thirty98\API\Calculator\Services\Configurations\Fields\States\Louisiana;

class LouisianaTransactionTypeFilter
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
                /*$master_fields['form_fields'][$key]['field_type'] = $field_type;*/
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

                /*$master_fields['calculator_options'][$key]['selected'] = $selected;*/
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
                    'transaction_type' => ['required' => 'true'],
                    'type_of_plate' => ['required' => 'true'],
                    'vin' => ['required' => 'true'],
                    'vehicle_type' => ['required' => 'true'],
                    'model_year' => ['required' => 'true'],
                    'mortgage_fee' => ['required' => 'false'],
                    'street_address' => ['required' => 'true'],
                    'zip' => ['required' => 'true'],
                    'county' => ['required' => 'true'],
                    'city_limits' => ['required' => 'true'],

                    // Add these field depending on vehicle type
                    /*'empty_weight' => ['required' => 'true'],
                    'trailer_weight' => ['required' => 'false'],
                    'carrying_capacity' => ['required' => 'false'],
                    'gvw' => ['required' => 'false'],*/


                    'sales_price' => ['required' => 'true'],
                    'rebate_discount' => ['required' => 'true'],
                    'trade_in_value' => ['required' => 'true'],
                    'taxable_value' => ['required' => 'true'],
                    'sales_tax_credit' => ['required' => 'true'],
                    'date_of_sale' => ['required' => 'true']
                ],
                "TP" => [
                    'transaction_type' => ['required' => 'true'],
                    'type_of_plate' => ['required' => 'true'],
                    'vin' => ['required' => 'true'],
                    'vehicle_type' => ['required' => 'true'],
                    'model_year' => ['required' => 'true'],
                    'mortgage_fee' => ['required' => 'false'],
                    'street_address' => ['required' => 'true'],
                    'zip' => ['required' => 'true'],
                    'county' => ['required' => 'false'],
                    'city_limits' => ['title' => 'City Limits?', 'required' => 'false'],

                    // Add these fields based on vehicle type.
                    /*'empty_weight' => ['required' => 'true'],
                    'trailer_weight' => ['required' => 'false'],
                    'carrying_capacity' => ['required' => 'false'],
                    'gvw' => ['required' => 'false'],*/
                    'sales_price' => ['required' => 'true'],
                    'rebate_discount' => ['required' => 'false'],
                    'trade_in_value' => ['required' => 'false'],
                    'taxable_value' => ['required' => 'false'],
                    'sales_tax_credit' => ['required' => 'false'],
                    'date_of_sale' => ['required' => 'false']
                ],
                "DT" => [
                    'transaction_type' => ['required' => 'true'],
                    'type_of_plate' => ['required' => 'true'],
                    'vin' => ['required' => 'true'],
                    'vehicle_type' => ['required' => 'true'],
                    'model_year' => ['required' => 'true'],
                ],
                "TRC" => [
                    'transaction_type' => ['required' => 'true'],
                    'type_of_plate' => ['required' => 'true'],
                    'vin' => ['required' => 'true'],
                    'vehicle_type' => ['required' => 'true'],
                    'model_year' => ['required' => 'true'],
                ]
            ],
            'calculator_options' => [
                // Add default selected and not.
                'no_fees' => ['selected' => 'false'],
                'temp_tag' => ['selected' => 'true'],


                // 'farm_use' => ['selected' => 'false'],

                # Both of these options need to  be included in trucks or boat trailers.
                /*'farm_use' => [
                    'name' => 'farm_use',
                    'title' => 'Farm Use?'
                ],
                'did_pull_a_trailer' => [
                    'name' => 'did_pull_a_trailer',
                    'title' => 'Do you ever pull a Trailer?'
                ],*/


                'exempt_from_sales_tax' => ['selected' => 'false'],
                'include_late_fees' => ['selected' => 'true']
            ]
        ];
    }
}