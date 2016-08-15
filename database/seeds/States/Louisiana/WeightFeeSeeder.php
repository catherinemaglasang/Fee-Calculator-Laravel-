<?php

namespace Thirty98\Seeder\States\Louisiana;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Illuminate\Support\Facades\DB;

class WeightFeeSeeder extends AbstractDatabaseSeeder
{
    public $state_code = 'LA';
    protected $table_name = 'cities_fees';

    protected function executeSeeder()
    {
        $state = DB::table('states')->where('code', $this->state_code)->first();

        foreach ($this->getWeightFees() AS $weightFee) {
            // var_dump($weightFee);
            /*$exists = DB::table($this->table_name)->where('code', $county['code'])
                ->where('state_id', $state->id)
                ->first();

            if (!$exists) {
                DB::table($this->table_name)->insert(array_merge(['state_id' => $state->id], $county));
            }

            continue;*/
        }
    }

    // Change Table.
    protected function getWeightFees()
    {
        return [
            ['vehicle_type' => 'Truck',              'begin_weight' => '6001',    'end_weight' => '8000',  'fee_class' => '$28.00'],
            ['vehicle_type' => 'Truck',              'begin_weight' => '8001',    'end_weight' => '10000', 'fee_class' => '$28.00'],
            ['vehicle_type' => 'Truck',              'begin_weight' => '10001',   'end_weight' => '23999', 'fee_class' => '$0.38/100 Lbs'],
            ['vehicle_type' => 'Truck',              'begin_weight' => '24000',   'end_weight' => '37999', 'fee_class' => '$0.60/100 Lbs'],
            ['vehicle_type' => 'Truck',              'begin_weight' => '38000',   'end_weight' => '80000', 'fee_class' => '$0.63/100 Lbs'],
            ['vehicle_type' => 'Truck',              'begin_weight' => '80001',   'end_weight' => '88000', 'fee_class' => '$0.64/100 Lbs'],
            ['vehicle_type' => 'Car',                'begin_weight' => '10000',   'end_weight' => '23999', 'fee_class' => '$0.38/100 Lbs'],
            ['vehicle_type' => 'Car',                'begin_weight' => '24000',   'end_weight' => '37999', 'fee_class' => '$0.60/100 Lbs'],
            ['vehicle_type' => 'Car',                'begin_weight' => '38000',   'end_weight' => '80000', 'fee_class' => '$0.63/100 Lbs'],
            ['vehicle_type' => 'Car',                'begin_weight' => '80001',   'end_weight' => '88000', 'fee_class' => '$0.64/100 Lbs'],
            ['vehicle_type' => 'Van',                'begin_weight' => '10000',   'end_weight' => '23999', 'fee_class' => '$0.38/100 Lbs'],
            ['vehicle_type' => 'Van',                'begin_weight' => '24000',   'end_weight' => '37999', 'fee_class' => '$0.60/100 Lbs'],
            ['vehicle_type' => 'Van',                'begin_weight' => '38000',   'end_weight' => '80000', 'fee_class' => '$0.63/100 Lbs'],
            ['vehicle_type' => 'Van',                'begin_weight' => '80001',   'end_weight' => '88000', 'fee_class' => '$0.64/100 Lbs'],
            ['vehicle_type' => 'Suv',                'begin_weight' => '10000',   'end_weight' => '23999', 'fee_class' => '$0.38/100 Lbs'],
            ['vehicle_type' => 'Suv',                'begin_weight' => '24000',   'end_weight' => '37999', 'fee_class' => '$0.60/100 Lbs'],
            ['vehicle_type' => 'Suv',                'begin_weight' => '38000',   'end_weight' => '80000', 'fee_class' => '$0.63/100 Lbs'],
            ['vehicle_type' => 'Suv',                'begin_weight' => '80001',   'end_weight' => '88000', 'fee_class' => '$0.64/100 Lbs'],
            ['vehicle_type' => 'Truck Tractor',      'begin_weight' => '10001',   'end_weight' => '23999', 'fee_class' => '$0.38/100 Lbs'],
            ['vehicle_type' => 'Truck Tractor',      'begin_weight' => '24000',   'end_weight' => '37999', 'fee_class' => '$0.60/100 Lbs'],
            ['vehicle_type' => 'Truck Tractor',      'begin_weight' => '38000',   'end_weight' => '80000', 'fee_class' => '$0.63/100 Lbs'],
            ['vehicle_type' => 'Truck Tractor',      'begin_weight' => '80001',   'end_weight' => '88000', 'fee_class' => '$0.64/100 Lbs'],
            ['vehicle_type' => 'Farm Truck',         'begin_weight' => '0',       'end_weight' => '6,000', 'fee_class' => '$3.00'],
            ['vehicle_type' => 'Farm Truck',         'begin_weight' => '6001',    'end_weight' => '10000', 'fee_class' => '$3.00'],
            ['vehicle_type' => 'Farm Truck',         'begin_weight' => '10001',   'end_weight' => '23999', 'fee_class' => '$10.00'],
            ['vehicle_type' => 'Farm Truck',         'begin_weight' => '24000',   'end_weight' => '43999', 'fee_class' => '$20.00'],
            ['vehicle_type' => 'Farm Truck',         'begin_weight' => '44000',   'end_weight' => '65999', 'fee_class' => '$30.00'],
            ['vehicle_type' => 'Farm Truck',         'begin_weight' => '66000',   'end_weight' => '88000', 'fee_class' => '$40.00'],
            ['vehicle_type' => 'Farm Car',           'begin_weight' => '10000',   'end_weight' => '23999', 'fee_class' => '$10.00'],
            ['vehicle_type' => 'Farm Car',           'begin_weight' => '24000',   'end_weight' => '43999', 'fee_class' => '$20.00'],
            ['vehicle_type' => 'Farm Car',           'begin_weight' => '44000',   'end_weight' => '65999', 'fee_class' => '$30.00'],
            ['vehicle_type' => 'Farm Car',           'begin_weight' => '66000',   'end_weight' => '88000', 'fee_class' => '$40.00'],
            ['vehicle_type' => 'Farm Suv',           'begin_weight' => '10000',   'end_weight' => '23999', 'fee_class' => '$10.00'],
            ['vehicle_type' => 'Farm Suv',           'begin_weight' => '24000',   'end_weight' => '43999', 'fee_class' => '$20.00'],
            ['vehicle_type' => 'Farm Suv',           'begin_weight' => '44000',   'end_weight' => '65999', 'fee_class' => '$30.00'],
            ['vehicle_type' => 'Farm Suv',           'begin_weight' => '66000',   'end_weight' => '88000', 'fee_class' => '$40.00'],
            ['vehicle_type' => 'Farm Van',           'begin_weight' => '10000',   'end_weight' => '23999', 'fee_class' => '$10.00'],
            ['vehicle_type' => 'Farm Van',           'begin_weight' => '24000',   'end_weight' => '43999', 'fee_class' => '$20.00'],
            ['vehicle_type' => 'Farm Van',           'begin_weight' => '44000',   'end_weight' => '65999', 'fee_class' => '$30.00'],
            ['vehicle_type' => 'Farm Van',           'begin_weight' => '66000',   'end_weight' => '88000', 'fee_class' => '$40.00'],
            ['vehicle_type' => 'Farm Truck Tractor', 'begin_weight' => '0',       'end_weight' => '6,000', 'fee_class' => '$3.00'],
            ['vehicle_type' => 'Farm Truck Tractor', 'begin_weight' => '6001',    'end_weight' => '10000', 'fee_class' => '$3.00'],
            ['vehicle_type' => 'Farm Truck Tractor', 'begin_weight' => '10001',   'end_weight' => '23999', 'fee_class' => '$10.00'],
            ['vehicle_type' => 'Farm Truck Tractor', 'begin_weight' => '24000',   'end_weight' => '43999', 'fee_class' => '$20.00'],
            ['vehicle_type' => 'Farm Truck Tractor', 'begin_weight' => '44000',   'end_weight' => '65999', 'fee_class' => '$30.00'],
            ['vehicle_type' => 'Farm Truck Tractor', 'begin_weight' => '66000',   'end_weight' => '88000', 'fee_class' => '$40.00']
        ];
    }

}
