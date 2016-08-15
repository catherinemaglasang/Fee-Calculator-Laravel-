<?php

namespace Thirty98\API\Stdlib\Middleware;

use Thirty98\API\Vehicle\Services\VehicleService;

class ZipGeoLocationMiddleware extends AbstractPostMiddleware
{
    protected $service;

    public function __construct(VehicleService $service)
    {
        $this->service = $service;
    }

    /**
     * Validates city and county (county can be blank)
     * @param array $payload
     * @return array
     */
    protected function updateRequest(Array $payload)
    {
        $state = $this->payload['state']['code'];

        if ($state === 'LA') {
            $address_params = [
                'street_address' => $payload['street_address'],
                'zip' => $payload['zip']
            ];

            $payload['Address'] = '';
            $response = $this->getPostRequest('/api/avalara/v1/verify/location', $address_params);
            $response = $response->data;

            if (isset($response->error)) {
                return [
                    'error' => [
                        'http_code' => 200,
                        'response_msg' => "No address found",
                        'response_code' => "NO_ADDRESS_FOUND",
                        "exception" => "No address found for street address: '{$payload['street_address']}' and zip: '{$payload['zip']}'"
                    ]
                ];
            }

            $location = $this->service->fetchAreaTaxRates($response->location->Address->County, $response->location->Address->City);

            $payload['county'] = $response->location->Address->County;
            $payload['city'] = $response->location->Address->City;

            $payload['Sales Tax Rate'] = $location;

            if (isset($location['error'])) {
                return $location;
            } else {
                return $payload;
            }
        }

        if ($state === 'TX') {
            $payload['is_location'] = true;

            $address_params = [
                'street_address' => $payload['street_address'],
                'zip' => $payload['zip']
            ];

            $response = $this->getPostRequest('/api/avalara/v1/verify/location', $address_params);
            $response = $response->data;

            if (isset($response->error)) {
                return [
                    'error' => [
                        'http_code' => 200,
                        'response_msg' => "No address found",
                        'response_code' => "NO_ADDRESS_FOUND",
                        "exception" => "No address found for street address: '{$payload['street_address']}' and zip: '{$payload['zip']}'"
                    ]
                ];
            }

            $payload['response'] = $response;
            $payload['county'] = $response->location->Address->County;
            $payload['city'] = '';
        }

        return $payload;
    }

    protected function postValidationRules()
    {
        $state = $this->payload['state']['code'];

        $validations = [];

        if ($state === 'LA') {
            $validations['street_address'] = 'required';
            $validations['zip'] = 'required';
        } else if ($state === 'TX') {

        }

        return $validations;
    }
}