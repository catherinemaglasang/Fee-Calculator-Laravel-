<?php

namespace Thirty98\Seeder\States\Louisiana;

use Thirty98\API\Stdlib\Seeders\AbstractDatabaseSeeder;
use Illuminate\Support\Facades\DB;
use Thirty98\Models\FuelType;
use Thirty98\Models\StateFuelType;

class FuelTypesSeederLouisiana extends AbstractDatabaseSeeder
{
    protected $state_code = 'LA';

    /**
     * @return void
     */
    protected function executeSeeder()
    {
        $state = DB::table('states')->where('code', $this->state_code)->first();

        // Build index for fast insert.
        $fuel_types = FuelType::all();
        $fuel_types_index = [];

        foreach($fuel_types as $fuel_type) {
            $fuel_types_index[$fuel_type['code']] = $fuel_type['id'];
        }

        foreach ($this->getFuelTypes() AS $fuel_type) {
            $fuel_type_id = $fuel_types_index[$fuel_type['code']];

            $exists = StateFuelType::where([
                'fuel_type_id' => $fuel_type_id,
                'state_code' => $state->code
            ])->first();

            if (!$exists) {
                StateFuelType::insert([
                    'fuel_type_id' => $fuel_type_id,
                    'state_code' => $state->code
                ]);
            }

            continue;
        }
    }

    private function getFuelTypes()
    {
        return [
            ['code' => 'B'],
            ['code' => 'D'],
            ['code' => 'F'],
            ['code' => 'G'],
            ['code' => 'I'],
            ['code' => 'L'],
            ['code' => 'N'],
            ['code' => 'P'],
            ['code' => 'Y']
        ];
    }
}
