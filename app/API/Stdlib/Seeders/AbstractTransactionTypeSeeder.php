<?php

namespace Thirty98\API\Stdlib\Seeders;

use Thirty98\API\Stdlib\Seeders\AbstractDatabaseSeeder;
use Illuminate\Support\Facades\DB;

abstract class AbstractTransactionTypeSeeder extends AbstractDatabaseSeeder
{
    CONST TABLE = 'states_transaction_types';
    
    protected $state;

    protected function executeSeeder()
    {
        foreach ($this->getTransactionTypes() AS $types) {
            
            $types['state_code'] = $this->state;
            $exists =  DB::table(self::TABLE)->where('state_code', $this->state)
                ->where('transaction_type_code', $types['transaction_type_code'])
                ->first();
                        
            if (!$exists) {
                DB::table(self::TABLE)->insert($types);
            }
            
            continue;
        }
    }
    
    abstract protected function getTransactionTypes();
}