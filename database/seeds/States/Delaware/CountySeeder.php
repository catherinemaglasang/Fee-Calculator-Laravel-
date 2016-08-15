<?php

namespace Thirty98\Seeder\States\Delaware;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CountySeeder extends AbstractDatabaseSeeder
{
    public $state_code = 'DE';
    protected $table_name = 'counties';
    
    protected function executeSeeder()
    {
        $state = DB::table('states')->where('code', $this->state_code)->first();
        
        foreach ($this->getCounties() AS $county) {
                
            $exists = DB::table($this->table_name)->where('code', $county['code'])
                ->where('state_id', $state->id)
                ->first();

            if (!$exists) {
                DB::table($this->table_name)->insert(array_merge(['state_id' => $state->id], $county));
            }
            
            continue;
        }
    }
    
    private function getCounties()
    {
        return [
            ['code' => '101', 'name' => 'Sample']            
        ];
    }
}
