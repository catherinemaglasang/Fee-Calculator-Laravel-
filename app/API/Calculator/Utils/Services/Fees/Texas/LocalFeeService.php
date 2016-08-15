<?php

namespace Thirty98\API\Calculator\Utils\Services\Fees\Texas;

use Thirty98\API\Calculator\Utils\Services\Fees\AbstractLocalFeeService;
use Illuminate\Support\Facades\DB;

class LocalFeeService extends AbstractLocalFeeService
{
    public final function getRate()
    {
        if($this->county == false) {
            return 0;
        }

        $local_fee = DB::table('county_fees')->join("counties", "counties.code", "=", "county_fees.county_code")
            ->join("fees", "fees.id", "=", "county_fees.fee_id")
            ->where("counties.code", $this->county)
            ->where("fees.slug", "local_fee")
            ->select("amount")
            ->first();

        if($local_fee) {
            return (float)$local_fee->amount;
        } else {
            return 0;
        }
    }
}
