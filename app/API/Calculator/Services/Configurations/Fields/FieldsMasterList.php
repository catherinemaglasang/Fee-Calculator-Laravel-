<?php

namespace Thirty98\API\Calculator\Services\Configurations\Fields;

class FieldsMasterList
{
    public static function getFieldMasterList()
    {
        /**
         * Notes:
         * A field may have new descriptions depending on the state. (Modify them dynamically)
         */
        return [
            'form_fields' => [
                // LA fields
                'transaction_type',
                'type_of_plate',
                'vin',
                'vehicle_type',
                'model_year',
                'mortgage_fee',
                'street_address',
                'zip',
                'county',
                'city_limits',
                'number_of_passengers',
                'empty_weight',
                'trailer_weight',
                'carrying_capacity',
                'gvw',
                'gvwr',
                'sales_price',
                'rebate_discount',
                'trade_in_value',
                'sales_tax_credit',
                'taxable_value',
                'date_of_sale',

                // TX Fields
                // transaction type -- present
                'new_or_used',
                // vin -- present
                // model_year -- present
                // dealer_address -- present
                // zip -- present
                'resident_county',
                'processing_county',
                // empty_weight -- present
                // trailer_weight -- present
                // carrying_capacity -- present
                // 'gvw', -- present
                // 'gvwr', -- present
                'inspection_type',
                'freight',
                'miscellaneous_fee',
                'fuel_type',
                // date_of_sale -- present

                // Arkansas Fields.
                // transaction type -- present.
                // vin -- present
                // 'vehicle_type',-- present
                // 'model_year',-- present
                // dealer_address -- present
                // zip -- present
                // empty_weight -- present
                // trailer_weight -- present
                // carrying_capacity -- present
                // 'gvw', -- present
                // 'gvwr', -- present
                'number_of_axles',
                'accessories',
                'warranty'
                // rebate_discount -- present
                // trade_in_value -- present
                // taxable_value -- present
                // date_of_sale -- present
            ],
            'calculator_options' => [
                // Louisiana
                'no_fees',
                'temp_tag',
                'farm_use',
                'did_pull_a_trailer',
                'exempt_from_sales_tax',
                'include_late_fees',

                // Texas
                // 'no_fees', -- present
                // 'temp_tag', -- present
                'is_trade_in_leased',
                'farm_ranch',
                'member_of_military',
                'off_highway_use',
                'rebuilt_salvage',
                // exempt_from_sales_tax -- present
                // did_pull_a_trailer -- present
                'include_inspection_fee',
                'include_vit_tax',
                // include_late_fees -- present

                // Arkansas
                // 'no_fees', -- present
                // 'temp_tag', -- present
                // exempt_from_sales_tax -- present
                'transfer_plate',
                'vehicle_financed',
                // farm_use -- present
                'off_road_motorcycle',
                'add_accessories',
                'add_warranty',
                // include_late_fees -- present
            ]
        ];
    }
}