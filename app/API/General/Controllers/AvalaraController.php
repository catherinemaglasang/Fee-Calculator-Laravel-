<?php

namespace Thirty98\API\General\Controllers;

use Illuminate\Http\Request;
use Thirty98\API\General\Entities\ApiException;
use Thirty98\API\General\Entities\ApiResponse;
use Thirty98\API\General\Entities\Avalara;
use Thirty98\Http\Controllers\Controller;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;


class AvalaraController extends Controller
{
    /**
     * Get Sales Tax Rate.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function getSalesTaxRate(Request $request)
    {
        $avalara = new Avalara();

        $result = $avalara->salesTaxRate($request->get('address'), $request->get('amount'));

        if ($result instanceof ApiException) {
            return ApiResponse::error($result->getResponseCode(), $result->getMessage(), null, $result->getCode());
        }

        return ApiResponse::success('Here\'s the Avalara tax and rate.', $result);
    }

    public function checkLocation(Request $request)
    {
        $street_address = $request->get('street_address');
        $zip_code = $request->get('zip_code');

        $avalara = new Avalara();

        $result = $avalara->verifyLocation($street_address, $zip_code);

        return $result;
    }
}
#END OF PHP FILE