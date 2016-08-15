<?php

namespace Thirty98\API\Calculator\Services;

use Thirty98\Models\State;
use Thirty98\API\Stdlib\Models\Fee;
use Thirty98\Models\VehicleType;
use Illuminate\Support\Facades\DB;

class SalesTaxRateFactoryService
{
    protected $state;
    protected $fee;
    protected $vehicle_type;

    public function __construct(State $state, Fee $fee, VehicleType $vehicle)
    {
        $this->state = $state;
        $this->fee = $fee;
        $this->vehicle_type = $vehicle;
    }

    public function setConfiguration($state_code, $vehicle_type)
    {
        $state = $this->state->where("code", $state_code)->first();
        //var_dump($state->toArray()['slug']); exit;
    }
    
    
    public function getSalesTaxRate($state_code, $vehicle_type)
    {
        //checks if there is a mapping
        $vehicle = $this->vehicle_type->where("slug", $vehicle_type)->first();
        $state_vehicle_type = DB::table("state_vehicle_types")->where('state_code', $state_code)->where("vehicle_type_id", $vehicle->id)->first();
                      
        $fee = DB::table("fees")->where("slug", "sales_tax")->first();
        $state_vehicle_fee = DB::table("state_vehicle_fees")->where('state_code', $state_code)->where("fee_id", $fee->id)->first();        
        $tax = DB::table("state_vehicle_type_fees")->where("state_vehicle_fee_id", $state_vehicle_fee->id)->where("state_vehicle_type_id", $state_vehicle_type->id)->first();
        
        return !$tax ? 0.00 : $tax->amount;
    }
}