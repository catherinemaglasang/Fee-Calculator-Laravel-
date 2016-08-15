<?php namespace Thirty98\API\General\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Thirty98\API\General\Entities\ApiResponse;
use Thirty98\API\General\Entities\VehicleRepository;
use Thirty98\Http\Controllers\Controller;

class GrossVehicleWeightController extends Controller
{
    private $vehicleRepository;

    public function __construct(Request $request)
    {
        $this->vehicleRepository = new VehicleRepository($request);
    }

    public function show($vehicleId)
    {
        $result = DB::connection('mysql_mytrs')->table('DataOneVINPatterns')->where('id', $vehicleId)->first();

        if (!$result) {
            return ApiResponse::error(ApiResponse::CODE_NOT_FOUND, 'DataOne Vehicle record not found.', null, ApiResponse::HTTPCODE_NOT_FOUND);
        }

        $gvw = $this->vehicleRepository->getGrossVehicleWeight($result->id);

        return ApiResponse::success('The calculated Gross Vehicle Weight.', ['gvw' => $gvw]);
    }
}

#END OF PHP FILE