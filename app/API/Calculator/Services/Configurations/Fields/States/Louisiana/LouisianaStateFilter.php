<?php

namespace Thirty98\API\Calculator\Services\Configurations\Fields\States\Louisiana;

class LouisianaStateFilter
{
    public function filter($master_fields)
    {
        $input_fields = $master_fields['form_fields'];
        $option_fields = $master_fields['calculator_options'];

        $state_fields = $this->getStateFields();

        foreach ($input_fields as $key => $data) {
            if (!isset($state_fields['form_fields'][$data])) {
                unset($input_fields[$key]);
            } else {
                $input_fields[$key] = [
                    'name' => $state_fields['form_fields'][$data]['name'],
                    'title' => $state_fields['form_fields'][$data]['title'],
                    'display_order' => $state_fields['form_fields'][$data]['display_order'],
                    'field_type' => $state_fields['form_fields'][$data]['field_type']
                ];
            }
        }

        foreach ($option_fields as $key => $data) {
            if (!isset($state_fields['calculator_options'][$data])) {
                unset($option_fields[$key]);
            } else {
                $option_fields[$key] = [
                    'name' => $state_fields['calculator_options'][$data]['name'],
                    'title' => $state_fields['calculator_options'][$data]['title'],
                    'display_order' => $state_fields['calculator_options'][$data]['display_order'],
                    'field_type' => $state_fields['calculator_options'][$data]['field_type'],
                    'default' => $state_fields['calculator_options'][$data]['default'],
                ];
            }
        }

        $master_fields = [
            'form_fields' => $input_fields,
            'calculator_options' => $option_fields
        ];

        return $master_fields;
    }


    /**
     * Unique for every State filter.
     *
     * Sets name and title.
     * Transaction type filter will filter required and will remmove non required fields
     *
     * @return array
     */
    public function getStateFields()
    {
        return [
            'form_fields' => [
                'transaction_type' => [
                    'name' => 'transaction_type',
                    'title' => 'Transaction Type',
                    'display_order' => 1,
                    'field_type' => 'dropdown'
                ],
                'vehicle_type' => [
                    'name' => 'vehicle_type',
                    'title' => 'Vehicle Type',
                    'display_order' => 2,
                    'field_type' => 'dropdown'
                ],
                'type_of_plate' => [
                    'name' => 'type_of_plate',
                    'title' => 'Type of Plate',
                    'display_order' => 3,
                    'field_type' => 'dropdown'
                ],
                'vin' => [
                    'name' => 'vin',
                    'title' => 'Enter VIN #',
                    'display_order' => 4,
                    'field_type' => 'input'
                ],
                'model_year' => [
                    'name' => 'model_year',
                    'title' => 'Model Year',
                    'display_order' => 5,
                    'field_type' => 'dropdown'
                ],
                'mortgage_fee' => [
                    'name' => 'mortgage_fee',
                    'title' => 'Mortgage Fee',
                    'display_order' => 6,
                    'field_type' => 'dropdown'
                ],
                'street_address' => [
                    'name' => 'street_address',
                    'title' => 'Street Address',
                    'display_order' => 7,
                    'field_type' => 'input'
                ],
                'zip' => [
                    'name' => 'zip',
                    'title' => 'Zip',
                    'display_order' => 8,
                    'field_type' => 'input'
                ],
                'county' => [
                    'name' => 'county',
                    'title' => 'Select Parish',
                    'display_order' => 9,
                    'field_type' => 'dropdown'
                ],
                'city_limits' => [
                    'name' => 'city_limits',
                    'title' => 'City Limits?',
                    'display_order' => 10,
                    'field_type' => 'radio'
                ],
                'number_of_passengers' => [
                    'name' => 'number_of_passengers',
                    'title' => 'No of Passengers?',
                    'display_order' => 11,
                    'field_type' => 'input'
                ],
                'empty_weight' => [
                    'name' => 'empty_weight',
                    'title' => 'Empty Weight',
                    'display_order' => 12,
                    'field_type' => 'input'
                ],
                'trailer_weight' => [
                    'name' => 'trailer_weight',
                    'title' => 'Trailer Weight',
                    'display_order' => 13,
                    'field_type' => 'input'
                ],
                'carrying_capacity' => [
                    'name' => 'carrying_capacity',
                    'title' => 'Carrying Capacity',
                    'display_order' => 14,
                    'field_type' => 'input'
                ],
                'gvw' => [
                    'name' => 'gvw',
                    'title' => 'GCVW',
                    'display_order' => 15,
                    'field_type' => 'input'
                ],
                'gvwr' => [
                    'name' => 'gvwr',
                    'title' => 'GVWR',
                    'display_order' => 16,
                    'field_type' => 'input'
                ],
                'sales_price' => [
                    'name' => 'sales_price',
                    'title' => 'Sales Price',
                    'display_order' => 17,
                    'field_type' => 'input'
                ],
                'rebate_discount' => [
                    'name' => 'rebate_discount',
                    'title' => 'Rebate / Discount',
                    'display_order' => 18,
                    'field_type' => 'input'
                ],
                'trade_in_value' => [
                    'name' => 'trade_in_value',
                    'title' => 'Trade-in Value',
                    'display_order' => 19,
                    'field_type' => 'input'
                ],
                /*'sales_tax_credit' => [
                    'name' => 'sales_tax_credit',
                    'title' => 'Sales Tax Credit',
                    'display_order' => 20,
                    'field_type' => 'input'
                ],*/
                'taxable_value' => [
                    'name' => 'taxable_value',
                    'title' => 'Taxable Value',
                    'display_order' => 21,
                    'field_type' => 'input'
                ],
                'date_of_sale' => [
                    'name' => 'date_of_sale',
                    'title' => 'Date of Sale',
                    'display_order' => 22,
                    'field_type' => 'date'
                ]
            ],
            'calculator_options' => [
                'no_fees' => [
                    'name' => 'no_fees',
                    'title' => 'No Fees',
                    'display_order' => 1,
                    'field_type' => 'checkbox',
                    'default' => false
                ],
                'temp_tag' => [
                    'name' => 'temp_tag',
                    'title' => 'Temp Tag',
                    'display_order' => 2,
                    'field_type' => 'checkbox',
                    'default' => true
                ],
                'farm_use' => [
                    'name' => 'farm_use',
                    'title' => 'Farm Use?',
                    'display_order' => 3,
                    'field_type' => 'checkbox',
                    'default' => false
                ],
                'did_pull_a_trailer' => [
                    'name' => 'did_pull_a_trailer',
                    'title' => 'Do you ever pull a Trailer?',
                    'display_order' => 4,
                    'field_type' => 'checkbox',
                    'default' => false
                ],
                'exempt_from_sales_tax' => [
                    'name' => 'exempt_from_sales_tax',
                    'title' => 'Exempt From Sales Tax',
                    'display_order' => 5,
                    'field_type' => 'checkbox',
                    'default' => false
                ],
                'include_late_fees' => [
                    'name' => 'include_late_fees',
                    'title' => 'Include Late Fees?',
                    'display_order' => 6,
                    'field_type' => 'checkbox',
                    'default' => true
                ]
            ]
        ];
    }
}