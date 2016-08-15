<?php

namespace Thirty98\Seeder\States\Louisiana;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Illuminate\Support\Facades\DB;
use Thirty98\Models\PlateType;

class PlateTypesSeeder extends AbstractDatabaseSeeder
{
    protected $table_name = 'plate_types';

    protected function executeSeeder()
    {
        foreach ($this->getPlateTypes() as $plateType) {
            $name = $plateType['name'];
            $slug = $plateType['slug'];

            $exists = PlateType::where('slug', $slug)->first();

            if (!$exists) {
                DB::table($this->table_name)->insert([
                    'name' => $name,
                    'slug' => $slug
                ]);
            }
        }
    }

    protected function getPlateTypes()
    {
        return [
            [
                'name' => 'Hire Passenger Plate',
                'slug' => $this->slugit('Hire Passenger Plate')
            ],
            [
                'name' => 'No Plate',
                'slug' => $this->slugit('No Plate')
            ],
            [
                'name' => 'Antique Plate',
                'slug' => $this->slugit('Antique Plate')
            ],
            [
                'name' => 'Boat Trailer Plate',
                'slug' => $this->slugit('Boat Trailer Plate')
            ],
            [
                'name' => 'Car Plate',
                'slug' => $this->slugit('Car Plate')
            ],
            [
                'name' => '1-Yr Commercial Plate',
                'slug' => $this->slugit('1-Yr Commercial Plate')
            ],
            [
                'name' => '2-Yr Commercial Plate',
                'slug' => $this->slugit('2-Yr Commercial Plate')
            ],
            [
                'name' => 'Farm Plate',
                'slug' => $this->slugit('Farm Plate')
            ],
            [
                'name' => 'Truck Plate',
                'slug' => $this->slugit('Truck Plate')
            ],
            [
                'name' => '1-Yr Trailer Plate',
                'slug' => $this->slugit('1-Yr Trailer Plate')
            ],
            [
                'name' => '4-Yr Trailer Plate',
                'slug' => $this->slugit('4-Yr Trailer Plate')
            ],
            [
                'name' => 'Permanent Trailer Plate',
                'slug' => $this->slugit('Permanent Trailer Plate')
            ],
            [
                'name' => 'Trailer Plate',
                'slug' => $this->slugit('Trailer Plate')
            ],
            [
                'name' => 'Motor Home Plate',
                'slug' => $this->slugit('Motor Home Plate')
            ],
            [
                'name' => 'Motorcycle Plate',
                'slug' => $this->slugit('Motorcycle Plate')
            ],
            [
                'name' => 'Private Bus Plate',
                'slug' => $this->slugit('Private Bus Plate')
            ]
        ];
    }
}
