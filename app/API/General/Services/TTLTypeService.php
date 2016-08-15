<?php

namespace Thirty98\API\General\Services;

use Thirty98\API\General\Models\TtlType;
use Illuminate\Support\Facades\DB;

class TTLTypeService
{
    protected $model;

    public function __construct(TtlType $model)
    {
        $this->model = $model;
    }

    public function fetchByCode($code)
    {
        return $this->model->where('code', $code)->first();
    }

    /**
     * This is only a temporary code
     *
     * @param string $state
     * @param string $ttl_type
     * @return Array
     */
    public function getFeeCalculationConfig($state, $ttl_type)
    {
        return ['calc_config' => $this->rules()[$state][$ttl_type]];
    }

    public function fetchByState($state)
    {
        $types = $this->rules();
        if (!array_key_exists($state, $types)) {
            return [];
        }

        return $types[$state];
    }

    public function rules()
    {
        return [
            'LA' => [
                    "NR"    => [
                        'document_fee'              => true,
                        'title_fee'                 => true,
                        'duplicate_title_fee'       => false,
                        'title_correction_fee'      => false,
                        'mortgage_fee'              => true,
                        'license_fee'               => true,
                        'license_transfer_fee'      => false,
                        'license_credit_fee'        => true,
                        'license_credit_penalty'    => true,
                        'handling_fee'              => true,
                        'tow_fee'                   => true,
                        'notary_fee'                => true,
                        'miscellaneous_fee'         => true,
                        'sales_tax'                 => true,
                        'sales_tax_penalty'         => true,
                        'interest'                  => true,
                        'convenience_fee'           => true,
                        'processing_fee'            => true,
                        'mail_fee'                  => true,
                        'vendors_comp'              => true,
                        'electronic_filing_fee'     => true
                    ],
                    "TP"    => [
                        'document_fee'              => true,
                        'title_fee'                 => true,
                        'duplicate_title_fee'       => false,
                        'title_correction_fee'      => false,
                        'mortgage_fee'              => true,
                        'license_fee'               => false,
                        'license_transfer_fee'      => true,
                        'license_credit_fee'        => true,
                        'license_credit_penalty'    => true,
                        'handling_fee'              => true,
                        'tow_fee'                   => true,
                        'notary_fee'                => true,
                        'miscellaneous_fee'         => true,
                        'sales_tax'                 => true,
                        'sales_tax_penalty'         => true,
                        'interest'                  => true,
                        'convenience_fee'           => true,
                        'processing_fee'            => true,
                        'mail_fee'                  => true,
                        'vendors_comp'              => true,
                        'electronic_filing_fee'     => true
                    ],
                    "DT"    => [
                        'document_fee'              => true,
                        'title_fee'                 => false,
                        'duplicate_title_fee'       => true,
                        'title_correction_fee'      => false,
                        'mortgage_fee'              => false,
                        'license_fee'               => false,
                        'license_transfer_fee'      => false,
                        'license_credit_fee'        => false,
                        'license_credit_penalty'    => false,
                        'handling_fee'              => true,
                        'tow_fee'                   => false,
                        'notary_fee'                => true,
                        'miscellaneous_fee'         => false,
                        'sales_tax'                 => false,
                        'sales_tax_penalty'         => false,
                        'interest'                  => false,
                        'convenience_fee'           => true,
                        'processing_fee'            => true,
                        'mail_fee'                  => true,
                        'vendors_comp'              => false,
                        'electronic_filing_fee'     => false
                    ],
                    "TRC"   => [
                        'document_fee'              => true,
                        'title_fee'                 => true,
                        'duplicate_title_fee'       => false,
                        'title_correction_fee'      => false,
                        'mortgage_fee'              => true,
                        'license_fee'               => true,
                        'license_transfer_fee'      => false,
                        'license_credit_fee'        => true,
                        'license_credit_penalty'    => true,
                        'handling_fee'              => true,
                        'tow_fee'                   => true,
                        'notary_fee'                => true,
                        'miscellaneous_fee'         => true,
                        'sales_tax'                 => true,
                        'sales_tax_penalty'         => true,
                        'interest'                  => true,
                        'convenience_fee'           => true,
                        'processing_fee'            => true,
                        'mail_fee'                  => true,
                        'vendors_comp'              => true,
                        'electronic_filing_fee'     => false
                    ],
                    "RR"    => [
                        'document_fee'              => true,
                        'title_fee'                 => true,
                        'duplicate_title_fee'       => false,
                        'title_correction_fee'      => false,
                        'mortgage_fee'              => true,
                        'license_fee'               => true,
                        'license_transfer_fee'      => false,
                        'license_credit_fee'        => true,
                        'license_credit_penalty'    => true,
                        'handling_fee'              => true,
                        'tow_fee'                   => true,
                        'notary_fee'                => true,
                        'miscellaneous_fee'         => true,
                        'sales_tax'                 => true,
                        'sales_tax_penalty'         => true,
                        'interest'                  => true,
                        'convenience_fee'           => true,
                        'processing_fee'            => true,
                        'mail_fee'                  => true,
                        'vendors_comp'              => true
                    ]
                ],
                'TX' => [
                    "NR"    => [
                        'document_fee'              => true,
                        'title_fee'                 => true,
                        'duplicate_title_fee'       => true,
                        'license_fee'               => true, //registration_fee
                        'automation_fee'            => true,
                        'reg_dps_fee'               => true,
                        'local_fee'                 => true,
                        'temp_tag_fee'              => true,
                        'diesel_fee'                => true,
                        'reg_inspection_fee'        => true,
                        'young_farmer_fee'          => true,
                        'inspection_fee'            => true,
                        'miscellaneous_fee'         => true,
                        'rebuit_salvage_fee'        => true,
                        'deputy_fee'                => true,
                        'dealer_late_penalty'       => true,
                        'individual_late_penalty'   => true,
                        'sales_tax'                 => true,
                        'sales_tax_penalty'         => true,
                        'new_registration_tax'      => true,
                        'gift_tax'                  => true,
                        'even_trade_tax'            => true,
                        'emission_fee'              => true,
                        'emissions_surcharge'       => true,
                        'dealer_inventory_tax'      => true
                    ],
                    "TP"    => [
                        'document_fee'              => true,
                        'title_fee'                 => true,
                        'duplicate_title_fee'       => false,
                        'license_fee'               => false, //registration_fee
                        'automation_fee'            => false,
                        'reg_dps_fee'               => false,
                        'local_fee'                 => false,
                        'temp_tag_fee'              => true,
                        'diesel_fee'                => true,
                        'reg_inspection_fee'        => true,
                        'young_farmer_fee'          => true,
                        'inspection_fee'            => true,
                        'miscellaneous_fee'         => true,
                        'rebuit_salvage_fee'        => true,
                        'deputy_fee'                => true,
                        'dealer_late_penalty'       => true,
                        'individual_late_penalty'   => true,
                        'sales_tax'                 => true,
                        'sales_tax_penalty'         => true,
                        'new_registration_tax'      => true,
                        'gift_tax'                  => true,
                        'even_trade_tax'            => true,
                        'emission_fee'              => true,
                        'emissions_surcharge'       => true,
                        'dealer_inventory_tax'      => true
                    ],
                    "DT"    => [
                        'document_fee'              => false,
                        'title_fee'                 => true,
                        'duplicate_title_fee'       => true,
                        'license_fee'               => false, //registration_fee
                        'automation_fee'            => false,
                        'reg_dps_fee'               => false,
                        'local_fee'                 => false,
                        'temp_tag_fee'              => false,
                        'diesel_fee'                => false,
                        'reg_inspection_fee'        => false,
                        'young_farmer_fee'          => false,
                        'inspection_fee'            => false,
                        'miscellaneous_fee'         => false,
                        'rebuit_salvage_fee'        => false,
                        'deputy_fee'                => false,
                        'dealer_late_penalty'       => false,
                        'individual_late_penalty'   => false,
                        'sales_tax'                 => false,
                        'sales_tax_penalty'         => false,
                        'new_registration_tax'      => false,
                        'gift_tax'                  => false,
                        'even_trade_tax'            => false,
                        'emission_fee'              => false,
                        'emissions_surcharge'       => false,
                        'dealer_inventory_tax'      => false
                    ],
                    "TO"    => [
                        'document_fee'              => true,
                        'title_fee'                 => true,
                        'duplicate_title_fee'       => true,
                        'license_fee'               => false, //registration_fee
                        'automation_fee'            => true,
                        'reg_dps_fee'               => true,
                        'local_fee'                 => true,
                        'temp_tag_fee'              => true,
                        'diesel_fee'                => true,
                        'reg_inspection_fee'        => true,
                        'young_farmer_fee'          => true,
                        'inspection_fee'            => true,
                        'miscellaneous_fee'         => true,
                        'rebuit_salvage_fee'        => true,
                        'deputy_fee'                => true,
                        'dealer_late_penalty'       => true,
                        'individual_late_penalty'   => true,
                        'sales_tax'                 => true,
                        'sales_tax_penalty'         => true,
                        'new_registration_tax'      => true,
                        'gift_tax'                  => true,
                        'even_trade_tax'            => true,
                        'emission_fee'              => true,
                        'emissions_surcharge'       => true,
                        'dealer_inventory_tax'      => true
                    ],
                    "RO"    => [
                        'document_fee'              => true,
                        'title_fee'                 => true,
                        'duplicate_title_fee'       => true,
                        'license_fee'               => false, //registration_fee
                        'automation_fee'            => true,
                        'reg_dps_fee'               => true,
                        'local_fee'                 => true,
                        'temp_tag_fee'              => true,
                        'diesel_fee'                => true,
                        'reg_inspection_fee'        => true,
                        'young_farmer_fee'          => true,
                        'inspection_fee'            => true,
                        'miscellaneous_fee'         => true,
                        'rebuit_salvage_fee'        => true,
                        'deputy_fee'                => true,
                        'dealer_late_penalty'       => true,
                        'individual_late_penalty'   => true,
                        'sales_tax'                 => true,
                        'sales_tax_penalty'         => true,
                        'new_registration_tax'      => true,
                        'gift_tax'                  => true,
                        'even_trade_tax'            => true,
                        'emission_fee'              => true,
                        'emissions_surcharge'       => true,
                        'dealer_inventory_tax'      => true
                    ],
                    "TRC"   => [
                        'document_fee'              => true,
                        'title_fee'                 => true,
                        'duplicate_title_fee'       => true,
                        'license_fee'               => false, //registration_fee
                        'automation_fee'            => true,
                        'reg_dps_fee'               => true,
                        'local_fee'                 => true,
                        'temp_tag_fee'              => true,
                        'diesel_fee'                => true,
                        'reg_inspection_fee'        => true,
                        'young_farmer_fee'          => true,
                        'inspection_fee'            => true,
                        'miscellaneous_fee'         => true,
                        'rebuit_salvage_fee'        => true,
                        'deputy_fee'                => false,
                        'dealer_late_penalty'       => true,
                        'individual_late_penalty'   => true,
                        'sales_tax'                 => true,
                        'sales_tax_penalty'         => true,
                        'new_registration_tax'      => true,
                        'gift_tax'                  => true,
                        'even_trade_tax'            => true,
                        'emission_fee'              => true,
                        'emissions_surcharge'       => true,
                        'dealer_inventory_tax'      => true
                    ],
                    "RR"    => [
                        'document_fee'              => true,
                        'title_fee'                 => true,
                        'duplicate_title_fee'       => true,
                        'license_fee'               => false, //registration_fee
                        'automation_fee'            => true,
                        'reg_dps_fee'               => true,
                        'local_fee'                 => true,
                        'temp_tag_fee'              => true,
                        'diesel_fee'                => true,
                        'reg_inspection_fee'        => true,
                        'young_farmer_fee'          => true,
                        'inspection_fee'            => true,
                        'miscellaneous_fee'         => true,
                        'rebuit_salvage_fee'        => true,
                        'deputy_fee'                => true,
                        'dealer_late_penalty'       => true,
                        'individual_late_penalty'   => true,
                        'sales_tax'                 => true,
                        'sales_tax_penalty'         => true,
                        'new_registration_tax'      => true,
                        'gift_tax'                  => true,
                        'even_trade_tax'            => true,
                        'emission_fee'              => true,
                        'emissions_surcharge'       => true,
                        'dealer_inventory_tax'      => true
                    ]
                ]
        ];
    }
}
