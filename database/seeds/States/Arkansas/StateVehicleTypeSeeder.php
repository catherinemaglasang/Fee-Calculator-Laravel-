<?php

namespace Thirty98\Seeder\States\Arkansas;

use Thirty98\API\Stdlib\Seeders\AbstractStateVehicleTypeSeeder;

class StateVehicleTypeSeeder extends AbstractStateVehicleTypeSeeder
{
    public $state_code = 'AR';
    protected $table_name = 'state_vehicle_types';

    protected function getVehicleTypes()
    {
        return [
            $this->slugit('Passenger'),
            $this->slugit('Motor Home'),
            $this->slugit('1/2 Pickup Van'),
            $this->slugit('3/4 Pickup Van'),
            $this->slugit('1 Ton Pickup Van'),
            $this->slugit('1/2 Pickup Truck'),
            $this->slugit('3/4 Pickup Truck'),
            $this->slugit('1 Ton Pickup Truck'),
            $this->slugit('Commercial Truck'),
            $this->slugit('Truck Tractor'),
            $this->slugit('City Bus'),
            $this->slugit('Private Bus'),
            $this->slugit('Motor Bus'),
            $this->slugit('Moped'),
            $this->slugit('Motorcycle'),
            $this->slugit('Motorcycle Side Car'),
            $this->slugit('Off-Road Motorcycle'),
            $this->slugit('ATV Type Vehicle'),
            $this->slugit('Motorized Bike Standard'),
            $this->slugit('Motorized Bike Automatic'),
            $this->slugit('Semi Trailer'),
            $this->slugit('Trailer'),
            $this->slugit('Utility Trailer')
        ];
    }

    public function getPriorityMap()
    {
        return [
            $this->slugit('Passenger') => 1,
            $this->slugit('Motor Home') => 2,
            $this->slugit('1/2 Pickup Van') => 3,
            $this->slugit('3/4 Pickup Van') => 4,
            $this->slugit('1 Ton Pickup Van') => 5,
            $this->slugit('1/2 Pickup Truck') => 6,
            $this->slugit('3/4 Pickup Truck') => 7,
            $this->slugit('1 Ton Pickup Truck') => 8,
            $this->slugit('Commercial Truck') => 9,
            $this->slugit('Truck Tractor') => 10,
            $this->slugit('City Bus') => 11,
            $this->slugit('Private Bus') => 12,
            $this->slugit('Motor Bus') => 13,
            $this->slugit('Moped') => 14,
            $this->slugit('Motorcycle') => 15,
            $this->slugit('Motorcycle Side Car') => 16,
            $this->slugit('Off-Road Motorcycle') => 17,
            $this->slugit('ATV Type Vehicle') => 18,
            $this->slugit('Motorized Bike Standard') => 20,
            $this->slugit('Motorized Bike Automatic') => 21,
            $this->slugit('Semi Trailer') => 22,
            $this->slugit('Trailer') => 23,
            $this->slugit('Utility Trailer') => 24
        ];
    }
}