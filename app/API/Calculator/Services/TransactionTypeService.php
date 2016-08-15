<?php

namespace Thirty98\API\Calculator\Services;

use Thirty98\API\Calculator\Models\TransactionType;
use Thirty98\API\Calculator\Models\StateTransactionType;
use Illuminate\Support\Facades\DB;

class TransactionTypeService
{
    protected $ttl_type_model;
    protected $ttl_type_state_model;

    public function __construct(TransactionType $ttl_type, StateTransactionType $ttl_type_state)
    {
        $this->ttl_type_model = $ttl_type;
        $this->ttl_type_state_model = $ttl_type_state;
    }

    public function fetchAll()
    {
        $data = $this->ttl_type_model->all();

        if (sizeof($data) == 0) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No ttltypes found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No ttltypes found"
                ]
            ];
        }

        return $data;
    }

    public function getType($code)
    {
        $data = $this->ttl_type_model->where('code', $code)->first();

        if (!$data) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No ttltypes found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No ttltype found for code: {$code}"
                ]
            ];
        }

        return $data;
    }

    public function getTransactionTypesByState($state)
    {
        $data = $this->ttl_type_state_model->join("states", 'states.code', "=", "states_transaction_types.state_code")
            ->join("transaction_types", "transaction_types.code", "=", "states_transaction_types.transaction_type_code")
            ->where("states.code", $state)
            ->select("transaction_types.name", "transaction_types.code", "transaction_types.code as value")
            ->orderBy("priority")
            ->get();

        if (sizeof($data) == 0) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No ttltypes found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No ttltypes in the state of: {$state}"
                ]
            ];
        }

        return $data;
    }

    public function getSingleTransactionTypeByState($state, $ttl_type)
    {
        $data = $this->ttl_type_state_model->join('transaction_types', 'transaction_types.code', '=', 'transaction_type_code')
            ->where('transaction_types.code', $ttl_type)
            ->where('state_code', $state)
            ->first();

        if (!$data) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No ttltype found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No ttltype found for {$ttl_type} in the state of: {$state}"
                ]
            ];
        }

        return $data;
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

    public function rules()
    {
        return [
            "AR" => [
                "NR" => [
                    "title_fee"                     => true,
                    "lien_fee"                      => true,
                    "license_fee"                   => true,
                    "transfer_plate_fee"            => true,
                    "decal_fee"                     => true,
                    "postage_fee"                   => true,
                    "temp_tag_fee"                  => true,
                    "sales_tax"                     => true,
                    "county_tax"                    => true,
                    "city_tax"                      => true,
                    "sales_tax_penalty"             => true,
                    "license_fee_penalty"           => true,
                    "temp_tag"                      => true
                ],
                "TP" => [
                    "title_fee"                     => true,
                    "lien_fee"                      => true,
                    "license_fee"                   => false,
                    "transfer_plate_fee"            => true,
                    "decal_fee"                     => true,
                    "postage_fee"                   => true,
                    "temp_tag_fee"                  => true,
                    "sales_tax"                     => true,
                    "county_tax"                    => true,
                    "city_tax"                      => true,
                    "sales_tax_penalty"             => true,
                    "license_fee_penalty"           => true,
                    "temp_tag"                      => true
                ],
                "DT" => [
                    "title_fee"                     => true,
                    "lien_fee"                      => false,
                    "license_fee"                   => false,
                    "transfer_plate_fee"            => true,
                    "decal_fee"                     => false,
                    "postage_fee"                   => false,
                    "temp_tag_fee"                  => false,
                    "sales_tax"                     => false,
                    "county_tax"                    => false,
                    "city_tax"                      => false,
                    "sales_tax_penalty"             => false,
                    "license_fee_penalty"           => false
                ],
                "TRC" => [
                    "title_fee"                     => true,
                    "lien_fee"                      => false,
                    "license_fee"                   => false,
                    "transfer_plate_fee"            => true,
                    "decal_fee"                     => false,
                    "postage_fee"                   => false,
                    "temp_tag_fee"                  => false,
                    "sales_tax"                     => false,
                    "county_tax"                    => false,
                    "city_tax"                      => false,
                    "sales_tax_penalty"             => false,
                    "license_fee_penalty"           => false
                ]
            ],
            'LA' => [
                "NR" => [
                    'document_fee' => false,
                    'title_fee' => true,
                    'duplicate_title_fee' => false,
                    'title_correction_fee' => false,
                    'mortgage_fee' => true,
                    'license_fee' => true,
                    'license_transfer_fee' => false,
                    'license_credit_fee' => true,
                    'license_credit_penalty' => true,
                    'handling_fee' => true,
                    'tow_fee' => true,
                    'notary_fee' => true,
                    'miscellaneous_fee' => true,
                    'sales_tax' => true,
                    'sales_tax_penalty' => true,
                    'interest' => true,
                    'convenience_fee' => true,
                    'processing_fee' => true,
                    'mail_fee' => true,
                    'vendors_comp' => true,
                    'electronic_filing_fee' => true,
                    'temp_tag_fee' => true
                ],
                "TP" => [
                    'document_fee' => true,
                    'title_fee' => true,
                    'duplicate_title_fee' => false,
                    'title_correction_fee' => false,
                    'mortgage_fee' => true,
                    'license_fee' => false,
                    'license_transfer_fee' => true,
                    'license_credit_fee' => true,
                    'license_credit_penalty' => true,
                    'handling_fee' => true,
                    'tow_fee' => true,
                    'notary_fee' => true,
                    'miscellaneous_fee' => true,
                    'sales_tax' => true,
                    'sales_tax_penalty' => true,
                    'interest' => true,
                    'convenience_fee' => true,
                    'processing_fee' => true,
                    'mail_fee' => true,
                    'vendors_comp' => true,
                    'electronic_filing_fee' => true,
                    'temp_tag_fee' => true
                ],
                "DT" => [
                    'document_fee' => true,
                    'title_fee' => false,
                    'duplicate_title_fee' => true,
                    'title_correction_fee' => false,
                    'mortgage_fee' => false,
                    'license_fee' => false,
                    'license_transfer_fee' => false,
                    'license_credit_fee' => false,
                    'license_credit_penalty' => false,
                    'handling_fee' => true,
                    'tow_fee' => false,
                    'notary_fee' => true,
                    'miscellaneous_fee' => false,
                    'sales_tax' => false,
                    'sales_tax_penalty' => false,
                    'interest' => false,
                    'convenience_fee' => true,
                    'processing_fee' => true,
                    'mail_fee' => true,
                    'vendors_comp' => false,
                    'electronic_filing_fee' => true,
                    'temp_tag_fee' => true
                ],
                "TRC" => [
                    'document_fee' => true,
                    'title_fee' => true,
                    'duplicate_title_fee' => false,
                    'title_correction_fee' => false,
                    'mortgage_fee' => true,
                    'license_fee' => true,
                    'license_transfer_fee' => false,
                    'license_credit_fee' => true,
                    'license_credit_penalty' => true,
                    'handling_fee' => true,
                    'tow_fee' => true,
                    'notary_fee' => true,
                    'miscellaneous_fee' => true,
                    'sales_tax' => true,
                    'sales_tax_penalty' => true,
                    'interest' => true,
                    'convenience_fee' => true,
                    'processing_fee' => true,
                    'mail_fee' => true,
                    'vendors_comp' => true,
                    'electronic_filing_fee' => true,
                    'temp_tag_fee' => true
                ],
                "RR" => [
                    'document_fee' => true,
                    'title_fee' => true,
                    'duplicate_title_fee' => false,
                    'title_correction_fee' => false,
                    'mortgage_fee' => true,
                    'license_fee' => true,
                    'license_transfer_fee' => false,
                    'license_credit_fee' => true,
                    'license_credit_penalty' => true,
                    'handling_fee' => true,
                    'tow_fee' => true,
                    'notary_fee' => true,
                    'miscellaneous_fee' => true,
                    'sales_tax' => true,
                    'sales_tax_penalty' => true,
                    'interest' => true,
                    'convenience_fee' => true,
                    'processing_fee' => true,
                    'mail_fee' => true,
                    'vendors_comp' => true,
                    'electronic_filing_fee' => true,
                    'temp_tag_fee' => true
                ]
            ],
            'TX' => [
                "NR" => [
                    'document_fee' => true,
                    'title_fee' => true,
                    'duplicate_title_fee' => false,
                    'license_fee' => true, //registration_fee
                    'automation_fee' => true,
                    'reg_dps_fee' => true,
                    'local_fee' => true,
                    'temp_tag_fee' => true,
                    'diesel_fee' => true,
                    'reg_inspection_fee' => true,
                    'young_farmer_fee' => true,
                    'inspection_fee' => true,
                    'miscellaneous_fee' => true,
                    'rebuit_salvage_fee' => true,
                    'deputy_fee' => true,
                    'dealer_late_penalty' => true,
                    'individual_late_penalty' => true,
                    'sales_tax' => true,
                    'sales_tax_penalty' => true,
                    'new_registration_tax' => false,
                    'gift_tax' => false,
                    'even_trade_tax' => false,
                    'emission_fee' => true,
                    'emissions_surcharge' => true,
                    'dealer_inventory_tax' => true
                ],
                "TP" => [
                    'document_fee' => true,
                    'title_fee' => true,
                    'duplicate_title_fee' => false,
                    'license_fee' => false, //registration_fee
                    'automation_fee' => false,
                    'reg_dps_fee' => false,
                    'local_fee' => false,
                    'temp_tag_fee' => true,
                    'diesel_fee' => true,
                    'reg_inspection_fee' => true,
                    'young_farmer_fee' => true,
                    'inspection_fee' => true,
                    'miscellaneous_fee' => true,
                    'rebuit_salvage_fee' => true,
                    'deputy_fee' => true,
                    'dealer_late_penalty' => true,
                    'individual_late_penalty' => true,
                    'sales_tax' => true,
                    'sales_tax_penalty' => true,
                    'new_registration_tax' => false,
                    'gift_tax' => false,
                    'even_trade_tax' => false,
                    'emission_fee' => true,
                    'emissions_surcharge' => true,
                    'dealer_inventory_tax' => true
                ],
                "DT" => [
                    'document_fee' => false,
                    'title_fee' => true,
                    'duplicate_title_fee' => true,
                    'license_fee' => false, //registration_fee
                    'automation_fee' => false,
                    'reg_dps_fee' => false,
                    'local_fee' => false,
                    'temp_tag_fee' => false,
                    'diesel_fee' => false,
                    'reg_inspection_fee' => false,
                    'young_farmer_fee' => false,
                    'inspection_fee' => false,
                    'miscellaneous_fee' => false,
                    'rebuit_salvage_fee' => false,
                    'deputy_fee' => false,
                    'dealer_late_penalty' => false,
                    'individual_late_penalty' => false,
                    'sales_tax' => false,
                    'sales_tax_penalty' => false,
                    'new_registration_tax' => false,
                    'gift_tax' => false,
                    'even_trade_tax' => false,
                    'emission_fee' => false,
                    'emissions_surcharge' => false,
                    'dealer_inventory_tax' => false
                ],
                "TO" => [
                    'document_fee' => true,
                    'title_fee' => true,
                    'duplicate_title_fee' => false,
                    'license_fee' => false, //registration_fee
                    'automation_fee' => true,
                    'reg_dps_fee' => true,
                    'local_fee' => true,
                    'temp_tag_fee' => true,
                    'diesel_fee' => true,
                    'reg_inspection_fee' => true,
                    'young_farmer_fee' => true,
                    'inspection_fee' => true,
                    'miscellaneous_fee' => true,
                    'rebuit_salvage_fee' => true,
                    'deputy_fee' => true,
                    'dealer_late_penalty' => true,
                    'individual_late_penalty' => true,
                    'sales_tax' => true,
                    'sales_tax_penalty' => true,
                    'new_registration_tax' => false,
                    'gift_tax' => false,
                    'even_trade_tax' => false,
                    'emission_fee' => true,
                    'emissions_surcharge' => true,
                    'dealer_inventory_tax' => true
                ],
                "RO" => [
                    'document_fee' => true,
                    'title_fee' => true,
                    'duplicate_title_fee' => false,
                    'license_fee' => false, //registration_fee
                    'automation_fee' => true,
                    'reg_dps_fee' => true,
                    'local_fee' => true,
                    'temp_tag_fee' => true,
                    'diesel_fee' => true,
                    'reg_inspection_fee' => true,
                    'young_farmer_fee' => true,
                    'inspection_fee' => true,
                    'miscellaneous_fee' => true,
                    'rebuit_salvage_fee' => true,
                    'deputy_fee' => true,
                    'dealer_late_penalty' => true,
                    'individual_late_penalty' => true,
                    'sales_tax' => true,
                    'sales_tax_penalty' => true,
                    'new_registration_tax' => false,
                    'gift_tax' => false,
                    'even_trade_tax' => false,
                    'emission_fee' => true,
                    'emissions_surcharge' => true,
                    'dealer_inventory_tax' => true
                ],
                "TRC" => [
                    'document_fee' => false,
                    'title_fee' => true,
                    'duplicate_title_fee' => false,
                    'license_fee' => false, //registration_fee
                    'automation_fee' => false,
                    'reg_dps_fee' => false,
                    'local_fee' => false,
                    'temp_tag_fee' => false,
                    'diesel_fee' => false,
                    'reg_inspection_fee' => false,
                    'young_farmer_fee' => false,
                    'inspection_fee' => false,
                    'miscellaneous_fee' => false,
                    'rebuit_salvage_fee' => false,
                    'deputy_fee' => false,
                    'dealer_late_penalty' => false,
                    'individual_late_penalty' => false,
                    'sales_tax' => false,
                    'sales_tax_penalty' => false,
                    'new_registration_tax' => false,
                    'gift_tax' => false,
                    'even_trade_tax' => false,
                    'emission_fee' => false,
                    'emissions_surcharge' => false,
                    'dealer_inventory_tax' => false
                ],
                "RR" => [
                    'document_fee' => false,
                    'title_fee' => false,
                    'duplicate_title_fee' => false,
                    'license_fee' => false, //registration_fee
                    'automation_fee' => false,
                    'reg_dps_fee' => false,
                    'local_fee' => false,
                    'temp_tag_fee' => false,
                    'diesel_fee' => false,
                    'reg_inspection_fee' => false,
                    'young_farmer_fee' => false,
                    'inspection_fee' => false,
                    'miscellaneous_fee' => false,
                    'rebuit_salvage_fee' => false,
                    'deputy_fee' => false,
                    'dealer_late_penalty' => false,
                    'individual_late_penalty' => false,
                    'sales_tax' => false,
                    'sales_tax_penalty' => false,
                    'new_registration_tax' => false,
                    'gift_tax' => false,
                    'even_trade_tax' => false,
                    'emission_fee' => false,
                    'emissions_surcharge' => false,
                    'dealer_inventory_tax' => false
                ]
            ]
        ];
    }
}