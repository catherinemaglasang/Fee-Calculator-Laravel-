<?php

namespace Thirty98\API\Calculator\Utils\Contracts;

interface DealerInventoryTaxInterface
{
    /**
     * Manual computation for VIT TAX.
     * 
     * @param float $sale_price
     * @param float $rebate
     * @param float $rate
     * @param float $freight
     * @return real
     */
    public function dealerInventoryTax($sale_price = 0, $trade_value = 0, $vit_rate = 0);
}