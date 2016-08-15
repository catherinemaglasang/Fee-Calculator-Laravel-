<?php

namespace Thirty98\API\Stdlib\Seeders;

use Illuminate\Support\Facades\DB;
use Thirty98\Models\VehicleType;

abstract class AbstractStateVehicleTypeSeeder extends AbstractDatabaseSeeder
{
    protected function executeSeeder()
    {
        // Build indexes for fast insert.
        $vehicleTypes = VehicleType::all();
        $vehicleTypesIndexes = [];

        foreach($vehicleTypes as $vehicleType) {
            $vehicleTypesIndexes[$vehicleType['slug']] = $vehicleType['id'];
        }

        $priorityMap = $this->getPriorityMap();

        foreach ($this->getVehicleTypes() AS $vehicle) {
            $vehicleTypeID = $vehicleTypesIndexes[$vehicle];

            $exists = DB::table($this->table_name)->where('vehicle_type_id', $vehicleTypeID)
                ->where('state_code', $this->state_code)
                ->first();


            if (!$exists) {
                DB::table($this->table_name)->insert([
                    'state_code' => $this->state_code,
                    'vehicle_type_id' => $vehicleTypeID,
                    'priority' => $priorityMap[$vehicle]
                ]);
            }

            continue;
        }
    }

    abstract protected function getVehicleTypes();
    abstract protected function getPriorityMap();
}
