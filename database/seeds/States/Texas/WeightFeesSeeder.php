<?php

namespace Thirty98\Seeder\States\Texas;

use Carbon\Carbon;
use Thirty98\API\Stdlib\Seeders\AbstractDatabaseSeeder;
use Thirty98\Models\TXWeightFee;

class WeightFeesSeeder extends AbstractDatabaseSeeder
{
    public $state_code = 'TX';
    protected $table_name = 'tx_weight_fees';

    protected function executeSeeder()
    {
        foreach ($this->getWeightFees() as $weight_fee) {
            $exists = TXWeightFee::where([
                'weight_class' => $weight_fee['weight_class'],
                'start_date' => $weight_fee['start_date'],
                'end_date' => $weight_fee['end_date']
            ])->first();

            if (!$exists) {
                TXWeightFee::insert($weight_fee);
            }
        }
    }

    protected function getWeightFees()
    {
        return [
            [
                'weight_class' => 1,
                'min_weight' => 0,
                'max_weight' => 60000,
                'reg_fee' => 50.75,
                'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
            ],
            [
                'weight_class' => 2,
                'min_weight' => 6001,
                'max_weight' => 10000,
                'reg_fee' => 54.00,
                'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
            ],
            [
                'weight_class' => 3,
                'min_weight' => 10001,
                'max_weight' => 18000,
                'reg_fee' => 110.00,
                'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
            ],
            [
                'weight_class' => 4,
                'min_weight' => 18001,
                'max_weight' => 25999,
                'reg_fee' => 205.00,
                'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
            ],
            [
                'weight_class' => 5,
                'min_weight' => 26000,
                'max_weight' => 40000,
                'reg_fee' => 340.00,
                'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
            ],
            [
                'weight_class' => 6,
                'min_weight' => 40001,
                'max_weight' => 54999,
                'reg_fee' => 535.00,
                'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
            ],
            [
                'weight_class' => 7,
                'min_weight' => 55000,
                'max_weight' => 70000,
                'reg_fee' => 740.00,
                'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
            ],
            [
                'weight_class' => 8,
                'min_weight' => 70001,
                'max_weight' => 80000,
                'reg_fee' => 840.00,
                'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
            ],

        ];
    }
}