<?php

namespace Thirty98\API\Stdlib\Seeders;

use Thirty98\API\Stdlib\Seeders\AbstractDatabaseSeeder;
use Illuminate\Support\Facades\DB;

abstract class AbstractCountyFeeSeeder extends AbstractDatabaseSeeder
{
    CONST TABLE = 'county_fees';
    
    protected function executeSeeder()
    {
        foreach ($this->getCountyFees() as $county_fee) {
            
            $fee = DB::table(self::TABLE)->where("county_code", $county_fee['county_code'])
                ->where("fee_id", $county_fee['fee_id'])
                ->where("amount", $county_fee['amount'])
                ->where("start_date", $county_fee['start_date'])
                ->where("end_date", $county_fee['end_date'])
//                ->where("effective_date", $county_fee["effective_date"])
                ->first();
            
            if (!$fee) {
                DB::table(self::TABLE)->insert($county_fee);
            }
            
            continue;
        }
    }
    
    abstract protected function getCountyFees();
}
