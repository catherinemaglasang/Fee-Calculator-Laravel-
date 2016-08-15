<?php

namespace Thirty98\API\General\Controllers;

use Thirty98\API\General\Entities\ApiResponse;
use Thirty98\API\General\Entities\CountryRepository;
use Thirty98\Http\Controllers\Controller;


class CountryController extends Controller
{
    /**
     * Get list of countries.
     *
     * @param CountryRepository $countryRepository
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index(CountryRepository $countryRepository)
    {
        return ApiResponse::success('List of countries.', ['countries' => $countryRepository->countries()]);
    }
}
#END OF PHP FILE