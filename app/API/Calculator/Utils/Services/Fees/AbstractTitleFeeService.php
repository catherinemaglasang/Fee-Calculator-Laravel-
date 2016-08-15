<?php

namespace Thirty98\API\Calculator\Utils\Services\Fees;

abstract class AbstractTitleFeeService
{
    protected $state;

    protected $county;
    protected $vehicle_type;
    
    public function __construct($county, $vehicle_type)
    {
        $this->county = $county;
        $this->vehicle_type = $vehicle_type;
    }
}

