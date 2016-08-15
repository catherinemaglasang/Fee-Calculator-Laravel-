<?php

namespace Thirty98\Seeder\States\Arkansas;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Carbon\Carbon;
use Thirty98\Models\ARPassengerWeightFee;

class PassengerWeightFeesSeeder extends AbstractDatabaseSeeder
{
    public $state_code = 'AR';
    protected $table_name = 'ar_passenger_weight_fees';

    protected function executeSeeder()
    {
        foreach ($this->getWeightFees() AS $weight_fee) {

            $exists = ARPassengerWeightFee::where('weight_class_id', '=', $weight_fee['weight_class_id'])
                ->where('min_weight', '=', $weight_fee['min_weight'])
                ->where('max_weight', '=', $weight_fee['max_weight'])
                ->where('reg_fee', '=', $weight_fee['reg_fee'])
                ->where('start_date', '=', $weight_fee['start_date'])
                ->where('end_date', '=', $weight_fee['end_date'])
                ->first();

            if (!$exists) {
                $result = ARPassengerWeightFee::insertGetId($weight_fee);

                if(!is_numeric($result)) { die('Weight Fee Insert Failed.'); }
            }


            continue;
        }
    }

    protected function getWeightFees()
    {
        return [
            [
                'weight_class_id' => 1,
                'min_weight' => 0,
                'max_weight' => 3000,
                'reg_fee' => 17,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date' => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                'weight_class_id' => 2,
                'min_weight' => 3001,
                'max_weight' => 4500,
                'reg_fee' => 25,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date' => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                'weight_class_id' => 3,
                'min_weight' => 4501,
                'max_weight' => 4501,
                'reg_fee' => 30,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date' => Carbon::parse('12/31/2099')->format('Y/m/d')
            ]
        ];
    }

}
