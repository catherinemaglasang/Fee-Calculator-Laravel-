<?php

namespace Thirty98\Seeder\States\Louisiana;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Thirty98\Models\PlateType;
use Thirty98\Models\StatePlateType;
use Thirty98\Models\StateVehicleType;
use Thirty98\Models\StateVehiclePlateType;
use Thirty98\Models\VehicleType;

class StateVehiclePlateTypesSeeder extends AbstractDatabaseSeeder
{
    public $state_code = 'LA';
    protected $table_name = 'state_vehicle_plate_types';

    protected function executeSeeder()
    {
        $vehicleTypes = VehicleType::all();
        $plateTypes = PlateType::all();

        $stateVehicleTypes = StateVehicleType::where('state_code', $this->state_code)->get();
        $statePlateTypes = StatePlateType::where('state_code', $this->state_code)->get();

        $vehicleTypesIndexes = [];
        $plateTypesIndexes = [];
        $stateVehicleTypesIndexes = [];
        $statePlateTypesIndexes = [];

        // Build indexes for fast insert.
        foreach ($vehicleTypes as $vehicleType) {
            $vehicleTypesIndexes[$vehicleType['slug']] = $vehicleType['id'];
        }

        foreach ($plateTypes as $plateType) {
            $plateTypesIndexes[$plateType['slug']] = $plateType['id'];
        }

        foreach ($stateVehicleTypes as $stateVehicleType) {
            $stateVehicleTypesIndexes[$stateVehicleType['vehicle_type_id']] = $stateVehicleType['id'];
        }

        foreach ($statePlateTypes as $statePlateType) {
            $statePlateTypesIndexes[$statePlateType['plate_type_id']] = $statePlateType['id'];
        }

        foreach ($this->getStateVehiclePlateTypes() as $vehiclePlateType) {
            $vehicleTypeID = $vehicleTypesIndexes[$vehiclePlateType['vehicle_slug']];
            $vehiclePlateTypes = $vehiclePlateType['plate_types'];

            foreach ($vehiclePlateTypes as $vehiclePlateType) {

                $plateTypeID = $plateTypesIndexes[$vehiclePlateType];
                $statePlateTypeID = $statePlateTypesIndexes[$plateTypeID];
                $stateVehicleTypeID = $stateVehicleTypesIndexes[$vehicleTypeID];

                $exists = StateVehiclePlateType::where('state_vehicle_id', $stateVehicleTypeID)
                    ->where('state_plate_type_id', $statePlateTypeID)
                    ->first();

                if (!$exists) {
                    $priorityMap = [
                        $this->slugit('Car Plate')                  => 1,
                        $this->slugit('Truck Plate')                => 2,
                        $this->slugit('1-Yr Commercial Plate')      => 3,
                        $this->slugit('2-Yr Commercial Plate')      => 4,
                        $this->slugit('Farm Plate')                 => 5,
                        $this->slugit('Private Bus Plate')          => 6,
                        $this->slugit('Motor Home Plate')           => 7,
                        $this->slugit('Motorcycle Plate')           => 8,
                        $this->slugit('Trailer Plate')              => 9,
                        $this->slugit('1-Yr Trailer Plate')         => 10,
                        $this->slugit('4-Yr Trailer  Plate')        => 11,
                        $this->slugit('Permanent Trailer Plate')    => 12,
                        $this->slugit('Antique Plate')              => 13,
                        $this->slugit('No Plate')                   => 14,
                        $this->slugit('Boat Trailer Plate')         => 15,
                        $this->slugit('Hire Passenger Plate')       => 16
                    ];

                    StateVehiclePlateType::insert([
                        'state_vehicle_id' => $stateVehicleTypeID,
                        'state_plate_type_id' => $statePlateTypeID,
                        'priority' => $priorityMap[$vehiclePlateType]
                    ]);
                }
            }
        }
    }

    protected function getStateVehiclePlateTypes()
    {
        return [
            [
                'vehicle_slug' => $this->slugit('Car'),
                'plate_types' => [
                    $this->slugit('Car Plate'),
                    $this->slugit('1-Yr Commercial Plate'),
                    $this->slugit('2-Yr Commercial Plate'),
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Van'),
                'plate_types' => [
                    $this->slugit('Car Plate'),
                    $this->slugit('1-Yr Commercial Plate'),
                    $this->slugit('2-Yr Commercial Plate'),
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('SUV'),
                'plate_types' => [
                    $this->slugit('Car Plate'),
                    $this->slugit('1-Yr Commercial Plate'),
                    $this->slugit('2-Yr Commercial Plate'),
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Truck'),
                'plate_types' => [
                    $this->slugit('Truck Plate'),
                    $this->slugit('Farm Plate'),
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Truck Tractor'),
                'plate_types' => [
                    $this->slugit('Truck Plate'),
                    $this->slugit('Farm Plate'),
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Bus'),
                'plate_types' => [
                    $this->slugit('Private Bus Plate'),
                    $this->slugit('Hire Passenger Plate'),
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Motorcycle'),
                'plate_types' => [
                    $this->slugit('Motorcycle Plate')
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Off-Road Vehicle'),
                'plate_types' => [
                    $this->slugit('No Plate')
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Motor Home'),
                'plate_types' => [
                    $this->slugit('Motor Home Plate')
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Semi-Trailer'),
                'plate_types' => [
                    $this->slugit('1-Yr Trailer Plate'),
                    $this->slugit('4-Yr Trailer Plate'),
                    $this->slugit('Permanent Trailer Plate'),

                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Trailer'),
                'plate_types' => [
                    $this->slugit('1-Yr Trailer Plate'),
                    $this->slugit('4-Yr Trailer Plate'),
                    $this->slugit('Permanent Trailer Plate'),
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Travel Trailer'),
                'plate_types' => [
                    $this->slugit('1-Yr Trailer Plate'),
                    $this->slugit('4-Yr Trailer Plate'),
                    $this->slugit('Permanent Trailer Plate'),

                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Utility Trailer'),
                'plate_types' => [
                    $this->slugit('Trailer Plate')
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Boat Trailer'),
                'plate_types' => [
                    $this->slugit('Boat Trailer Plate')
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Antique Vehicle'),
                'plate_types' => [
                    $this->slugit('Antique Plate')
                ]
            ]
        ];
    }
}
