<?php

namespace Thirty98\API\Stdlib\Seeders;

use Illuminate\Support\Facades\DB;

abstract class AbstractStateVehicleFeeSeeder extends AbstractDatabaseSeeder
{
    protected function executeSeeder()
    {
        $state = DB::table('states')->where('code', $this->state_code)
            ->first();

        foreach ($this->getStateFees() AS $fee) {

            $title_fee = DB::table('fees')->where('slug', $fee)->first();

            $exists = DB::table($this->table_name)->where('fee_id', $title_fee->id)
                ->where('state_code', $state->code)
                ->first();

            if (!$exists) {
                DB::table($this->table_name)->insert([
                    'fee_id' => $title_fee->id,
                    'state_code' => $state->code,
                    'priority' => 1
                ]);
            }

            continue;
        }
    }

    abstract protected function getStateFees();
}
