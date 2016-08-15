<?php

namespace Thirty98\API\Stdlib\Middleware;

use Thirty98\API\Stdlib\Services\ResponseService;
use Thirty98\API\Vehicle\Services\VehicleService;
use Thirty98\Models\TXInspectionFee;

class InspectionFeeMiddleware extends AbstractPostMiddleware
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
        $state_code = $payload['state']['code'];

        /*if ($state_code == 'TX') {
            if (isset($payload['include_inspection_fee'])) {
                if ($payload['include_inspection_fee'] == true) {
                    // Do inspection fee check.
                    $inspection_fee = $this->service->fetchTXInspectionFee($payload['inspection_type'])->first();

                    if(!$inspection_fee) {
                        return [
                            'error' => [
                                "http_code"     => 200,
                                "response_msg"  => "No data found.",
                                "response_code" => "NO_DATA_FOUND",
                                "exception"     => "No inspection fee code: {$payload['inspection_type']} found."
                            ]
                        ];
                    }
                }
            }
        }*/

        return $payload;
    }

    protected function postValidationRules()
    {
        // Require inspection type CONDITIONALLY.
        return [
            'include_inspection_fee' => 'required_if:state.code,TX',
            'inspection_type' => 'required_if:include_inspection_fee,1'
        ];
    }
}