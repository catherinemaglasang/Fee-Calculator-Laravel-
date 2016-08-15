<?php

namespace Thirty98\API\General\Entities;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleRepository
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get Gross Vehicle Weight of a Vehicle.
     *
     * @param int $vehicleId
     * @return int
     */
    public function getGrossVehicleWeight($vehicleId = 0)
    {
        // Get vehicle.
        $vehicle = DB::connection('mysql_mytrs')->table('DataOneVINPatterns')->where('id', $vehicleId)->first();

        if (!$vehicle) {
            return 0;
        }

        $cw = intval($vehicle->curb_weight / 100) * 100 + 100;
        $tn = floatval($vehicle->tonnage);

        $gvw = 0;

        switch ($vehicle->vehicle_type) {
            case 'Truck':
                $gvw = $cw + ($tn * 2000);
                break;
            case 'Car':
                $gvw = $cw + 100;
                break;
            case 'SUV':
                if ($this->request->get('vehicle', -1) === 3) {
                    $gvw = $cw + ($tn * 2000);
                } else {
                    $gvw = $cw + 100;
                }
                break;
            case 'Van':
                if (strpos(strtolower($vehicle->body_subtype), 'cargo') !== false) {
                    $gvw = $cw + ($tn * 2000);
                } else {
                    $gvw = $cw + 100;
                }
                break;
        }

        return intval($gvw);
    }
}
#END OF PHP FILE