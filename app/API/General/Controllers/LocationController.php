<?php

namespace Thirty98\API\General\Controllers;

use Illuminate\Http\Request;
use Thirty98\API\General\Entities\ApiException;
use Thirty98\API\General\Entities\ApiResponse;
use Thirty98\API\General\Entities\LocationRepository;
use Thirty98\Http\Controllers\Controller;

class LocationController extends Controller
{
    /**
     * Get location of an address.
     *
     * @param Request $request
     * @param LocationRepository $locationRepository
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws ApiException
     */
    public function show(Request $request, LocationRepository $locationRepository)
    {
        $address = $request->get('address');
        $result = $locationRepository->getLatLngByAddress($address);

        if ($result instanceof ApiException) {
            return ApiResponse::error(
                $result->getResponseCode(),
                $result->getMessage(),
                $result->getData(),
                $result->getCode()
            );
        }

        return ApiResponse::success('Here you go.', $result);
    }
}

#END OF PHP FILE