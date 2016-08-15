<?php

namespace Thirty98\API\General\Entities;

use Thirty98\API\General\Models\County;
use Thirty98\API\General\Models\City;
use Thirty98\API\General\Models\State;
use Illuminate\Support\Facades\DB;

class CountyRepository
{
    /**
     * Get list of counties.
     *
     * @param array $where
     * @return array
     */
    public function counties($where = [])
    {
        $counties = new County;

        foreach ($where as $field => $value) {
            $counties = $counties->where($field, $value);
        }

        return $counties->orderBy('state_code', 'ASC')->orderBy('name', 'asc')->paginate(Helper::pageLimit())->toArray();
    }

    /**
     * Get list of counties by a specific state.
     *
     * @param string $stateCode
     * @return array
     */
    public function getCountiesByState($stateCode = '')
    {
        $counties = DB::table('counties')->where("state_code", $stateCode)->get();
        
        return $counties;

//        $county = new City;
//        
//        return $county->where('State', $stateCode)->orderBy('County', 'ASC')->groupBy('County')->paginate(Helper::pageLimit(), [DB::raw('County as code'), DB::raw('County as name'), 'id'])->toArray();
    }
}

#END OF PHP FILE