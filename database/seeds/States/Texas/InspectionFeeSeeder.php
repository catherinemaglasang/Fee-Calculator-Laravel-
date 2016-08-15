<?php

namespace Thirty98\Seeder\States\Texas;

use Carbon\Carbon;
use Thirty98\API\Stdlib\Seeders\AbstractDatabaseSeeder;
use Thirty98\Models\TXInspectionFee;

class InspectionFeeSeeder extends AbstractDatabaseSeeder
{
    /**
     * @return void
     */
    protected function executeSeeder()
    {
        foreach ($this->getInspectionFees() AS $inspection_fee) {
            $exists = TXInspectionFee::where([
                'code' => $inspection_fee['code'],
                'priority' => $inspection_fee['priority']
            ])->first();

            if (!$exists) {
                TXInspectionFee::insert($inspection_fee);
            }

            continue;
        }
    }

    private function getInspectionFees()
    {
        return [
            [
                'code' => '1YR',
                'name' => 'One Year Safety Inspection Only',
                'state_inspection_fee' => 7.50,
                'dealer_inspection_fee' => 7.00,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d'),
                'priority' => 1
            ],
            [
                'code' => '2YR',
                'name' => 'Two Year Safety Inspection Only',
                'state_inspection_fee' => 16.75,
                'dealer_inspection_fee' => 7.00,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d'),
                'priority' => 2
            ],
            [
                'code' => 'CW',
                'name' => 'Commercial/Windshield Inspection',
                'state_inspection_fee' => 22.00,
                'dealer_inspection_fee' => 40.00,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d'),
                'priority' => 3
            ],
            [
                'code' => 'CDEC',
                'name' => 'Commercial/Decal Inspection',
                'state_inspection_fee' => 22.00,
                'dealer_inspection_fee' => 40.00,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d'),
                'priority' => 4
            ],
            [
                'code' => 'TLMC',
                'name' => 'Trailer/Motorcycle Inspection',
                'state_inspection_fee' => 7.50 ,
                'dealer_inspection_fee' => 7.00,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d'),
                'priority' => 5
            ],
            [
                'code' => 'TSI',
                'name' => 'TSI Safety Emission Inspection',
                'state_inspection_fee' => 8.25,
                'dealer_inspection_fee' => 18.50,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d'),
                'priority' => 6
            ],
            [
                'code' => 'ASM',
                'name' => 'ASM Safety Emission Inspection',
                'state_inspection_fee' => 8.25,
                'dealer_inspection_fee' => 31.50,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d'),
                'priority' => 7
            ],
            [
                'code' => 'OBD',
                'name' => 'OBD Safety Emission Inspection',
                'state_inspection_fee' => 8.25,
                'dealer_inspection_fee' => 31.50,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d'),
                'priority' => 8
            ],
            [
                'code' => 'EMONLY',
                'name' => 'Emission Inspection Only',
                'state_inspection_fee' => 2.75,
                'dealer_inspection_fee' => 11.50,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d'),
                'priority' => 9
            ],
            [
                'code' => 'EMONLY-ASM',
                'name' => 'Emission Inspection Only',
                'state_inspection_fee' => 2.75,
                'dealer_inspection_fee' => 24.50,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d'),
                'priority' => 10
            ],
            [
                'code' => 'EMONLY-OBD',
                'name' => 'Emission Inspection Only',
                'state_inspection_fee' => 8.75,
                'dealer_inspection_fee' => 18.50,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d'),
                'priority' => 11
            ],
            [
                'code' => 'TISOBD',
                'name' => 'TSI/OBD Safety Emission',
                'state_inspection_fee' => 10.25,
                'dealer_inspection_fee' => 18.50,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d'),
                'priority' => 12
            ],
            [
                'code' => 'OBDNL',
                'name' => 'OBD Safety Emission - No LIRAP',
                'state_inspection_fee' => 10.25,
                'dealer_inspection_fee' => 18.50,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d'),
                'priority' => 13
            ],
            [
                'code' => 'NLTSI',
                'name' => 'Travis/Williamson Emission - No LIRAP',
                'state_inspection_fee' => 4.75,
                'dealer_inspection_fee' => 11.50,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d'),
                'priority' => 14
            ],
            [
                'code' => 'SOEO',
                'name' => 'One Year Safety + Emissions Only',
                'state_inspection_fee' => 12.25,
                'dealer_inspection_fee' => 18.50,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d'),
                'priority' => 16
            ],
            [
                'code' => 'CWEO',
                'name' => 'Commercial/Windshield + Emission',
                'state_inspection_fee' => 26.75,
                'dealer_inspection_fee' => 51.50,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d'),
                'priority' => 17
            ]

        ];
    }
}
