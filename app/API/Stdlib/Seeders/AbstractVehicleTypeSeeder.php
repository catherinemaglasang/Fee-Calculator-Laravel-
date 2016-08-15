<?php

namespace Thirty98\API\Stdlib\Seeders;

use Thirty98\API\Stdlib\Seeders\AbstractDatabaseSeeder;
use Illuminate\Support\Facades\DB;

abstract class AbstractVehicleTypeSeeder extends AbstractDatabaseSeeder
{
    CONST TABLE = "state_vehicle_types";
    
    protected $state;
    
    protected function executeSeeder()
    {
        foreach ($this->getVehicleTypes() AS $type) {
            
            $vehicle = DB::table('vehicle_types')->where('slug', $this->slugit($type['name']))->first();
            
            $type['state_code'] = $this->state;
            $type['vehicle_type_id'] = $vehicle->id;
            unset($type['name']);
            
            $exists =  DB::table(self::TABLE)->where('state_code', $this->state)
                ->where('vehicle_type_id', $type['vehicle_type_id'])
                ->first();
                        
            if (!$exists) {
                DB::table(self::TABLE)->insert($type);
            }
            
            continue;
        }
    }
    
    abstract protected function getVehicleTypes();
    abstract protected function getPriorityMap();

}