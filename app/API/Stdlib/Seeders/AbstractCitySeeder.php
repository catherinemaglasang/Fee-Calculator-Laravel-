<?php

namespace Thirty98\API\Stdlib\Seeders;

use Thirty98\API\Stdlib\Seeders\AbstractDatabaseSeeder;
use Illuminate\Support\Facades\DB;

abstract class AbstractCitySeeder extends AbstractDatabaseSeeder
{
    CONST TABLE = 'cities';
    
    protected function executeSeeder()
    {
        foreach ($this->getCities() AS $city) {
            
            $county = DB::table('counties')->where('state_code', $this->state)
                    ->where('slug', $this->slugit($city['county']))->first();
            
            if ($county) {
                
                $city['county_id'] = $county->id;
                $city['slug'] = $this->slugit($city['name']);
                $city['name'] = ucwords(strtolower($city['name']));
                unset($city['county']);

                $exists =  DB::table(self::TABLE)->where('county_id', $city['county_id'])
                    ->where('slug', $city['slug'])
                    ->first();

                if (!$exists) {
                    DB::table(self::TABLE)->insert($city);
                }
            }
            
            continue;
        }
    }
    
    abstract protected function getCities();
}
