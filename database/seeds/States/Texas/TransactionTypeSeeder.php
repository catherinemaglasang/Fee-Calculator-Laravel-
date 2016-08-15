<?php

namespace Thirty98\Seeder\States\Texas;

use Thirty98\API\Stdlib\Seeders\AbstractTransactionTypeSeeder;

class TransactionTypeSeeder extends AbstractTransactionTypeSeeder
{
    protected $state = "TX";
    
    /**
     * 
     * @return Array
     */
    protected function getTransactionTypes()
    {
        return [
            ["transaction_type_code" => "NR", "priority"  => 1],
            ["transaction_type_code" => "TP", "priority"  => 2],
            ["transaction_type_code" => "DT", "priority"  => 3],
            ["transaction_type_code" => "TO", "priority"  => 4],
            ["transaction_type_code" => "RO", "priority"  => 5],
            ["transaction_type_code" => "TRC", "priority" => 6],
            ["transaction_type_code" => "RR", "priority"  => 7]
        ];
    }
}
