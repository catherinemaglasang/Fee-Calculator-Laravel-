<?php

namespace Thirty98\API\Texas\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Thirty98\API\General\Entities\APISeeder;

class WeightFeesRegFee extends APISeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::transaction(function () {

                // Get State.
                $state = DB::table('states')->where('code', 'TX')->first();
                if (!$state) {
                    DB::table('states')->insert(['code' => 'TX', 'name' => 'Texas']);
                    $state = DB::table('states')->where('code', 'TX')->first();
                }

                // Get Fee.
                $fee = DB::table('fees')->where('name', 'REG_FEE')->first();
                if(!$fee) {
                    $now = Carbon::now()->toDateString();
                    DB::table('fees')->insert(['name' => 'REG_FEE', 'type' => 'fee', 'created_at' => $now, 'updated_at' => $now]);
                    $fee = DB::Table('fees')->where('name', 'REG_FEE')->first();
                }
                
                
                $data = [
                    ['state_id' => $state->id, 'fee_id' => $fee->id, 'weight_class' => '1', 'min_weight' => '0', 'max_weight' => '6000', 'amount' => floatval(50.75), 'start_date' => '2014-05-01', 'end_date' => '2099-12-31'],
                    ['state_id' => $state->id, 'fee_id' => $fee->id, 'weight_class' => '2', 'min_weight' => '6001', 'max_weight' => '10000', 'amount' => floatval(54), 'start_date' => '2014-05-01', 'end_date' => '2099-12-31'],
                    ['state_id' => $state->id, 'fee_id' => $fee->id, 'weight_class' => '3', 'min_weight' => '10001', 'max_weight' => '18000', 'amount' => floatval(110), 'start_date' => '2014-05-01', 'end_date' => '2099-12-31'],
                    ['state_id' => $state->id, 'fee_id' => $fee->id, 'weight_class' => '4', 'min_weight' => '18001', 'max_weight' => '25999', 'amount' => floatval(205), 'start_date' => '2014-05-01', 'end_date' => '2099-12-31'],
                    ['state_id' => $state->id, 'fee_id' => $fee->id, 'weight_class' => '5', 'min_weight' => '26000', 'max_weight' => '40000', 'amount' => floatval(340), 'start_date' => '2014-05-01', 'end_date' => '2099-12-31'],
                    ['state_id' => $state->id, 'fee_id' => $fee->id, 'weight_class' => '6', 'min_weight' => '40001', 'max_weight' => '54999', 'amount' => floatval(535), 'start_date' => '2014-05-01', 'end_date' => '2099-12-31'],
                    ['state_id' => $state->id, 'fee_id' => $fee->id, 'weight_class' => '7', 'min_weight' => '55000', 'max_weight' => '70000', 'amount' => floatval(740), 'start_date' => '2014-05-01', 'end_date' => '2099-12-31'],
                    ['state_id' => $state->id, 'fee_id' => $fee->id, 'weight_class' => '8', 'min_weight' => '70001', 'max_weight' => '80000', 'amount' => floatval(840), 'start_date' => '2014-05-01', 'end_date' => '2099-12-31'],
                ];

                DB::table('tx_weightfees')->insert($data);
            });
        } catch (Exception $e) {
            Log::error($e);
            $this->command->error($e->getMessage());
        }
    }
}
