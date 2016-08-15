<?php

namespace Thirty98\API\Calculator\Utils\Services\Fees\Louisiana;

class LicenseFeeService
{
    protected $state = 'LA';

    public function getRate()
    {
        return 0.001;
    }
}