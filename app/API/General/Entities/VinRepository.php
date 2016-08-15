<?php

namespace Thirty98\API\General\Entities;

use Illuminate\Support\Facades\DB;

class VinRepository
{
    private $connectionMyTrs;
    private $vehicleRepository;

    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->connectionMyTrs = DB::connection('mysql_mytrs');
        $this->vehicleRepository = $vehicleRepository;
    }

    /***
     * Get VIN Patterns.
     *
     * @param $vin
     * @return array|bool|ApiException
     */
    public function getVinPatterns($vin)
    {
        // Check VIN length.
        $validVin = $this->checkVinLength($vin);
        if ($validVin instanceof ApiException) {
            return $validVin;
        }

        // Get VIN pattern.
        $vinPattern = $this->convertVinToVinPattern($vin);

        $result = $this->connectionMyTrs
            ->table('DataOneVINPatterns')
            ->where('vin_pattern', $vinPattern)
            ->limit(100)->get();

        if (!$result) {
            return new ApiException(
                ApiResponse::CODE_NOT_FOUND,
                'No VIN Pattern found.',
                null,
                ApiResponse::HTTPCODE_NOT_FOUND
            );
        }

        // Calculate Gross Vehicle Weight.
        for ($i = 0; $i < count($result); $i++) {
            $result[$i]->_gvw = $this->vehicleRepository->getGrossVehicleWeight($result[$i]->id);
        }

        return $result;
    }

    /**
     * Check if VIN is in proper character length.
     *
     * @param $vin
     * @return bool|ApiException
     */
    private function checkVinLength($vin)
    {
        if (strlen($vin) < 11) {
            return new ApiException(
                ApiResponse::CODE_BAD_REQUEST,
                'Please provide a VIN with 11 characters.',
                null,
                ApiResponse::HTTPCODE_BAD_REQUEST
            );
        }

        return true;
    }

    /**
     * Convert VIN to VIN Pattern.
     *
     * @param $vin
     * @return array
     */
    private function convertVinToVinPattern($vin)
    {
        $prefixVin = substr($vin, 0, 8);
        $postfixVin = substr($vin, 9, 2);

        return $prefixVin . $postfixVin;
    }
}

#END OF PHP FILE