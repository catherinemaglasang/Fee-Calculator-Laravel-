<?php

namespace Thirty98\API\General\Controllers;

use Thirty98\API\General\Entities\ApiException;
use Thirty98\API\General\Entities\ApiResponse;
use Thirty98\API\General\Entities\VinRepository;
use Thirty98\Http\Controllers\Controller;

class VinController extends Controller
{
    /**
     * Get list of VIN Pattern using VIN only.
     *
     * @param $vin
     * @param VinRepository $vinRepository
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index($vin, VinRepository $vinRepository)
    {
        $result = $vinRepository->getVinPatterns($vin);

        if ($result instanceof ApiException) {
            return ApiResponse::error(
                $result->getResponseCode(),
                $result->getMessage(),
                $result->getData(),
                $result->getCode()
            );
        }

        return ApiResponse::success('Here are your VIN Patterns.', $result);
    }
}
#END OF PHP FILE