<?php

namespace Thirty98\API\Calculator\Utils\Contracts;

interface SalesTaxInterface
{
    /**
     * Computes sales tax rate.
     * 
     * @param float $taxable_amount
     * @param float $sales_tax_rate
     * @param array $avalara
     */
    public function salesTax($taxable_amount, $sales_tax_rate);
    
    /**
     * 
     */
    public function salesTaxLatePenalty($sales_tax_value, $date_of_sale);
}