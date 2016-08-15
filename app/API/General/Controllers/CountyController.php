<?php

namespace Thirty98\API\General\Controllers;

use Illuminate\Http\Request;
use Thirty98\API\General\Entities\ApiException;
use Thirty98\API\General\Entities\ApiResponse;
use Thirty98\API\General\Entities\CountyRepository;
use Thirty98\API\General\Entities\Helper;
use Thirty98\Http\Controllers\Controller;


class CountyController extends Controller
{
    /**
     * Get list of counties.
     *
     * @param Request $request
     * @param CountyRepository $countyRepository
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, CountyRepository $countyRepository)
    {
        $query = Helper::queryToArray($request['q']);

        return ApiResponse::success('List of counties.', $countyRepository->counties($query));
    }

    /**
     * Get list of counties by state.
     *
     * @param $stateCode
     * @param CountyRepository $countyRepository
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function getStateCounties($stateCode, CountyRepository $countyRepository)
    {
        $result = $countyRepository->getCountiesByState($stateCode);

        if ($result instanceof ApiException) {
            return ApiResponse::error($result->getResponseCode(), $result->getMessage(), $result->getData(), $result->getCode());
        }

        return ApiResponse::success('List of counties of State: ' . $stateCode, $result);
    }
}
#END OF PHP FILE