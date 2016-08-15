<?php

namespace Thirty98\Seeder\States\Arkansas;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Thirty98\Models\ARPullingUnit;

class TagPullingUnitsSeeder extends AbstractDatabaseSeeder
{
    public $state_code = 'AR';
    protected $table_name = 'ar_pulling_units';

    protected function executeSeeder()
    {
        foreach ($this->getPullingUnits() AS $pulling_unit) {
            $exists = ARPullingUnit::where('name', $pulling_unit)->first();

            if (!$exists) {
                $result = ARPullingUnit::insertGetId([
                    'name' => $pulling_unit
                ]);

                if (!$result) {
                    die('Arkansas Tag Prefix Adding Failed. ' . PHP_EOL);
                }
            }

            continue;
        }
    }

    /**
     *  PASSENGER
     * TRK-CLASS1
     * CLASS2
     * CLASS3
     * CLASS4
     * CLASS5
     * CLASS6
     * CLASS7
     * CLASS8
     * CLASS2
     * CLASS3
     * CLASS4
     * CLASS5
     * CLASS6
     * CLASS7
     * CLASS8
     * FULL_TRAILER
     * FULL_FARM_TRAILER
     */

    protected function getPullingUnits()
    {
        return [
            "PASSENGER",
            "TRK-CLASS1",
            "CLASS2",
            "CLASS3",
            "CLASS4",
            "CLASS5",
            "CLASS6",
            "CLASS7",
            "CLASS8",
            "FULL_TRAILER",
            "FULL_FARM_TRAILER"
        ];
    }

}
