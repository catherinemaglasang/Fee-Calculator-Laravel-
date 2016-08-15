<?php

namespace Thirty98\Seeder\States\Arkansas;

use Thirty98\API\Stdlib\Seeders\AbstractStateVehicleFeeSeeder;

class StateVehicleFeeSeeder extends AbstractStateVehicleFeeSeeder
{
    public $state_code = 'AR';
    protected $table_name = 'state_vehicle_fees';

    protected function getStateFees()
    {
        return [
            $this->slugit('Title Fee'),
            $this->slugit('Lien Fee'),
            $this->slugit('Decal Fee'),
            $this->slugit('Postage Fee'),
            $this->slugit('Title Fee'),
            $this->slugit('License Fee'),
            $this->slugit('License Transfer Fee'),
            $this->slugit('Transfer Plate Fee'),
            $this->slugit('Transfer Plate Trailer Fee')
        ];
    }
}
