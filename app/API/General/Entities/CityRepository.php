<?php

namespace Thirty98\API\General\Entities;

use Thirty98\API\General\Models\CityList;
use Thirty98\API\General\Models\State;
use Illuminate\Support\Facades\DB;

class CityRepository
{
    /**
     * Get list of cities.
     *
     * @param array $where
     * @return array
     */
    public function cities($where = [])
    {
        $cities = DB::table('cities')
                ->join('counties', 'cities.county_id', "=", "counties.code")
                ->join('states', "counties.state_code", "=","states.code")
                ->select("cities.name as city_name", "cities.code as code", "counties.name as county_name", "counties.code as county_code", "states.name as state_name", "states.code as state_code")
                ->get();
        
        return $cities;
    }
}

// EOF