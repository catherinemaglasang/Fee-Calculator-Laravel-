<?php

namespace Thirty98\Seeder\States\Texas;

use Thirty98\API\Stdlib\Seeders\AbstractDatabaseSeeder;
use Illuminate\Support\Facades\DB;

class SalesTaxVehicleMapping extends AbstractDatabaseSeeder
{
    protected $state = "TX";
    
    
    protected function executeSeeder()
    {
        $exists = DB::table("state_vehicle_fees")->where("state_code", $this->state)->where('fee_id', 26)->get();
        
        if(!$exists) {
            DB::table("state_vehicle_fees")->insert(['state_code' => $this->state, "fee_id" => 26, "priority" => 1]);
        }
        
        $vehicle = DB::table("state_vehicle_types")->where("state_code", $this->state)->where("vehicle_type_id", 10)->get();
        if (!$vehicle) {
            DB::table("state_vehicle_types")->insert(['state_code' => $this->state, "vehicle_type_id" => 10]);
        }
        
        $type_fees = DB::table("state_vehicle_type_fees")->where("state_vehicle_type_id", 16)->where("state_vehicle_fee_id", 27)->get();
        
        if(!$type_fees) {
            DB::table("state_vehicle_type_fees")->insert(['state_vehicle_type_id' => 16, "state_vehicle_fee_id" => 27, "amount" => 0.0625, "start_date" => '2014-05-10', "end_date" => '2099-12-31']);            
        }
    }
}

