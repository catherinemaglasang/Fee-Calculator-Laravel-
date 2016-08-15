<?php

namespace Thirty98\API\Calculator\Utils\Services\Fees;

abstract class AbstractLocationRateService
{
    protected $county;
    protected $city;

    public function __construct($county, $city)
    {
        $this->county = $county;
        $this->city = $city;
    }
}

