<?php

namespace Thirty98\API\General\Controllers;

use Illuminate\Http\Request;
use Thirty98\API\General\Entities\ApiResponse;
use Thirty98\API\General\Entities\Helper;
use Thirty98\API\General\Entities\StateRepository;
use Thirty98\Http\Controllers\Controller;


class StateController extends Controller
{
    /**
     * Get list of states.
     *
     * @param Request $request
     * @param StateRepository $stateRepository
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, StateRepository $stateRepository)
    {

        // return $request;

        $query = Helper::queryToArray($request['q']);

        return ApiResponse::success('List of states.', $stateRepository->states($query));
    }
}
#END OF PHP FILE