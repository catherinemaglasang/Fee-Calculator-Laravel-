<?php

namespace Thirty98\Seeder;

use Thirty98\API\Stdlib\Seeders\AbstractDatabaseSeeder;
use Thirty98\Models\FuelType;

class FuelTypesSeeder extends AbstractDatabaseSeeder
{
    /**
     * @return void
     */
    protected function executeSeeder()
    {
        foreach ($this->getFuelTypes() AS $fuel_type) {

            $exists = FuelType::where($fuel_type)->first();

            if (!$exists) {
                FuelType::insert($fuel_type);
            }

            continue;
        }
    }

    private function getFuelTypes()
    {
        return [
            [
                'code' => 'B',
                'name' => 'Bio Diesel',
                'priority' => 1
            ],
            [
                'code' => 'D',
                'name' => 'Diesel',
                'priority' => 2
            ],
            [
                'code' => 'F',
                'name' => 'Flex Fuel',
                'priority' => 3
            ],
            [
                'code' => 'G',
                'name' => 'Gasoline',
                'priority' => 4
            ],
            [
                'code' => 'I',
                'name' => 'Plug-in Hybrid',
                'priority' => 5
            ],
            [
                'code' => 'L',
                'name' => 'Electric',
                'priority' => 6
            ],
            [
                'code' => 'N',
                'name' => 'Natural Gas',
                'priority' => 7
            ],
            [
                'code' => 'P',
                'name' => 'Propane',
                'priority' => 9
            ],
            [
                'code' => 'Y',
                'name' => 'Gas/Electric Hybrid',
                'priority' => 10
            ],

        ];
    }
}
