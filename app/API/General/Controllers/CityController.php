<?php

namespace Thirty98\API\General\Controllers;

use Illuminate\Http\Request;
use Thirty98\API\General\Entities\ApiException;
use Thirty98\API\General\Entities\ApiResponse;
use Thirty98\API\General\Entities\CityRepository;
use Thirty98\API\General\Entities\Helper;
use Thirty98\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * Get list of cities.
     *
     * @param Request $request
     * @param CountyRepository $countyRepository
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, CityRepository $cityRepository)
    {
        $query = Helper::queryToArray($request['q']);

        return ApiResponse::success('List of cities.', $cityRepository->cities($query));
    }
}

// EOF