<?php

namespace Thirty98\API\Calculator\Utils\Contracts;

interface LicenseFeeInterface
{
    public function licenseFee($taxable_amount = 0);
}