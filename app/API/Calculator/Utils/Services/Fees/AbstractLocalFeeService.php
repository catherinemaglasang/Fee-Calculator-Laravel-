<?php

namespace Thirty98\API\Calculator\Utils\Services\Fees;

abstract class AbstractLocalFeeService
{
    protected $state;
    protected $county;
    
    public function __construct($county)
    {
        $this->county = $county;
    }
}

