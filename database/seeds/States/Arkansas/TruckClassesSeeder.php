<?php

namespace Thirty98\Seeder\States\Arkansas;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Thirty98\Models\ARTruckClass;

class TruckClassesSeeder extends AbstractDatabaseSeeder
{
    public $state_code = 'AR';
    protected $table_name = 'ar_truck_classes';

    protected function executeSeeder()
    {
        foreach ($this->getTruckClasses() AS $truck_class) {
            $exists = ARTruckClass::where('name', $truck_class)->first();

            if (!$exists) {
                $result = ARTruckClass::insertGetId([
                    'name' => $truck_class
                ]);

                if (!$result) {
                    die('Arkansas Truck Class    Adding Failed. ' . PHP_EOL);
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

    protected function getTruckClasses()
    {
        return [
            'B',
            'C',
            'D',
            'E',
            'H',
            'J',
            'K',
            'Farm',
            'Farm'
        ];
    }

}
