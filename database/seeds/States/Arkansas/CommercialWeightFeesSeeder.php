<?php

namespace Thirty98\Seeder\States\Arkansas;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Thirty98\Models\ARCommercialWeightFee;
use Thirty98\Models\ARTruckClass;
use Thirty98\Models\ARWeightFeeClass;
use Carbon\Carbon;

class CommercialWeightFeesSeeder extends AbstractDatabaseSeeder
{
    public $state_code = 'AR';

    protected function executeSeeder()
    {
        $ar_weight_classes = ARWeightFeeClass::all();
        $ar_truck_classes = ARTruckClass::all();

        $ar_weight_classes_indexes = [];
        $ar_truck_classes_indexes = [];

        foreach ($ar_weight_classes as $ar_weight_class) {
            $ar_weight_classes_indexes[$ar_weight_class['weight_class']] = $ar_weight_class['id'];
        }

        foreach ($ar_truck_classes as $ar_truck_class) {
            $ar_truck_classes_indexes[$ar_truck_class['name']] = $ar_truck_class['id'];
        }

        $start_date = Carbon::parse('5/1/2014')->format('Y/m/d');
        $end_date = Carbon::parse('12/31/2099')->format('Y/m/d');

        foreach ($this->getCommercialWeightFees() AS $weight_fee) {

            // WT_CLASS	TRK_CLASS	AXLE	MIN_WEIGHT	MAX_WEIGHT	REG_FEE	START_DT	END_DT}
            $weight_class_id = $ar_weight_classes_indexes[$weight_fee['weight_class_id']];
            $truck_class_id = $ar_truck_classes_indexes[$weight_fee['truck_class_id']];
            $axle = $weight_fee['axle'];
            $min_weight = $weight_fee['min_weight'];
            $max_weight = $weight_fee['max_weight'];
            $reg_fee = $weight_fee['reg_fee'];

            $exists = ARCommercialWeightFee::where('weight_class_id', '=', $weight_class_id)
                ->where('truck_class_id', '=', $truck_class_id)
                ->where('axle', '=', $axle)
                ->where('min_weight', '=', $min_weight)
                ->where('max_weight', '=', $max_weight)
                ->where('reg_fee', '=', $reg_fee)
                ->where('start_date', '=', $start_date)
                ->where('end_date', '=', $end_date)
                ->first();

            if (!$exists) {
                $result = ARCommercialWeightFee::insertGetId([
                    'weight_class_id' => $weight_class_id,
                    'truck_class_id' => $truck_class_id,
                    'axle' => $axle,
                    'min_weight' => $min_weight,
                    'max_weight' => $max_weight,
                    'reg_fee' => $reg_fee,
                    'start_date' => $start_date,
                    'end_date' => $end_date
                ]);

                if (!is_numeric($result)) {
                    die('Error inserting Commercial Weight Fees Seeder.');
                }
            }

            continue;
        }
    }

