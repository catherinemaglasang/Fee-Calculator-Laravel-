<?php

namespace Thirty98\Seeder\States\Louisiana;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Illuminate\Support\Facades\DB;

class TransactionTypeSeeder extends AbstractDatabaseSeeder
{
    public $state_code = 'LA';
    protected $table_name = 'states_transaction_types';
    
    protected function executeSeeder()
    {
        $state = DB::table('states')->where('code', $this->state_code)->first();

        foreach ($this->getTransactionTypes() AS $transaction_type) {
            $priority = $transaction_type['priority'];
            $transaction_type = $transaction_type['code'];

            $exists = DB::table($this->table_name)->where('transaction_type_code', $transaction_type)
                ->where('state_code', $state->code)
                ->first();

            if (!$exists) {
                DB::table($this->table_name)->insert([
                    'transaction_type_code' => $transaction_type,
                    'state_code' => $state->code,
                    'priority' => $priority
                ]);
            }

            continue;
        }
    }

    protected function getTransactionTypes()
    {
        return [
            ['code' => 'NR',  'priority' => 1],
            ['code' => 'TP',  'priority' => 2],
            ['code' => 'DT',  'priority' => 3],
            ['code' => 'TRC', 'priority' => 4]
        ];
    }
}
