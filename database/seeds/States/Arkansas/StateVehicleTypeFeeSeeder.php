<?php

namespace Thirty98\Seeder\States\Arkansas;

use Carbon\Carbon;
use Thirty98\API\Stdlib\Seeders\AbstractStateVehicleTypeFeeSeeder;

class StateVehicleTypeFeeSeeder extends AbstractStateVehicleTypeFeeSeeder
{
    public $state_code = 'AR';
    protected $table_name = 'state_vehicle_type_fees';

    protected function getStateVehicleTypeFees()
    {
        return [
            [
                'vehicle_slug' => $this->slugit('Passenger'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Transfer Plate Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Lien Fee'),
                        'amount' => 0.05,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Decal Fee'),
                        'amount' => 2.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Postage Fee'),
                        'amount' => 0.39,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 1.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ]
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Motor Home'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Transfer Plate Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Lien Fee'),
                        'amount' => 0.05,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Decal Fee'),
                        'amount' => 2.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Postage Fee'),
                        'amount' => 0.39,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 1.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ]
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('1/2 Pickup Van'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Transfer Plate Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Lien Fee'),
                        'amount' => 0.05,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee'),
                        'amount' => 21.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Decal Fee'),
                        'amount' => 2.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Postage Fee'),
                        'amount' => 0.39,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 1.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ]
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('3/4 Pickup Van'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Transfer Plate Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Lien Fee'),
                        'amount' => 0.05,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee'),
                        'amount' => 21.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Decal Fee'),
                        'amount' => 2.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Postage Fee'),
                        'amount' => 0.39,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 1.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ]
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('1 Ton Pickup Van'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Transfer Plate Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Lien Fee'),
                        'amount' => 0.05,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee'),
                        'amount' => 21.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Decal Fee'),
                        'amount' => 2.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Postage Fee'),
                        'amount' => 0.39,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 1.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ]
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('1/2 Pickup Truck'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Transfer Plate Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Lien Fee'),
                        'amount' => 0.05,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee'),
                        'amount' => 21.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Decal Fee'),
                        'amount' => 2.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Postage Fee'),
                        'amount' => 0.39,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 1.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ]
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('3/4 Pickup Truck'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Transfer Plate Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Lien Fee'),
                        'amount' => 0.05,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee'),
                        'amount' => 21.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Decal Fee'),
                        'amount' => 2.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Postage Fee'),
                        'amount' => 0.39,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 1.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ]
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('1 Ton Pickup Truck'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Transfer Plate Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Lien Fee'),
                        'amount' => 0.05,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee'),
                        'amount' => 21.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Decal Fee'),
                        'amount' => 2.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Postage Fee'),
                        'amount' => 0.39,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 1.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ]
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Commercial Truck'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Transfer Plate Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Lien Fee'),
                        'amount' => 0.05,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Decal Fee'),
                        'amount' => 2.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Postage Fee'),
                        'amount' => 0.39,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 1.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ]
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Truck Tractor'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Transfer Plate Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Lien Fee'),
                        'amount' => 0.05,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Decal Fee'),
                        'amount' => 2.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Postage Fee'),
                        'amount' => 0.39,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 1.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ]
                ]
            ],

            /**
             *  City Bus
             * Private Bus
             * Motor Bus
             */
            [
                'vehicle_slug' => $this->slugit('City Bus'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Transfer Plate Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Lien Fee'),
                        'amount' => 0.05,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Decal Fee'),
                        'amount' => 2.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Postage Fee'),
                        'amount' => 0.39,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 1.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ]
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Private Bus'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Transfer Plate Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Lien Fee'),
                        'amount' => 0.05,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Decal Fee'),
                        'amount' => 2.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Postage Fee'),
                        'amount' => 0.39,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 1.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ]
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Motor Bus'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Transfer Plate Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Lien Fee'),
                        'amount' => 0.05,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Decal Fee'),
                        'amount' => 2.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Postage Fee'),
                        'amount' => 0.39,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 1.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ]
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Moped'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Transfer Plate Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Lien Fee'),
                        'amount' => 0.05,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Decal Fee'),
                        'amount' => 2.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Postage Fee'),
                        'amount' => 0.39,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 1.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ]
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Motorcycle'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Transfer Plate Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Lien Fee'),
                        'amount' => 0.05,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Decal Fee'),
                        'amount' => 2.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Postage Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 1.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ]
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Motorcycle Side Car'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Transfer Plate Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Lien Fee'),
                        'amount' => 0.05,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee'),
                        'amount' => 2.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Decal Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Postage Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 1.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ]
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Off-Road Motorcycle'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Transfer Plate Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Lien Fee'),
                        'amount' => 0.05,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee'),
                        'amount' => 2.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Decal Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Postage Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 1.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ]
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('ATV Type Vehicle'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Transfer Plate Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Lien Fee'),
                        'amount' => 0.05,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee'),
                        'amount' => 5.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Decal Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Postage Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 1.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ]
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Motorized Bike Standard'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Transfer Plate Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Lien Fee'),
                        'amount' => 0.05,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee'),
                        'amount' => 3.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Decal Fee'),
                        'amount' => 2.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Postage Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 1.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ]
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Motorized Bike Automatic'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Transfer Plate Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Lien Fee'),
                        'amount' => 0.05,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Decal Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Postage Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 1.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ]
                ]
            ],

            [
                'vehicle_slug' => $this->slugit('Semi Trailer'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Transfer Plate Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],

                    [
                        'fee_slug' => $this->slugit('Transfer Plate Trailer Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],

                    [
                        'fee_slug' => $this->slugit('Lien Fee'),
                        'amount' => 0.05,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Decal Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Postage Fee'),
                        'amount' => 0.39,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 1.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ]
                ]
            ],

            [
                'vehicle_slug' => $this->slugit('Trailer'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Transfer Plate Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],

                    [
                        'fee_slug' => $this->slugit('Transfer Plate Trailer Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],

                    [
                        'fee_slug' => $this->slugit('Lien Fee'),
                        'amount' => 0.05,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Decal Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Postage Fee'),
                        'amount' => 0.39,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 1.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ]
                ]
            ],

            [
                'vehicle_slug' => $this->slugit('Utility Trailer'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Transfer Plate Fee'),
                        'amount' => 1.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],

                    [
                        'fee_slug' => $this->slugit('Transfer Plate Trailer Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],

                    [
                        'fee_slug' => $this->slugit('Lien Fee'),
                        'amount' => 0.05,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Decal Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Postage Fee'),
                        'amount' => 0.39,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 1.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ]
                ]
            ],
        ];
    }
}
