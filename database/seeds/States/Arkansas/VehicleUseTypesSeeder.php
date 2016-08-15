<?php

namespace Thirty98\Seeder\States\Arkansas;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Thirty98\Models\ARVehicleUseType;

class VehicleUseTypesSeeder extends AbstractDatabaseSeeder
{
    public $state_code = 'AR';
    protected $table_name = 'ar_vehicle_use_types';

    protected function executeSeeder()
    {
        foreach ($this->getVehicleUses() AS $use_type) {
            $exists = ARVehicleUseType::where('name', $use_type)->first();

            if (!$exists) {
                $result = ARVehicleUseType::insertGetId([
                    'name' => $use_type
                ]);

                if (!$result) {
                    die('Arkansas Vehicle Use Type Adding Failed. ' . PHP_EOL);
                }
            }

            continue;
        }
    }

    /**
     * PERSONAL
     * COMMERCIAL
     * ALL
     */

    protected function getVehicleUses()
    {
        return [
            "PERSONAL",
            "COMMERCIAL",
            "ALL"
        ];
    }

}
