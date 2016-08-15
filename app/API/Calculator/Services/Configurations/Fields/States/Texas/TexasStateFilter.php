<?php

namespace Thirty98\API\Calculator\Services\Configurations\Fields\States\Texas;

class TexasStateFilter
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
                    'display_order' => $state_fields['form_fields'][$data]['display_order']
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
                    'display_order' => $state_fields['calculator_options'][$data]['display_order']
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
                    'display_order' => 1
                ],
                'new_or_used' => [
                    'name' => 'new_or_used',
                    'title' => 'New or Used',
                    'display_order' => 2
                ],
                'vin' => [
                    'name' => 'vin',
                    'title' => 'VIN',
                    'display_order' => 3
                ],
                'vehicle_type' => [
                    'name' => 'vehicle_type',
                    'title' => 'Vehicle Type',
                    'display_order' => 4
                ],
                'model_year' => [
                    'name' => 'model_year',
                    'title' => 'Model Year',
                    'display_order' => 5
                ],
                'street_address' => [
                    'name' => 'street_address',
                    'title' => 'Dealer Address',
                    'display_order' => 6
                ],
                'zip' => [
                    'name' => 'zip',
                    'title' => 'Zip',
                    'display_order' => 7
                ],
                'resident_county' => [
                    'name' => 'resident_county',
                    'title' => 'Resident County',
                    'display_order' => 8
                ],
                'processing_county' => [
                    'name' => 'processing_county',
                    'title' => 'Processing County',
                    'display_order' => 9
                ],
                'empty_weight' => [
                    'name' => 'empty_weight',
                    'title' => 'Empty Weight',
                    'display_order' => 10
                ],
                'trailer_weight' => [
                    'name' => 'trailer_weight',
                    'title' => 'Trailer Weight',
                    'display_order' => 11
                ],
                'carrying_capacity' => [
                    'name' => 'carrying_capacity',
                    'title' => 'Carrying Capacity',
                    'display_order' => 12
                ],
                'gvw' => [
                    'name' => 'gvw',
                    'title' => 'GVW',
                    'display_order' => 13
                ],
                'gvwr' => [
                    'name' => 'gvwr',
                    'title' => 'GVWR',
                    'display_order' => 14
                ],
                'inspection_type' => [
                    'name' => 'inspection_type',
                    'title' => 'Select Inspection Type',
                    'display_order' => 15
                ],
                'freight' => [
                    'name' => 'freight',
                    'title' => 'Freight',
                    'display_order' => 16
                ],
                'sales_price' => [
                    'name' => 'sales_price',
                    'title' => 'Sales Price',
                    'display_order' => 17
                ],
                'rebate_discount' => [
                    'name' => 'rebate_discount',
                    'title' => 'Rebate / Discount',
                    'display_order' => 18
                ],
                'trade_in_value' => [
                    'name' => 'trade_in_value',
                    'title' => 'Trade-in Value',
                    'display_order' => 19
                ],
                'taxable_value' => [
                    'name' => 'taxable_value',
                    'title' => 'Taxable Value',
                    'display_order' => 20
                ],
                'miscellaneous_fee' => [
                    'name' => 'miscellaneous_fee',
                    'title' => 'Miscellaneous Fees',
                    'display_order' => 21
                ],
                'fuel_type' => [
                    'name' => 'fuel_type',
                    'title' => 'Fuel Type',
                    'display_order' => 22
                ],
                'date_of_sale' => [
                    'name' => 'date_of_sale',
                    'title' => 'Date of Sale',
                    'display_order' => 23
                ]
            ],
            'calculator_options' => [
                'no_fees' => [
                    'name' => 'no_fees',
                    'title' => 'No Fees',
                    'display_order' => 1
                ],
                'temp_tag' => [
                    'name' => 'temp_tag',
                    'title' => 'Temp Tag',
                    'display_order' => 2
                ],
                'is_trade_in_leased' => [
                    'name' => 'is_trade_in_leased',
                    'title' => 'Temp Tag',
                    'display_order' => 3
                ],
                'farm_use' => [
                    'name' => 'farm_use',
                    'title' => 'Farm Use?',
                    'display_order' => 4
                ],
                'member_of_military' => [
                    'name' => 'member_of_military',
                    'title' => 'Member of Military',
                    'display_order' => 5
                ],
                'off_highway_use' => [
                    'name' => 'off_highway_use',
                    'title' => 'Off Highway Use',
                    'display_order' => 6
                ],
                'rebuilt_salvage' => [
                    'name' => 'rebuilt_salvage',
                    'title' => 'Rebuilt/Salvage',
                    'display_order' => 7
                ],
                'exempt_from_sales_tax' => [
                    'name' => 'exempt_from_sales_tax',
                    'title' => 'Exempt From Sales Tax',
                    'display_order' => 8
                ],
                'did_pull_a_trailer' => [
                    'name' => 'did_pull_a_trailer',
                    'title' => 'Do you ever pull a Trailer?',
                    'display_order' => 9
                ],
                'include_inspection_fee' => [
                    'name' => 'include_inspection_fee',
                    'title' => 'Include Inspection Fees?',
                    'display_order' => 10
                ],
                'include_vit_tax' => [
                    'name' => 'include_vit_tax',
                    'title' => 'Include VIT Tax?',
                    'display_order' => 11
                ],
                'include_late_fees' => [
                    'name' => 'include_late_fees',
                    'title' => 'Include Late Fees?',
                    'display_order' => 12
                ]
            ]
        ];
    }
}