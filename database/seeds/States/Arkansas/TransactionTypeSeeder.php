<?php

namespace Thirty98\Seeder\States\Arkansas;

use Thirty98\API\Stdlib\Seeders\AbstractTransactionTypeSeeder;

class TransactionTypeSeeder extends AbstractTransactionTypeSeeder
{
    protected $state = "AR";

    /**
     *
     * @return Array
     */
    protected function getTransactionTypes()
    {
        return [
            ["transaction_type_code" => "NR", "priority" => 1],
            ["transaction_type_code" => "TP", "priority" => 2],
            ["transaction_type_code" => "DT", "priority" => 3],
            ["transaction_type_code" => "TRC", "priority" => 4]
        ];
    }
}
