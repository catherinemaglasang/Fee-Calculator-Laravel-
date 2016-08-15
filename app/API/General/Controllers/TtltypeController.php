<?php

namespace Thirty98\API\General\Controllers;

use Thirty98\API\General\Entities\ApiResponse;
use Thirty98\API\General\Entities\TtlTypeRepository;
use Thirty98\Http\Controllers\Controller;

class TtltypeController extends Controller
{
    public function index(TtlTypeRepository $ttlTypeRepository)
    {
        return ApiResponse::success('Here are your TTL Types.', $ttlTypeRepository->ttlTypes());
    }
}
#END OF PHP FILE