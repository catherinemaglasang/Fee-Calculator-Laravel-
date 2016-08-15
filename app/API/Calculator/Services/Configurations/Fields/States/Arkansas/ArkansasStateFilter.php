<?php

namespace Thirty98\API\Calculator\Services\Configurations\Fields\States\Arkansas;

class ArkansasStateFilter
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
                'vin' => [
                    'name' => 'vin',
                    'title' => 'VIN',
                    'display_order' => 2
                ],
                'vehicle_type' => [
                    'name' => 'vehicle_type',
                    'title' => 'Vehicle Type',
                    'display_order' => 3
                ],
                'model_year' => [
                    'name' => 'model_year',
                    'title' => 'Model Year',
                    'display_order' => 4
                ],
                'street_address' => [
                    'name' => 'street_address',
                    'title' => 'Dealer Address',
                    'display_order' => 5
                ],
                'zip' => [
                    'name' => 'zip',
                    'title' => 'Zip',
                    'display_order' => 6
                ],
                'empty_weight' => [
                    'name' => 'empty_weight',
                    'title' => 'Empty Weight',
                    'display_order' => 7
                ],
                'trailer_weight' => [
                    'name' => 'trailer_weight',
                    'title' => 'Trailer Weight',
                    'display_order' => 8
                ],
                'carrying_capacity' => [
                    'name' => 'carrying_capacity',
                    'title' => 'Carrying Capacity',
                    'display_order' => 9
                ],
                'gvw' => [
                    'name' => 'gvw',
                    'title' => 'GCVW',
                    'display_order' => 10
                ],
                'gvwr' => [
                    'name' => 'gvwr',
                    'title' => 'GVWR',
                    'display_order' => 11
                ],
                'number_of_axles' => [
                    'name' => 'number_of_axles',
                    'title' => 'Number of Axles',
                    'display_order' => 12
                ],
                'freight' => [
                    'name' => 'freight',
                    'title' => 'Freight',
                    'display_order' => 13
                ],
                'sales_price' => [
                    'name' => 'sales_price',
                    'title' => 'Sales Price',
                    'display_order' => 14
                ],
                'accessories' => [
                    'name' => 'accessories',
                    'title' => 'Accessories',
                    'display_order' => 15
                ],
                'warranty' => [
                    'name' => 'warranty',
                    'title' => 'Warranty',
                    'display_order' => 16
                ],
                'rebate_discount' => [
                    'name' => 'rebate_discount',
                    'title' => 'Rebate / Discount',
                    'display_order' => 17
                ],
                'trade_in_value' => [
                    'name' => 'trade_in_value',
                    'title' => 'Trade-in Value',
                    'display_order' => 18
                ],
                'taxable_value' => [
                    'name' => 'taxable_value',
                    'title' => 'Taxable Value',
                    'display_order' => 19
                ],
                'date_of_sale' => [
                    'name' => 'date_of_sale',
                    'title' => 'Date of Sale',
                    'display_order' => 20
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
                'exempt_from_sales_tax' => [
                    'name' => 'exempt_from_sales_tax',
                    'title' => 'Exempt From Sales Tax',
                    'display_order' => 3
                ],
                'transfer_plate' => [
                    'name' => 'transfer_plate',
                    'title' => 'Transfer Plate?',
                    'display_order' => 4
                ],
                'vehicle_financed' => [
                    'name' => 'vehicle_financed',
                    'title' => 'Vehicle Financed?',
                    'display_order' => 5
                ],
                'farm_use' => [
                    'name' => 'farm_use',
                    'title' => 'Farm Use?',
                    'display_order' => 6
                ],
                'off_road_motorcycle' => [
                    'name' => 'off_road_motorcycle',
                    'title' => 'Off Road Motorcycle',
                    'display_order' => 7
                ],
                'add_accessories' => [
                    'name' => 'add_accessories',
                    'title' => 'Add Accessories?',
                    'display_order' => 8
                ],
                'add_warranty' => [
                    'name' => 'add_warranty',
                    'title' => 'Add Warranty?',
                    'display_order' => 9
                ],
                'include_late_fees' => [
                    'name' => 'include_late_fees',
                    'title' => 'Include Late Fees?',
                    'display_order' => 10
                ]
            ]
        ];
    }
}