<?php

namespace Thirty98\API\Calculator\Utils\Services\Fees\Texas;

use Thirty98\API\Calculator\Utils\Services\Fees\AbstractTitleFeeService;
use Illuminate\Support\Facades\DB;

class TitleFeeService extends AbstractTitleFeeService
{
    public function getRate()
    {
        if($this->county == false) {
            return 0;
        }

        $title_fee = DB::table('county_fees')->join("counties", "counties.code", "=", "county_fees.county_code")
            ->join("fees", "fees.id", "=", "county_fees.fee_id")
            ->where("counties.code", $this->county)
            ->where("fees.slug", "title_fee")
            ->select("amount")
            ->first();

        if($title_fee) {
            return (float)$title_fee->amount;
        } else {
            return 0;
        }

    }
}

