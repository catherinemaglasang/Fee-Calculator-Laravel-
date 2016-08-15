<?php

namespace Thirty98\Seeder\States\Louisiana;

use Carbon\Carbon;
use Thirty98\API\Stdlib\Seeders\AbstractStateVehicleTypeFeeSeeder;

class StateVehicleTypeFeeSeeder extends AbstractStateVehicleTypeFeeSeeder
{
    public $state_code = 'LA';
    protected $table_name = 'state_vehicle_type_fees';

    protected function getStateVehicleTypeFees()
    {
        return [
            [
                'vehicle_slug' => $this->slugit('Car'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Electronic Filing Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('1-Yr Commercial Plate'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('2-Yr Commercial Plate'),
                        'amount' => 20.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Convenience Fee'),
                        'amount' => 18.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Handling Fee'),
                        'amount' => 8.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Interest'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee'),
                        'amount' => 0.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 3.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Credit Fee'),
                        'amount' => 0.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Penalty Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Mail Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Miscellaneous Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Notary Fee'),
                        'amount' => 20.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Processing Fee'),
                        'amount' => 37.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax'),
                        'amount' => 0.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax Penalty'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Correction Fee'),
                        'amount' => 68.5,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Tow Fee'),
                        'amount' => 0.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Vendors Comp'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Van'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Electronic Filing Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('1-Yr Commercial Plate'),
                        'amount' => 10.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('2-Yr Commercial Plate'),
                        'amount' => 20.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Convenience Fee'),
                        'amount' => 18.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Handling Fee'),
                        'amount' => 8.00
                        ,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Interest'),
                        'amount' => 0.00
                        ,
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
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 3.00
                        ,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Penalty Credit Fee'),
                        'amount' => 0.00
                        ,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Mail Fee'),
                        'amount' => 10.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Miscellaneous Fee'),
                        'amount' => 0.00
                        ,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Notary Fee'),
                        'amount' => 20.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Processing Fee'),
                        'amount' => 37.00
                        ,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax Penalty'),
                        'amount' => 0.00
                        ,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Correction Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 68.50
                        ,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Tow Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Vendors Comp'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('SUV'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Electronic Filing Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('1-Yr Commercial Plate'),
                        'amount' => 10.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('2-Yr Commercial Plate'),
                        'amount' => 20.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Convenience Fee'),
                        'amount' => 18.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Handling Fee'),
                        'amount' => 8.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Interest'),
                        'amount' => 0.00,
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
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 3.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Penalty Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Mail Fee'),
                        'amount' => 10.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Miscellaneous Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Notary Fee'),
                        'amount' => 20.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Processing Fee'),
                        'amount' => 37.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax Penalty'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Correction Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Tow Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Vendors Comp'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Truck'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Electronic Filing Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Convenience Fee'),
                        'amount' => 18.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Handling Fee'),
                        'amount' => 8.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Interest'),
                        'amount' => 0.00,
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
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 3.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Penalty Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Mail Fee'),
                        'amount' => 10.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Miscellaneous Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Notary Fee'),
                        'amount' => 20.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Processing Fee'),
                        'amount' => 37.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax Penalty'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Correction Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Tow Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Vendors Comp'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Truck Tractor'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Electronic Filing Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Convenience Fee'),
                        'amount' => 18.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Handling Fee'),
                        'amount' => 8.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Interest'),
                        'amount' => 0.00,
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
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 3.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Penalty Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Mail Fee'),
                        'amount' => 10.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Miscellaneous Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Notary Fee'),
                        'amount' => 20.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Processing Fee'),
                        'amount' => 37.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax Penalty'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Correction Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Tow Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Vendors Comp'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Bus'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Electronic Filing Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Private Bus Plate'),
                        'amount' => 50.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Hire Passenger Plate'),
                        'amount' => 6.25,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Convenience Fee'),
                        'amount' => 18.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Handling Fee'),
                        'amount' => 8.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Interest'),
                        'amount' => 0.00,
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
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 3.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Penalty Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Mail Fee'),
                        'amount' => 10.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Miscellaneous Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Notary Fee'),
                        'amount' => 20.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Processing Fee'),
                        'amount' => 37.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax Penalty'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Correction Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Tow Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Vendors Comp'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Motor Home'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Electronic Filing Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Motor Home Plate'),
                        'amount' => 50.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Convenience Fee'),
                        'amount' => 18.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Handling Fee'),
                        'amount' => 8.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Interest'),
                        'amount' => 0.00,
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
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 3.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Penalty Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Mail Fee'),
                        'amount' => 10.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Miscellaneous Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Notary Fee'),
                        'amount' => 20.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Processing Fee'),
                        'amount' => 37.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax Penalty'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Correction Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Tow Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Vendors Comp'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Motorcycle'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Electronic Filing Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Motorcycle Plate'),
                        'amount' => 12.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Convenience Fee'),
                        'amount' => 18.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Handling Fee'),
                        'amount' => 8.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Interest'),
                        'amount' => 0.00,
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
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 3.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Penalty Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Mail Fee'),
                        'amount' => 10.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Miscellaneous Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Notary Fee'),
                        'amount' => 20.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Processing Fee'),
                        'amount' => 37.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax Penalty'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Correction Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Tow Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Vendors Comp'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Off-Road Vehicle'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Electronic Filing Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('No Plate'),
                        'amount' => 12.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Convenience Fee'),
                        'amount' => 18.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Handling Fee'),
                        'amount' => 8.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Interest'),
                        'amount' => 0.00,
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
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 3.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Penalty Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Mail Fee'),
                        'amount' => 10.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Miscellaneous Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Notary Fee'),
                        'amount' => 20.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Processing Fee'),
                        'amount' => 37.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax Penalty'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Correction Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Tow Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Vendors Comp'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Trailer'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Electronic Filing Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('1-Yr Trailer Plate'),
                        'amount' => 10.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('4-Yr Trailer Plate'),
                        'amount' => 40.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Permanent Trailer Plate'),
                        'amount' => 70.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Convenience Fee'),
                        'amount' => 18.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Handling Fee'),
                        'amount' => 8.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Interest'),
                        'amount' => 0.00,
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
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 3.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Penalty Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Mail Fee'),
                        'amount' => 10.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Miscellaneous Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Notary Fee'),
                        'amount' => 20.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Processing Fee'),
                        'amount' => 37.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax Penalty'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Correction Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Tow Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Vendors Comp'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Semi-Trailer'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Electronic Filing Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('1-Yr Trailer Plate'),
                        'amount' => 10.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('4-Yr Trailer Plate'),
                        'amount' => 40.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Permanent Trailer Plate'),
                        'amount' => 70.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Convenience Fee'),
                        'amount' => 18.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Handling Fee'),
                        'amount' => 8.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Interest'),
                        'amount' => 0.00,
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
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 3.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Penalty Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Mail Fee'),
                        'amount' => 10.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Miscellaneous Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Notary Fee'),
                        'amount' => 20.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Processing Fee'),
                        'amount' => 37.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax Penalty'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Correction Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Tow Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Vendors Comp'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Travel Trailer'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Electronic Filing Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('1-Yr Trailer Plate'),
                        'amount' => 10.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('4-Yr Trailer Plate'),
                        'amount' => 40.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Permanent Trailer Plate'),
                        'amount' => 70.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Convenience Fee'),
                        'amount' => 18.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Handling Fee'),
                        'amount' => 8.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Interest'),
                        'amount' => 0.00,
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
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 3.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Penalty Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Mail Fee'),
                        'amount' => 10.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Miscellaneous Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Notary Fee'),
                        'amount' => 20.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Processing Fee'),
                        'amount' => 37.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax Penalty'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Correction Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Tow Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Vendors Comp'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Utility Trailer'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Trailer Plate'),
                        'amount' => 25.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Electronic Filing Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee Plate'),
                        'amount' => 25.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Convenience Fee'),
                        'amount' => 18.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Handling Fee'),
                        'amount' => 8.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Interest'),
                        'amount' => 0.00,
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
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 3.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Penalty Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Mail Fee'),
                        'amount' => 10.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Miscellaneous Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Notary Fee'),
                        'amount' => 20.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Processing Fee'),
                        'amount' => 37.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax Penalty'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Correction Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Tow Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Vendors Comp'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Boat Trailer'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Boat Trailer Plate'),
                        'amount' => 25.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Electronic Filing Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Fee Plate'),
                        'amount' => 25.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Convenience Fee'),
                        'amount' => 18.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Handling Fee'),
                        'amount' => 8.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Interest'),
                        'amount' => 0.00,
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
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 3.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Penalty Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Mail Fee'),
                        'amount' => 10.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Miscellaneous Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Notary Fee'),
                        'amount' => 20.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Processing Fee'),
                        'amount' => 37.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax Penalty'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Correction Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Tow Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Vendors Comp'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ],
            [
                'vehicle_slug' => $this->slugit('Antique Vehicle'),
                'fees' => [
                    [
                        'fee_slug' => $this->slugit('Electronic Filing Fee'),
                        'amount' => 10.0,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Antique Plate'),
                        'amount' => 25.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Convenience Fee'),
                        'amount' => 18.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Duplicate Title Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Handling Fee'),
                        'amount' => 8.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Interest'),
                        'amount' => 0.00,
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
                        'fee_slug' => $this->slugit('License Transfer Fee'),
                        'amount' => 3.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('License Penalty Credit Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Mail Fee'),
                        'amount' => 10.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Miscellaneous Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Notary Fee'),
                        'amount' => 20.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Processing Fee'),
                        'amount' => 37.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Sales Tax Penalty'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Correction Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Title Fee'),
                        'amount' => 68.50,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Tow Fee'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                    [
                        'fee_slug' => $this->slugit('Vendors Comp'),
                        'amount' => 0.00,
                        'start_date' => Carbon::parse('05/01/2014')->format('Y/m/d'),
                        'end_date' => Carbon::parse('01/01/2030')->format('Y/m/d')
                    ],
                ]
            ]
        ];
    }
}
