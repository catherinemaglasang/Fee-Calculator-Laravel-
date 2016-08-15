<?php

namespace Thirty98\API\POS\Controllers;

use Thirty98\API\Stdlib\Services\ResponseService;
use Thirty98\API\POS\Services\POSService;
use Thirty98\Http\Controllers\Controller;
use Illuminate\Http\Request;

class POSController extends Controller
{
    protected $service;

    public function __construct(POSService $service)
    {
        $this->service = $service;
    }

    public function getLicensePlateDetails(Request $request)
    {
        $payload = $request->all();

        $payload['prefix'] = $this->service->getPrefix($payload['license_plate']);

        // First get license plate.
        $license_plate = $this->service->getLicensePlate($payload['license_plate'], $payload['prefix']);

        if (isset($license_plate['error'])) {
            return $license_plate['error'];
        }

        $response = ['Vehicle Type(s)' => $license_plate, 'payload' => $payload];
        return ResponseService::success("Here's the Vehicle Type(s)", $response);
    }

    public function getPOSVehicleTypes()
    {
        $response = $this->service->getVehicleTypes();

        if (isset($response['error'])) {
            return $response['error'];
        }

        $response = ['Vehicle Types' => $response, 'payload' => $payload];
        return ResponseService::success("Here's the Vehicle Type(s)", $response);
    }

    public function getNorthAmericanStates(Request $request)
    {
        $response = $this->service->getNorthAmericanStates();

        if(isset($response['error'])) {
            return $response;
        }

        return ResponseService::success("Here's the States", $response);
    }

    public function getTransactionTypeDefaults(Request $request)
    {
        $payload = $request->all();

        $license_code_defaults = $this->service->getLicenseCodeDefaults($payload['pos_transaction_type']);
        $title_code_defaults = $this->service->getTitleCodeDefaults($payload['pos_transaction_type']);

        if (count($license_code_defaults) === 0 || count($title_code_defaults) === 0) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_code' => "NO_DATA_FOUND",
                    'response_msg' => "No license and title code defaults found",
                    "exception" => "No license and title code defaults found for POS Transaction Type: '{$payload['pos_transaction_type']}'"
                ]
            ];
        }

        $response = [
            'License Code Configuration' => $license_code_defaults,
            'Title Code Configuration' => $title_code_defaults
        ];

        $response = ['Vehicle Types' => $response, 'payload' => $payload];
        return ResponseService::success("Here's the Defaults", $response);


    }
}