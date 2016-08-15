<?php

namespace Thirty98\Seeder\States\Louisiana;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Illuminate\Support\Facades\DB;

class FeeSeeder extends AbstractDatabaseSeeder
{
    public $state_code = 'LA';
    protected $table_name = 'fees';
    
    protected function executeSeeder()
    {
        $state = DB::table('states')->where('code', $this->state_code)->first();

        foreach ($this->getFees() AS $fee) {
            $exists = DB::table($this->table_name)->where('slug', $fee['slug'])
                ->first();

            if (!$exists) {
                DB::table($this->table_name)->insert($fee);
            }

            continue;
        }
    }

    protected function getFees()
    {
        return [
            // Fees
            [
                'name' => 'Hire Passenger Plate',
                'slug' => $this->slugit('Hire Passenger Plate'),
                'type' => 'fee'
            ],
            [
                'name' => 'Private Bus Plate',
                'slug' => $this->slugit('Private Bus Plate'),
                'type' => 'fee'
            ],
            [
                'name' => 'Antique Plate',
                'slug' => $this->slugit('Antique Plate'),
                'type' => 'fee'
            ],
            [
                'name' => 'Trailer Plate',
                'slug' => $this->slugit('Trailer Plate'),
                'type' => 'fee'
            ],
            [
                'name' => 'Boat Trailer Plate',
                'slug' => $this->slugit('Boat Trailer Plate'),
                'type' => 'fee'
            ],
            [
                'name' => 'Electronic Filing Fee',
                'slug' => $this->slugit('Electronic Filing Fee'),
                'type' => 'fee'
            ],
            [
                'name' => 'Title Fee',
                'slug' => $this->slugit('Title Fee'),
                'type' => 'fee'
            ],
            [
                'name' => 'Duplicate Title Fee',
                'slug' => $this->slugit('Duplicate Title Fee'),
                'type' => 'fee'
            ],
            [
                'name' => 'Title Correction Fee',
                'slug' => $this->slugit('Title Correction Fee'),
                'type' => 'fee'
            ],
            [
                'name' => 'Mortgage Fee',
                'slug' => $this->slugit('Mortgage Fee'),
                'type' => 'fee'
            ],
            [
                'name' => 'License Fee',
                'slug' => $this->slugit('License Fee'),
                'type' => 'fee'
            ],
            [
                'name' => 'License Fee Plate',
                'slug' => $this->slugit('License Fee Plate'),
                'type' => 'fee'
            ],
            [
                'name' => 'License Transfer Fee',
                'slug' => $this->slugit('License Transfer Fee'),
                'type' => 'fee'
            ],
            [
                'name' => 'License Credit Fee',
                'slug' => $this->slugit('License Credit Fee'),
                'type' => 'fee'
            ],
            [
                'name' => 'License Penalty Credit Fee',
                'slug' => $this->slugit('License Penalty Credit Fee'),
                'type' => 'fee'
            ],
            [
                'name' => 'Handling Fee',
                'slug' => $this->slugit('Handling Fee'),
                'type' => 'fee'
            ],
            [
                'name' => 'Tow Fee',
                'slug' => $this->slugit('Tow Fee'),
                'type' => 'fee'
            ],
            [
                'name' => 'Notary Fee',
                'slug' => $this->slugit('Notary Fee'),
                'type' => 'fee'
            ],
            [
                'name' => 'Miscellaneous Fee',
                'slug' => $this->slugit('Miscellaneous Fee'),
                'type' => 'fee'
            ],
            [
                'name' => 'Convenience Fee',
                'slug' => $this->slugit('Convenience Fee'),
                'type' => 'fee'
            ],
            [
                'name' => 'Processing Fee',
                'slug' => $this->slugit('Processing Fee'),
                'type' => 'fee'
            ],
            [
                'name' => 'Mail Fee',
                'slug' => $this->slugit('Mail Fee'),
                'type' => 'fee'
            ],
            [
                'name' => 'Vendors Comp',
                'slug' => $this->slugit('Vendors Comp'),
                'type' => 'fee'
            ],
            [
                'name' => 'Motorcycle Plate',
                'slug' => $this->slugit('Motorcycle Plate'),
                'type' => 'fee'
            ],
            [
                'name' => 'Motor Home Plate',
                'slug' => $this->slugit('Motor Home Plate'),
                'type' => 'fee'
            ],
            [
                'name' => 'No Plate',
                'slug' => $this->slugit('No Plate'),
                'type' => 'fee'
            ],
            [
                'name' => '1-Yr Commercial Plate',
                'slug' => $this->slugit('1-Yr Commercial Plate'),
                'type' => 'fee'
            ],
            [
                'name' => '2-Yr Commercial Plate',
                'slug' => $this->slugit('2-Yr Commercial Plate'),
                'type' => 'fee'
            ],
            [
                'name' => '1-Yr Trailer Plate',
                'slug' => $this->slugit('1-Yr Trailer Plate'),
                'type' => 'fee'
            ],
            [
                'name' => '4-Yr Trailer Plate',
                'slug' => $this->slugit('4-Yr Trailer Plate'),
                'type' => 'fee'
            ],
            [
                'name' => 'Permanent Trailer Plate',
                'slug' => $this->slugit('Permanent Trailer Plate'),
                'type' => 'fee'
            ],
            [
                'name' => 'Private Bus Plate',
                'slug' => $this->slugit('Private Bus Plate'),
                'type' => 'fee'
            ],
            // Tax
            [
                'name' => 'Sales Tax',
                'slug' => $this->slugit('Sales Tax'),
                'type' => 'tax'
            ],
            [
                'name' => 'Sales Tax Penalty',
                'slug' => $this->slugit('Sales Tax Penalty'),
                'type' => 'tax'
            ],
            [
                'name' => 'Interest',
                'slug' => $this->slugit('Interest'),
                'type' => 'tax'
            ],
        ];
    }
}
