<?php

namespace Thirty98\API\Calculator\Utils\Contracts;

interface VendorsCompInterface
{
    public function vendorsComp($sales_tax_value, $vendor_comp_rate);
}