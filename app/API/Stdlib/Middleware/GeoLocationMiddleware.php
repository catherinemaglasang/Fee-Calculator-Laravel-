<?php

namespace Thirty98\API\Stdlib\Middleware;

use Thirty98\API\POS\Services\POSService;
use Thirty98\API\Stdlib\Helpers\TaxHelperService;
use Thirty98\API\Vehicle\Services\VehicleService;
use DB;

class GeoLocationMiddleware extends AbstractPostMiddleware
{
    protected $vehicle_service;
    protected $pos_service;

    public function __construct(VehicleService $vehicle_service, POSService $pos_service)
    {
        $this->service = $vehicle_service;
        $this->pos_service = $pos_service;
    }

    /**
     * Validates city and county (county can be blank)
     * @param array $payload
     * @return array
     */
    protected function updateRequest(Array $payload)
    {
        $state_code = $this->payload['state']['code'];
        $transaction_type = isset($this->payload['transaction_type']) ? $this->payload['transaction_type'] : false;
        $county = isset($this->payload['county']) ? trim($this->slugit($this->payload['county'])) : '';
        $city = isset($this->payload['city']) ? trim($this->slugit($this->payload['city'])) : '';
        $city_limits = isset($this->payload['city_limits']) ? trim($this->slugit($this->payload['city_limits'])) : false;
        $taxable_value = $payload['taxable_value'];
        $street_address = $payload['street_address'];
        $zip = $payload['zip'];

        // Validate location.
        if ($state_code == 'LA') {
            if ($transaction_type !== "DT" && $transaction_type !== "TRC") {
                // How to get Street Address and ZIP?
                /**
                 * Domicile Code
                 * Domicile Name
                 * Tax Rate
                 * Tax Amount
                 * Vendor Comp Rate
                 * Vendor Comp Amount
                 */

                $result = $this->pos_service->getFees($taxable_value, $state_code, $street_address, $zip, $county, $city);

                if (isset($result['error'])) {
                    return $result;
                }

                $this->payload['sales_tax_rate'] = TaxHelperService::toFloatValue($result['Tax Rate']) * .01;
                $this->payload['sales_tax_amount'] = TaxHelperService::toFloatValue($result['Tax Amount']);
                $this->payload['vendors_comp'] = TaxHelperService::toFloatValue($result['Vendor Comp Amount']);
                $this->payload['vendors_comp_rate'] = TaxHelperService::toFloatValue($result['Vendor Comp Rate']);

                // Rebate tax.
                $lower_date_boundary = '04/01/2016';
                $upper_date_boundary = '06/30/2016';

                $date_of_sale = $this->payload['date_of_sale'];

                if($date_of_sale >= $lower_date_boundary && $date_of_sale <= $upper_date_boundary) {
                    $this->payload['rebate_tax_rate'] = 0.04;
                } else {
                    $this->payload['rebate_tax_rate'] = 0.02;
                }
            }
        }

        // Validate processing county and resident county.
        /*if ($state_code == 'TX') {
            // Returns county code to predetermine the processing county.
            if ($this->ifParam($this->payload, 'is_location') === true) {
                $avalara = new Avalara();

                $county = County::where('state_code', '=', $state_code)
                    ->where('slug', '=', $this->slugit($this->payload['county']))
                    ->first();

                if (is_null($county)) {
                    return [
                        'error' => [
                            'http_code' => 200,
                            'response_msg' => "No county found",
                            'response_code' => "NO_DATA_FOUND",
                            "exception" => "No county: {$county} found in the state of {$state_code}"
                        ]
                    ];
                }

                $this->payload['Sales Tax Rate'] = $avalara->salesTaxRate($this->payload['county'], 0);
                $this->payload['Sales Tax Rate']['processing_county_id'] = $county->code;

                if (isset($location['error'])) {
                    return $location;
                } else {
                    return $this->payload;
                }
            } else {
                $processing_county = isset($this->payload['processing_county']) ? trim($this->slugit($this->payload['processing_county'])) : false;
                $resident_county = isset($this->payload['resident_county']) ? trim($this->slugit($this->payload['resident_county'])) : false;

                if ($processing_county) {
                    $county = $this->service->fetchCounty($this->payload['processing_county'], $state_code);

                    if ($county === null) {
                        return [
                            'error' => [
                                'http_code' => 200,
                                'response_msg' => "No county found",
                                'response_code' => "NO_DATA_FOUND",
                                "exception" => "No processing county found for county code: {$this->payload['processing_county']}"
                            ]
                        ];
                    }
                }

                if ($resident_county) {
                    $county = $this->service->fetchCounty($this->payload['resident_county'], $state_code);

                    if ($county === null) {
                        return [
                            'error' => [
                                'http_code' => 200,
                                'response_msg' => "No county found",
                                'response_code' => "NO_DATA_FOUND",
                                "exception" => "No resident county found for county code: {$this->payload['resident_county']}"
                            ]
                        ];
                    }
                }
            }
        }*/

        return $this->payload;
    }

    protected function postValidationRules()
    {
        $state = $this->payload['state']['code'];
        $transaction_type = isset($this->payload['transaction_type']) ? $this->payload['transaction_type'] : false;

        $address_rules = [];

        if ($state == 'LA') {
            $address_rules['county'] = 'required|string';
            $address_rules['city'] = 'required|string';

            $address_rules['street_address'] = 'required|string';
            $address_rules['zip'] = 'required|string';
            /*if($transaction_type !== "DT" && $transaction_type !== "TRC" && $transaction_type !== false) {
                $address_rules['county'] = 'required';
                $address_rules["city_limits"] = "required|boolean";
            }*/
        } else if ($state == 'TX') {

        } else if ($state == 'AR') {
            $address_rules['city'] = 'required';
            $address_rules['county'] = 'required';
        }

        return $address_rules;
    }
}