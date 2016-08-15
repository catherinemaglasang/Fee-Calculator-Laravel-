<?php

namespace Thirty98\Seeder\States\Arkansas;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Thirty98\Models\ARWeightFeeClass;

class WeightClassSeeder extends AbstractDatabaseSeeder
{
    public $state_code = 'AR';
    protected $table_name = 'ar_weight_fee_classes';

    protected function executeSeeder()
    {
        foreach ($this->getWeightClasses() AS $weight_class) {
            $exists = ARWeightFeeClass::where('weight_class', '=', $weight_class['weight_class'])
                ->where('min_gvwr', '=', $weight_class['min_gvwr'])
                ->where('max_gvwr', '=', $weight_class['max_gvwr'])
                ->first();

            if (!$exists) {
                $result = ARWeightFeeClass::insertGetId($weight_class);

                if (!$result) {
                    die('Weight fee class ID insert failed. ' . PHP_EOL);
                }

            }

            continue;
        }
    }

    protected function getWeightClasses()
    {
        return [
            [
                'weight_class' => "2",
                "min_gvwr" => 10001,
                "max_gvwr" => 14000
            ],
            [
                'weight_class' => "3",
                "min_gvwr" => 10001,
                "max_gvwr" => 14000
            ],
            [
                'weight_class' => "4",
                "min_gvwr" => 14001,
                "max_gvwr" => 16000
            ],
            [
                'weight_class' => "5",
                "min_gvwr" => 16001,
                "max_gvwr" => 19500
            ],
            [
                'weight_class' => "6",
                "min_gvwr" => 19501,
                "max_gvwr" => 26000
            ],
            [
                'weight_class' => "7",
                "min_gvwr" => 26001,
                "max_gvwr" => 33000
            ],
            [
                'weight_class' => "8",
                "min_gvwr" => 33001,
                "max_gvwr" => 0
            ],

        ];
    }

}
