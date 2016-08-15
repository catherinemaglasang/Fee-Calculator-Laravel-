<?php

namespace Thirty98\API\Calculator\Utils\Services\StateFees;

abstract class AbstractSalesTaxService
{
    protected $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function getSalesTaxes()
    {
        return [
            'sales_tax' => $this->getSalesTax(),
            'sales_tax_late_penalty' => $this->getSalesTaxLatePenalty()
        ];
    }
    
    abstract protected function getSalesTax();
    abstract protected function getSalesTaxLatePenalty();
}