    protected function getCommercialWeightFees()
    {
        return [
            ['weight_class_id' => '2', 'truck_class_id' => 'B', 'axle' => '0', 'min_weight' => '6001', 'max_weight' => '6999', 'reg_fee' => '39.00'],
            ['weight_class_id' => '2', 'truck_class_id' => 'B', 'axle' => '0', 'min_weight' => '7000', 'max_weight' => '7999', 'reg_fee' => '46.00'],
            ['weight_class_id' => '2', 'truck_class_id' => 'B', 'axle' => '0', 'min_weight' => '8000', 'max_weight' => '8999', 'reg_fee' => '52.00'],
            ['weight_class_id' => '2', 'truck_class_id' => 'B', 'axle' => '0', 'min_weight' => '9000', 'max_weight' => '9999', 'reg_fee' => '59.00'],
            ['weight_class_id' => '2', 'truck_class_id' => 'B', 'axle' => '0', 'min_weight' => '10000', 'max_weight' => '10999', 'reg_fee' => '65.00'],
            ['weight_class_id' => '2', 'truck_class_id' => 'B', 'axle' => '0', 'min_weight' => '11000', 'max_weight' => '11999', 'reg_fee' => '72.00'],
            ['weight_class_id' => '2', 'truck_class_id' => 'B', 'axle' => '0', 'min_weight' => '12000', 'max_weight' => '12999', 'reg_fee' => '78.00'],
            ['weight_class_id' => '2', 'truck_class_id' => 'B', 'axle' => '0', 'min_weight' => '13000', 'max_weight' => '13999', 'reg_fee' => '85.00'],
            ['weight_class_id' => '2', 'truck_class_id' => 'B', 'axle' => '0', 'min_weight' => '14000', 'max_weight' => '14999', 'reg_fee' => '91.00'],
            ['weight_class_id' => '2', 'truck_class_id' => 'B', 'axle' => '0', 'min_weight' => '15000', 'max_weight' => '15999', 'reg_fee' => '98.00'],
            ['weight_class_id' => '2', 'truck_class_id' => 'B', 'axle' => '0', 'min_weight' => '16000', 'max_weight' => '16999', 'reg_fee' => '104.00'],
            ['weight_class_id' => '2', 'truck_class_id' => 'B', 'axle' => '0', 'min_weight' => '17000', 'max_weight' => '17999', 'reg_fee' => '111.00'],
            ['weight_class_id' => '2', 'truck_class_id' => 'B', 'axle' => '0', 'min_weight' => '18000', 'max_weight' => '18999', 'reg_fee' => '117.00'],
            ['weight_class_id' => '2', 'truck_class_id' => 'B', 'axle' => '0', 'min_weight' => '19000', 'max_weight' => '20000', 'reg_fee' => '124.00'],
            ['weight_class_id' => '3', 'truck_class_id' => 'C', 'axle' => '0', 'min_weight' => '20001', 'max_weight' => '20999', 'reg_fee' => '124.00'],
            ['weight_class_id' => '3', 'truck_class_id' => 'C', 'axle' => '0', 'min_weight' => '21000', 'max_weight' => '21999', 'reg_fee' => '177.00'],
            ['weight_class_id' => '3', 'truck_class_id' => 'C', 'axle' => '0', 'min_weight' => '22000', 'max_weight' => '22999', 'reg_fee' => '186.00'],
            ['weight_class_id' => '3', 'truck_class_id' => 'C', 'axle' => '0', 'min_weight' => '23000', 'max_weight' => '23999', 'reg_fee' => '194.00'],
            ['weight_class_id' => '3', 'truck_class_id' => 'C', 'axle' => '0', 'min_weight' => '24000', 'max_weight' => '24999', 'reg_fee' => '203.00'],
            ['weight_class_id' => '3', 'truck_class_id' => 'C', 'axle' => '0', 'min_weight' => '25000', 'max_weight' => '25999', 'reg_fee' => '211.00'],
            ['weight_class_id' => '3', 'truck_class_id' => 'C', 'axle' => '0', 'min_weight' => '26000', 'max_weight' => '26999', 'reg_fee' => '220.00'],
            ['weight_class_id' => '3', 'truck_class_id' => 'C', 'axle' => '0', 'min_weight' => '27000', 'max_weight' => '27999', 'reg_fee' => '228.00'],
            ['weight_class_id' => '3', 'truck_class_id' => 'C', 'axle' => '0', 'min_weight' => '28000', 'max_weight' => '28999', 'reg_fee' => '237.00'],
            ['weight_class_id' => '3', 'truck_class_id' => 'C', 'axle' => '0', 'min_weight' => '29000', 'max_weight' => '29999', 'reg_fee' => '245.00'],
            ['weight_class_id' => '3', 'truck_class_id' => 'C', 'axle' => '0', 'min_weight' => '30000', 'max_weight' => '30999', 'reg_fee' => '254.00'],
            ['weight_class_id' => '3', 'truck_class_id' => 'C', 'axle' => '0', 'min_weight' => '31000', 'max_weight' => '31999', 'reg_fee' => '262.00'],
            ['weight_class_id' => '3', 'truck_class_id' => 'C', 'axle' => '0', 'min_weight' => '32000', 'max_weight' => '32999', 'reg_fee' => '270.00'],
            ['weight_class_id' => '3', 'truck_class_id' => 'C', 'axle' => '0', 'min_weight' => '33000', 'max_weight' => '33999', 'reg_fee' => '279.00'],
            ['weight_class_id' => '3', 'truck_class_id' => 'C', 'axle' => '0', 'min_weight' => '34000', 'max_weight' => '34999', 'reg_fee' => '287.00'],
            ['weight_class_id' => '3', 'truck_class_id' => 'C', 'axle' => '0', 'min_weight' => '35000', 'max_weight' => '35999', 'reg_fee' => '296.00'],
            ['weight_class_id' => '3', 'truck_class_id' => 'C', 'axle' => '0', 'min_weight' => '36000', 'max_weight' => '36999', 'reg_fee' => '304.00'],
            ['weight_class_id' => '3', 'truck_class_id' => 'C', 'axle' => '0', 'min_weight' => '37000', 'max_weight' => '37999', 'reg_fee' => '313.00'],
            ['weight_class_id' => '3', 'truck_class_id' => 'C', 'axle' => '0', 'min_weight' => '38000', 'max_weight' => '38999', 'reg_fee' => '321.00'],
            ['weight_class_id' => '3', 'truck_class_id' => 'C', 'axle' => '0', 'min_weight' => '39000', 'max_weight' => '40000', 'reg_fee' => '330.00'],
            ['weight_class_id' => '4', 'truck_class_id' => 'D', 'axle' => '0', 'min_weight' => '40001', 'max_weight' => '40999', 'reg_fee' => '442.00'],
            ['weight_class_id' => '4', 'truck_class_id' => 'D', 'axle' => '0', 'min_weight' => '41000', 'max_weight' => '41999', 'reg_fee' => '453.00'],
            ['weight_class_id' => '4', 'truck_class_id' => 'D', 'axle' => '0', 'min_weight' => '42000', 'max_weight' => '42999', 'reg_fee' => '464.00'],
            ['weight_class_id' => '4', 'truck_class_id' => 'D', 'axle' => '0', 'min_weight' => '43000', 'max_weight' => '43999', 'reg_fee' => '475.00'],
            ['weight_class_id' => '4', 'truck_class_id' => 'D', 'axle' => '0', 'min_weight' => '44000', 'max_weight' => '44999', 'reg_fee' => '486.00'],
            ['weight_class_id' => '4', 'truck_class_id' => 'D', 'axle' => '0', 'min_weight' => '45000', 'max_weight' => '45999', 'reg_fee' => '497.00'],
            ['weight_class_id' => '4', 'truck_class_id' => 'D', 'axle' => '0', 'min_weight' => '46000', 'max_weight' => '46999', 'reg_fee' => '508.00'],
            ['weight_class_id' => '4', 'truck_class_id' => 'D', 'axle' => '0', 'min_weight' => '47000', 'max_weight' => '47999', 'reg_fee' => '519.00'],
            ['weight_class_id' => '4', 'truck_class_id' => 'D', 'axle' => '0', 'min_weight' => '48000', 'max_weight' => '48999', 'reg_fee' => '530.00'],
            ['weight_class_id' => '4', 'truck_class_id' => 'D', 'axle' => '0', 'min_weight' => '49000', 'max_weight' => '49999', 'reg_fee' => '541.00'],
            ['weight_class_id' => '4', 'truck_class_id' => 'D', 'axle' => '0', 'min_weight' => '50000', 'max_weight' => '50999', 'reg_fee' => '553.00'],
            ['weight_class_id' => '4', 'truck_class_id' => 'D', 'axle' => '0', 'min_weight' => '51000', 'max_weight' => '51999', 'reg_fee' => '564.00'],
            ['weight_class_id' => '4', 'truck_class_id' => 'D', 'axle' => '0', 'min_weight' => '52000', 'max_weight' => '52999', 'reg_fee' => '575.00'],
            ['weight_class_id' => '4', 'truck_class_id' => 'D', 'axle' => '0', 'min_weight' => '53000', 'max_weight' => '53999', 'reg_fee' => '586.00'],
            ['weight_class_id' => '4', 'truck_class_id' => 'D', 'axle' => '0', 'min_weight' => '54000', 'max_weight' => '54999', 'reg_fee' => '597.00'],
            ['weight_class_id' => '4', 'truck_class_id' => 'D', 'axle' => '0', 'min_weight' => '55000', 'max_weight' => '56000', 'reg_fee' => '608.00'],
            ['weight_class_id' => '5', 'truck_class_id' => 'E', 'axle' => '0', 'min_weight' => '56001', 'max_weight' => '56999', 'reg_fee' => '692.00'],
            ['weight_class_id' => '5', 'truck_class_id' => 'E', 'axle' => '0', 'min_weight' => '57000', 'max_weight' => '57999', 'reg_fee' => '704.00'],
            ['weight_class_id' => '5', 'truck_class_id' => 'E', 'axle' => '0', 'min_weight' => '58000', 'max_weight' => '58999', 'reg_fee' => '716.00'],
            ['weight_class_id' => '5', 'truck_class_id' => 'E', 'axle' => '0', 'min_weight' => '59000', 'max_weight' => '60000', 'reg_fee' => '729.00'],
            ['weight_class_id' => '6', 'truck_class_id' => 'H', 'axle' => '0', 'min_weight' => '60001', 'max_weight' => '60999', 'reg_fee' => '819.00'],
            ['weight_class_id' => '6', 'truck_class_id' => 'H', 'axle' => '0', 'min_weight' => '61000', 'max_weight' => '61999', 'reg_fee' => '833.00'],
            ['weight_class_id' => '6', 'truck_class_id' => 'H', 'axle' => '0', 'min_weight' => '62000', 'max_weight' => '62999', 'reg_fee' => '846.00'],
            ['weight_class_id' => '6', 'truck_class_id' => 'H', 'axle' => '0', 'min_weight' => '63000', 'max_weight' => '63999', 'reg_fee' => '860.00'],
            ['weight_class_id' => '6', 'truck_class_id' => 'H', 'axle' => '0', 'min_weight' => '64000', 'max_weight' => '64999', 'reg_fee' => '874.00'],
            ['weight_class_id' => '6', 'truck_class_id' => 'H', 'axle' => '0', 'min_weight' => '65000', 'max_weight' => '65999', 'reg_fee' => '887.00'],
            ['weight_class_id' => '6', 'truck_class_id' => 'H', 'axle' => '0', 'min_weight' => '66000', 'max_weight' => '66999', 'reg_fee' => '901.00'],
            ['weight_class_id' => '6', 'truck_class_id' => 'H', 'axle' => '0', 'min_weight' => '67000', 'max_weight' => '68000', 'reg_fee' => '915.00'],
            ['weight_class_id' => '7', 'truck_class_id' => 'J', 'axle' => '0', 'min_weight' => '68001', 'max_weight' => '68999', 'reg_fee' => '972.00'],
            ['weight_class_id' => '7', 'truck_class_id' => 'J', 'axle' => '0', 'min_weight' => '69000', 'max_weight' => '69999', 'reg_fee' => '987.00'],
            ['weight_class_id' => '7', 'truck_class_id' => 'J', 'axle' => '0', 'min_weight' => '70000', 'max_weight' => '70999', 'reg_fee' => '1001.00'],
            ['weight_class_id' => '7', 'truck_class_id' => 'J', 'axle' => '0', 'min_weight' => '71000', 'max_weight' => '71999', 'reg_fee' => '1015.00'],
            ['weight_class_id' => '7', 'truck_class_id' => 'J', 'axle' => '0', 'min_weight' => '72000', 'max_weight' => '72999', 'reg_fee' => '1030.00'],
            ['weight_class_id' => '7', 'truck_class_id' => 'J', 'axle' => '0', 'min_weight' => '73000', 'max_weight' => '73280', 'reg_fee' => '1044.00'],
            ['weight_class_id' => '7', 'truck_class_id' => 'K', 'axle' => '0', 'min_weight' => '73281', 'max_weight' => '80000', 'reg_fee' => '1350.00'],
            ['weight_class_id' => '8', 'truck_class_id' => 'Farm', 'axle' => '2', 'min_weight' => '8000', 'max_weight' => '8999', 'reg_fee' => '33.00'],
            ['weight_class_id' => '8', 'truck_class_id' => 'Farm', 'axle' => '2', 'min_weight' => '9000', 'max_weight' => '9999', 'reg_fee' => '35.00'],
            ['weight_class_id' => '8', 'truck_class_id' => 'Farm', 'axle' => '2', 'min_weight' => '10000', 'max_weight' => '10999', 'reg_fee' => '39.00'],
            ['weight_class_id' => '8', 'truck_class_id' => 'Farm', 'axle' => '2', 'min_weight' => '11000', 'max_weight' => '11999', 'reg_fee' => '43.00'],
            ['weight_class_id' => '8', 'truck_class_id' => 'Farm', 'axle' => '2', 'min_weight' => '12000', 'max_weight' => '12999', 'reg_fee' => '47.00'],
            ['weight_class_id' => '8', 'truck_class_id' => 'Farm', 'axle' => '2', 'min_weight' => '13000', 'max_weight' => '13999', 'reg_fee' => '51.00'],
            ['weight_class_id' => '8', 'truck_class_id' => 'Farm', 'axle' => '2', 'min_weight' => '14000', 'max_weight' => '14999', 'reg_fee' => '55.00'],
            ['weight_class_id' => '8', 'truck_class_id' => 'Farm', 'axle' => '2', 'min_weight' => '15000', 'max_weight' => '15999', 'reg_fee' => '59.00'],
            ['weight_class_id' => '8', 'truck_class_id' => 'Farm', 'axle' => '2', 'min_weight' => '16000', 'max_weight' => '16999', 'reg_fee' => '62.00'],
            ['weight_class_id' => '8', 'truck_class_id' => 'Farm', 'axle' => '2', 'min_weight' => '17000', 'max_weight' => '17999', 'reg_fee' => '65.00'],
            ['weight_class_id' => '8', 'truck_class_id' => 'Farm', 'axle' => '3', 'min_weight' => 'N/A', 'max_weight' => 'N/A', 'reg_fee' => '98.00'],
            ['weight_class_id' => '8', 'truck_class_id' => 'Farm', 'axle' => '4', 'min_weight' => 'N/A', 'max_weight' => 'N/A', 'reg_fee' => '130.00'],
            ['weight_class_id' => '8', 'truck_class_id' => 'Farm', 'axle' => '5', 'min_weight' => 'N/A', 'max_weight' => 'N/A', 'reg_fee' => '163.00']
        ];
    }

}
