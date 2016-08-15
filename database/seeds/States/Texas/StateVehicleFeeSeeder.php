<?php

namespace Thirty98\Seeder\States\Texas;

use Thirty98\API\Stdlib\Seeders\AbstractStateVehicleFeeSeeder;

class StateVehicleFeeSeeder extends AbstractStateVehicleFeeSeeder
{
    public $state_code = 'TX';
    protected $table_name = 'state_vehicle_fees';

    protected function getStateFees()
    {
        return [
            $this->slugit('Dealer Late Penalty'),
            $this->slugit('Casual Late Penalty'),
            $this->slugit('New Resident Tax'),
            $this->slugit('Gift Tax'),
            $this->slugit('Even Trade Tax'),
            $this->slugit('Duplicate Title Fee'),
            $this->slugit('Reg DPS Fee'),
            $this->slugit('Registration Fee'),
            $this->slugit('Automation Fee'),
            $this->slugit('Temp Tag Fee'),
            $this->slugit('Young Farmer Fee')
        ];
    }
}
