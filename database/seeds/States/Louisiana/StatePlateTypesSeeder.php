<?php

namespace Thirty98\Seeder\States\Louisiana;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Illuminate\Support\Facades\DB;
use Thirty98\Models\PlateType;
use Thirty98\Models\StatePlateType;

class StatePlateTypesSeeder extends AbstractDatabaseSeeder
{
    public $state_code = 'LA';
    protected $table_name = 'state_plate_types';

    protected function executeSeeder()
    {
        $state = DB::table('states')->where('code', $this->state_code)->first();
        $plateTypes = PlateType::all();
        $plateTypesIndex = [];

        // Build index.
        foreach ($plateTypes as $plateType) {
            $plateTypesIndex[$plateType['slug']] = $plateType['id'];
        }

        foreach ($this->getStatePlateTypes() AS $statePlateType) {
            $plateTypeID = $plateTypesIndex[$statePlateType];

            $exists = StatePlateType::where('plate_type_id', $plateTypeID)
                ->where('state_code', $state->code)
                ->first();

            if (!$exists) {
                DB::table($this->table_name)->insert([
                    'plate_type_id' => $plateTypeID,
                    'state_code' => $state->code
                ]);
            }
        }
    }

    protected function getStatePlateTypes()
    {
        return [
            $this->slugit('Hire Passenger Plate'),
            $this->slugit('No Plate'),
            $this->slugit('Antique Plate'),
            $this->slugit('Boat Trailer Plate'),
            $this->slugit('Car Plate'),
            $this->slugit('1-Yr Commercial Plate'),
            $this->slugit('2-Yr Commercial Plate'),
            $this->slugit('Farm Plate'),
            $this->slugit('Truck Plate'),
            $this->slugit('1-Yr Trailer Plate'),
            $this->slugit('4-Yr Trailer Plate'),
            $this->slugit('Permanent Trailer Plate'),
            $this->slugit('Trailer Plate'),
            $this->slugit('Motor Home Plate'),
            $this->slugit('Motorcycle Plate'),
            $this->slugit('Private Bus Plate')
        ];
    }
}
