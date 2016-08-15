<?php

namespace Thirty98\Seeder\States\Texas;

use Thirty98\API\Stdlib\Seeders\AbstractStateVehicleTypeSeeder;

class StateVehicleTypeSeeder extends AbstractStateVehicleTypeSeeder
{
    public $state_code = 'TX';
    protected $table_name = 'state_vehicle_types';

    protected function getVehicleTypes()
    {
        return [
            $this->slugit('Passenger'),
            $this->slugit('Van Truck Plates'),
            $this->slugit('SUV Truck Plates'),
            $this->slugit('1/4 Pickup Truck'),
            $this->slugit('1/2 Pickup Truck'),
            $this->slugit('3/4 Pickup Truck'),
            $this->slugit('1 Ton Pickup Truck'),
            $this->slugit('Pickup Truck > 1 Ton'),
            $this->slugit('Truck Tractor'),
            $this->slugit('Combination Truck'),
            $this->slugit('City Bus'),
            $this->slugit('Private Bus'),
            $this->slugit('Motor Bus'),
            $this->slugit('Moped'),
            $this->slugit('Motorcycle'),
            $this->slugit('Off-Road Motorcycle'),
            $this->slugit('Mini-Bike'),
            $this->slugit('ATV Type Vehicle'),
            $this->slugit('Motor Home'),
            $this->slugit('Travel Trailer'),
            $this->slugit('Token Trailer'),
            $this->slugit('Trailer'),
            $this->slugit('Utility Trailer'),
            $this->slugit('Collector Vehicle')
        ];
    }

    protected function getPriorityMap()
    {
        return [
            $this->slugit('Passenger') => 1,
            $this->slugit('Van Truck Plates ') => 2,
            $this->slugit('SUV Truck Plates') => 3,
            $this->slugit('1/4 Pickup Truck') => 4,
            $this->slugit('1/2 Pickup Truck') => 5,
            $this->slugit('3/4 Pickup Truck') => 6,
            $this->slugit('1 Ton Pickup Truck') => 7,
            $this->slugit('Pickup Truck > 1 Ton') => 8,
            $this->slugit('Truck Tractor') => 9,
            $this->slugit('Combination Truck') => 10,
            $this->slugit('City Bus') => 11,
            $this->slugit('Private Bus') => 12,
            $this->slugit('Motor Bus') => 13,
            $this->slugit('Moped') => 14,
            $this->slugit('Motorcycle') => 15,
            $this->slugit('Off-Road Motorcycle') => 16,
            $this->slugit('Mini-Bike') => 17,
            $this->slugit('ATV Type Vehicle') => 18,
            $this->slugit('Motor Home') => 19,
            $this->slugit('Travel Trailer') => 20,
            $this->slugit('Token Trailer') => 21,
            $this->slugit('Trailer') => 22,
            $this->slugit('Utility Trailer') => 23,
            $this->slugit('Collector Vehicle') => 24
        ];
    }
}