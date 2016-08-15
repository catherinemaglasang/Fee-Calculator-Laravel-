<?php

namespace Thirty98\Seeder;

use Thirty98\API\Stdlib\Seeders\AbstractDatabaseSeeder;
use Illuminate\Support\Facades\DB;

class TransactionTypeSeeder extends AbstractDatabaseSeeder
{
    CONST TABLE = "transaction_types";
    
    public function executeSeeder()
    {
        foreach ($this->getTransactionTypes() AS $types) {
            
            $slug = $this->slugit($types['name']);
            $types['slug'] = $slug;
            
            $exists =  DB::table(self::TABLE)->where('code', $types['code'])
                ->where('slug', $slug)
                ->first();
              
            if (!$exists) {
                DB::table(self::TABLE)->insert($types);
            }
            
            continue;
        }
    }
    
    protected function getTransactionTypes()
    {
        return [
            ['code' => 'NR', 'name' => 'New Title/New Registration'],
            ['code' => 'TP', 'name' => 'New Title/Transfer Plate'],
            ['code' => 'DT', 'name' => 'Duplicate Title'],
            ['code' => 'TO', 'name' => 'Title Only'],
            ['code' => 'RO', 'name' => 'Registration Only'],
            ['code' => 'TRC', 'name' => 'Title Registration Correction'],
            ['code' => 'RR', 'name' => 'Registration Renewal'],
        ];
    }
}