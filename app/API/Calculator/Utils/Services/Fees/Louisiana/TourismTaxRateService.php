<?php

namespace Thirty98\API\Calculator\Utils\Services\Fees\Louisiana;

class TourismTaxRateService
{
    protected $state = 'LA';

    public function getRate()
    {
        return 0.000300;
    }
}