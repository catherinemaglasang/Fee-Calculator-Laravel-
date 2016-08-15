<?php

namespace Thirty98\Seeder\States\Louisiana;

use Thirty98\API\Stdlib\Seeders\AbstractStateVehicleTypeSeeder;

class StateVehicleTypeSeeder extends AbstractStateVehicleTypeSeeder
{
    public $state_code = 'LA';
    protected $table_name = 'state_vehicle_types';

    protected function getVehicleTypes()
    {
        return [
            $this->slugit('Car'),
            $this->slugit('Boat Trailer'),
            $this->slugit('Antique Vehicle'),
            $this->slugit('Van'),
            $this->slugit('SUV'),
            $this->slugit('Truck'),
            $this->slugit('Truck Tractor'),
            $this->slugit('Private Bus'),
            $this->slugit('Motor Home'),
            $this->slugit('Motorcycle'),
            $this->slugit('Off-Road Vehicle'),
            $this->slugit('Utility Trailer'),
            $this->slugit('Trailer'),
            $this->slugit('Travel Trailer'),
            $this->slugit('Semi-Trailer'),
            $this->slugit('Bus')
        ];
    }

    public function getPriorityMap()
    {
        return [
            $this->slugit('Car') => 1,
            $this->slugit('Van') => 2,
            $this->slugit('SUV') => 3,
            $this->slugit('Truck') => 4,
            $this->slugit('Antique Vehicle') => 5,
            $this->slugit('Truck Tractor') => 6,
            $this->slugit('Private Bus') => 7,
            $this->slugit('Motor Home') => 8,
            $this->slugit('Motorcycle') => 9,
            $this->slugit('Off-Road Vehicle') => 10,
            $this->slugit('Trailer') => 11,
            $this->slugit('Utility Trailer') => 12,
            $this->slugit('Travel Trailer') => 13,
            $this->slugit('Semi-Trailer') => 14,
            $this->slugit('Boat Trailer') => 15,
            $this->slugit('Bus') => 16
        ];
    }
}