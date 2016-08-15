<?php

namespace Thirty98\Seeder\States\Louisiana;

use Thirty98\API\Stdlib\Seeders\AbstractStateVehicleFeeSeeder;

class StateVehicleFeeSeeder extends AbstractStateVehicleFeeSeeder
{
    public $state_code = 'LA';
    protected $table_name = 'state_vehicle_fees';

    protected function getStateFees()
    {
        return [
            $this->slugit('Antique Plate'),
            $this->slugit('Private Bus Plate'),
            $this->slugit('Hire Passenger Plate'),
            $this->slugit('Boat Trailer Plate'),
            $this->slugit('1-Yr Commercial Plate'),
            $this->slugit('2-Yr Commercial Plate'),
            $this->slugit('Trailer Plate'),
            $this->slugit('1-Yr Trailer Plate'),
            $this->slugit('4-Yr Trailer Plate'),
            $this->slugit('Permanent Trailer Plate'),
            $this->slugit('Private Bus Plate'),
            $this->slugit('Motorcycle Plate'),
            $this->slugit('Motor Home Plate'),
            $this->slugit('No Plate'),
            $this->slugit('Convenience Fee'),
            $this->slugit('Duplicate Title Fee'),
            $this->slugit('Handling Fee'),
            $this->slugit('Interest'),
            $this->slugit('License Fee'),
            $this->slugit('License Fee Plate'),
            $this->slugit('License Credit Fee'),
            $this->slugit('License Penalty Credit Fee'),
            $this->slugit('License Transfer Fee'),
            $this->slugit('Mail Fee'),
            $this->slugit('Miscellaneous Fee'),
            $this->slugit('Mortgage Fee'),
            $this->slugit('Notary Fee'),
            $this->slugit('Sales Tax'),
            $this->slugit('Sales Tax Penalty'),
            $this->slugit('Processing Fee'),
            $this->slugit('Title Correction Fee'),
            $this->slugit('Title Fee'),
            $this->slugit('Tow Fee'),
            $this->slugit('Vendors Comp'),
            $this->slugit('Electronic Filing Fee')
        ];
    }
}
