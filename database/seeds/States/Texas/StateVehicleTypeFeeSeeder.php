<?php

namespace Thirty98\Seeder\States\Texas;

use Carbon\Carbon;
use Thirty98\API\Stdlib\Seeders\AbstractStateVehicleTypeFeeSeeder;

class StateVehicleTypeFeeSeeder extends AbstractStateVehicleTypeFeeSeeder
{
    public $state_code = 'TX';
    protected $table_name = 'state_vehicle_type_fees';

    protected function getStateVehicleTypeFees()
    {
        return [
            // Passenger.
            [
                'vehicle_slug' => $this->slugit('Passenger'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('New Resident Tax'),
                        'amount' => 90.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Gift Tax'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Even Trade Tax'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Dealer Late Penalty'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Casual Late Penalty'),
                        'amount' => 25.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Reg DPS Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Automation Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Temp Tag Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Young Farmer Fee'),
                        'amount' => 0.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],

            // Van Truck Plates
            [
                'vehicle_slug' => $this->slugit('Van Truck Plates'),
                'fees' => [

                    [
                        'fee_slug' => $this->slugit('New Resident Tax'),
                        'amount' => 90.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Gift Tax'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Even Trade Tax'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Dealer Late Penalty'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Casual Late Penalty'),
                        'amount' => 25.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Reg DPS Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Automation Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Temp Tag Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Young Farmer Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],

            // SUV Truck Plates
            [
                'vehicle_slug' => $this->slugit('SUV Truck Plates'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('New Resident Tax'),
                        'amount' => 90.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Gift Tax'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Even Trade Tax'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Dealer Late Penalty'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Casual Late Penalty'),
                        'amount' => 25.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Reg DPS Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Automation Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Temp Tag Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Young Farmer Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],

            //  1/4 Pickup Truck
            [
                'vehicle_slug' => $this->slugit('1/4 Pickup Truck'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('New Resident Tax'),
                        'amount' => 90.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Gift Tax'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Even Trade Tax'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Dealer Late Penalty'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Casual Late Penalty'),
                        'amount' => 25.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Reg DPS Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Automation Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Temp Tag Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Young Farmer Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],

            //  1/2 Pickup Truck
            [
                'vehicle_slug' => $this->slugit('1/2 Pickup Truck'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('New Resident Tax'),
                        'amount' => 90.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Gift Tax'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Even Trade Tax'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Dealer Late Penalty'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Casual Late Penalty'),
                        'amount' => 25.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Reg DPS Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Automation Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Temp Tag Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Young Farmer Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],

            //  3/4 Pickup Truck
            [
                'vehicle_slug' => $this->slugit('3/4 Pickup Truck'),
                'fees' => [

                    [
                        'fee_slug' => $this->slugit('New Resident Tax'),
                        'amount' => 90.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Gift Tax'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Even Trade Tax'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Dealer Late Penalty'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Casual Late Penalty'),
                        'amount' => 25.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Reg DPS Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Automation Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Temp Tag Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Young Farmer Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],

            //  1 Ton Pickup Truck
            [
                'vehicle_slug' => $this->slugit('1 Ton Pickup Truck'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('New Resident Tax'),
                        'amount' => 90.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Gift Tax'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Even Trade Tax'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Dealer Late Penalty'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Casual Late Penalty'),
                        'amount' => 25.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Reg DPS Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Automation Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Temp Tag Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Young Farmer Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],

            //  Pickup Truck > 1 Ton
            [
                'vehicle_slug' => $this->slugit('Pickup Truck > 1 Ton'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('New Resident Tax'),
                        'amount' => 90.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Gift Tax'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Even Trade Tax'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Dealer Late Penalty'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Casual Late Penalty'),
                        'amount' => 25.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Reg DPS Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Automation Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Temp Tag Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Young Farmer Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ],
            ],
            //  Truck Tractor
            [
                'vehicle_slug' => $this->slugit('Truck Tractor'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('New Resident Tax'),
                        'amount' => 90.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Gift Tax'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Even Trade Tax'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Dealer Late Penalty'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Casual Late Penalty'),
                        'amount' => 25.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Reg DPS Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Automation Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Temp Tag Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Young Farmer Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],

            //  Combination Truck
            [
                'vehicle_slug' => $this->slugit('Combination Truck'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('New Resident Tax'),
                        'amount' => 90.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Gift Tax'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Even Trade Tax'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Dealer Late Penalty'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Casual Late Penalty'),
                        'amount' => 25.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Reg DPS Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Automation Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Temp Tag Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Young Farmer Fee'),
                        'amount' => 0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],

            //  City Bus
            [
                'vehicle_slug' => $this->slugit('City Bus'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('New Resident Tax'),
                        'amount' => 90.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Gift Tax'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Even Trade Tax'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Dealer Late Penalty'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Casual Late Penalty'),
                        'amount' => 25.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Reg DPS Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Automation Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Temp Tag Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Young Farmer Fee'),
                        'amount' => 0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],

            //  Private Bus
            [
                'vehicle_slug' => $this->slugit('Private Bus'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('New Resident Tax'),
                        'amount' => 90.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Gift Tax'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Even Trade Tax'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Dealer Late Penalty'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Casual Late Penalty'),
                        'amount' => 25.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Reg DPS Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Automation Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Temp Tag Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Young Farmer Fee'),
                        'amount' => 0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],

            //  Motor Bus
            [
                'vehicle_slug' => $this->slugit('Motor Bus'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('New Resident Tax'),
                        'amount' => 90.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Gift Tax'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Even Trade Tax'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Dealer Late Penalty'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Casual Late Penalty'),
                        'amount' => 25.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Reg DPS Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Automation Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Temp Tag Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Young Farmer Fee'),
                        'amount' => 0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],

            //  Moped
            [
                'vehicle_slug' => $this->slugit('Moped'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('New Resident Tax'),
                        'amount' => 90.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Gift Tax'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Even Trade Tax'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Dealer Late Penalty'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Casual Late Penalty'),
                        'amount' => 30.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Registration Fee'),
                        'amount' => 30.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Reg DPS Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Automation Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Temp Tag Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Young Farmer Fee'),
                        'amount' => 0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],

            //  Motorcycle
            [
                'vehicle_slug' => $this->slugit('Motorcycle'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Dealer Late Penalty'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Casual Late Penalty'),
                        'amount' => 30.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Registration Fee'),
                        'amount' => 30.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('New Resident Tax'),
                        'amount' => 90.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Gift Tax'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Even Trade Tax'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Reg DPS Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Automation Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Temp Tag Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Young Farmer Fee'),
                        'amount' => 0.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],

            // Off-Reoad Motorcycle
            [
                'vehicle_slug' => $this->slugit('Off-Road Motorcycle'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('New Resident Tax'),
                        'amount' => 90.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Gift Tax'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Even Trade Tax'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Dealer Late Penalty'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Casual Late Penalty'),
                        'amount' => 25.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Reg DPS Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Automation Fee'),
                        'amount' => 0.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Temp Tag Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Young Farmer Fee'),
                        'amount' => 0.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],

            // Mini-Bike
            [
                'vehicle_slug' => $this->slugit('Mini-Bike'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('New Resident Tax'),
                        'amount' => 90.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Gift Tax'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Even Trade Tax'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Dealer Late Penalty'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Casual Late Penalty'),
                        'amount' => 25.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Reg DPS Fee'),
                        'amount' => 0.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Automation Fee'),
                        'amount' => 0.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Temp Tag Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Young Farmer Fee'),
                        'amount' => 0.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],

            //  ATV Type Vehicle
            [
                'vehicle_slug' => $this->slugit('ATV Type Vehicle'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('New Resident Tax'),
                        'amount' => 90.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Gift Tax'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Even Trade Tax'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Dealer Late Penalty'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Casual Late Penalty'),
                        'amount' => 25.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Reg DPS Fee'),
                        'amount' => 0.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Automation Fee'),
                        'amount' => 0.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Temp Tag Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Young Farmer Fee'),
                        'amount' => 0.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],

            //  Motor Home
            [
                'vehicle_slug' => $this->slugit('Motor Home'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('New Resident Tax'),
                        'amount' => 90.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Gift Tax'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Even Trade Tax'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Dealer Late Penalty'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Casual Late Penalty'),
                        'amount' => 25.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Reg DPS Fee'),
                        'amount' => 0.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Automation Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Temp Tag Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Young Farmer Fee'),
                        'amount' => 0.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],

            //  Travel Trailer
            [
                'vehicle_slug' => $this->slugit('Travel Trailer'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('New Resident Tax'),
                        'amount' => 90.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Gift Tax'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Even Trade Tax'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Dealer Late Penalty'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Casual Late Penalty'),
                        'amount' => 25.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Reg DPS Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Automation Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Temp Tag Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Young Farmer Fee'),
                        'amount' => 0.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],

            //  Token Trailer
            [
                'vehicle_slug' => $this->slugit('Token Trailer'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Registration Fee'),
                        'amount' => 15.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('New Resident Tax'),
                        'amount' => 90.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Gift Tax'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Even Trade Tax'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Dealer Late Penalty'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Casual Late Penalty'),
                        'amount' => 25.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Reg DPS Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Automation Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Temp Tag Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Young Farmer Fee'),
                        'amount' => 0.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],

            //  Trailer
            [
                'vehicle_slug' => $this->slugit('Trailer'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('New Resident Tax'),
                        'amount' => 90.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Gift Tax'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Even Trade Tax'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Dealer Late Penalty'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Casual Late Penalty'),
                        'amount' => 25.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Reg DPS Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Automation Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Temp Tag Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Young Farmer Fee'),
                        'amount' => 0.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],

            //  Utility Trailer
            [
                'vehicle_slug' => $this->slugit('Utility Trailer'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Registration Fee'),
                        'amount' => 45.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('New Resident Tax'),
                        'amount' => 90.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Gift Tax'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Even Trade Tax'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Dealer Late Penalty'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Casual Late Penalty'),
                        'amount' => 25.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Reg DPS Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Automation Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Temp Tag Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Young Farmer Fee'),
                        'amount' => 0.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],

            //  Collector Vehicle
            [
                'vehicle_slug' => $this->slugit('Collector Vehicle'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('New Resident Tax'),
                        'amount' => 90.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Gift Tax'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Even Trade Tax'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 2.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Dealer Late Penalty'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Casual Late Penalty'),
                        'amount' => 25.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Reg DPS Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Automation Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Temp Tag Fee'),
                        'amount' => 5.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Young Farmer Fee'),
                        'amount' => 0.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ]
        ];
    }
}
