<?php

namespace Thirty98\Seeder;

use Thirty98\API\Stdlib\Seeders\AbstractDatabaseSeeder;
use Illuminate\Support\Facades\DB;


class FeesMasterListSeeder extends AbstractDatabaseSeeder
{
    CONST TABLE = "fees";
    
    protected function executeSeeder()
    {
        foreach ($this->getFees() AS $fee) {
            
            $slug = $this->slugit($fee['name']);
            $fee['slug'] = $slug;
            
            $exists =  DB::table(self::TABLE)->where('slug', $slug)
                ->where('type', $fee['type'])
                ->first();
            
            if (!$exists) {                 
                DB::table(self::TABLE)->insert($fee);
            }
            
            continue;            
        }
    }
    
    protected function getFees()
    {
        return [
            ['name' => 'Document Fee', 'type' => "fee"],
            ['name' => 'Title Fee', 'type' => "fee"],
            ['name' => 'Duplicate Title Fee', 'type' => "fee"],
            ['name' => 'Decal Fee', 'type' => "fee"],
            ['name' => 'Postage Fee', 'type' => "fee"],
            ['name' => 'Lien Fee', 'type' => "fee"],
            ['name' => 'Title Correction Fee', 'type' => "fee"],
            ['name' => 'Mortgage Fee', 'type' => "fee"],
            ['name' => 'License Fee', 'type' => "fee"],
            ['name' => 'Registration Fee', 'type' => "fee"],
            ['name' => 'Automation Fee', 'type' => "fee"],
            ['name' => 'Reg DPS Fee', 'type' => "fee"],
            ['name' => 'Local Fee', 'type' => "fee"],
            ['name' => 'Temp Tag Fee', 'type' => "fee"],
            ['name' => 'Diesel Fee', 'type' => "fee"],
            ['name' => 'Regular Inspection Fee', 'type' => "fee"],
            ['name' => 'Young Farmer Fee', 'type' => "fee"],
            ['name' => 'License Transfer Fee', 'type' => "fee"],
            ['name' => 'Transfer Plate Fee', 'type' => "fee"],
            ['name' => 'Transfer Plate Trailer Fee', 'type' => "fee"],
            ['name' => 'License Credit Fee', 'type' => "fee"],
            ['name' => 'License Credit Penalty', 'type' => "penalty"],
            ['name' => 'Miscellaneous Fee', 'type' => "fee"],
            ['name' => 'Rebuilt Salvage Fee', 'type' => "fee"],
            ['name' => 'Deputy Fee', 'type' => "fee"],
            ['name' => 'Dealer Late Penalty', 'type' => "penalty"],
            ['name' => 'Casual Late Penalty', 'type' => "penalty"],
            ['name' => 'Individual Late Penalty', 'type' => "penalty"],
            ['name' => 'Handling Fee', 'type' => "fee"],
            ['name' => 'Tow Fee', 'type' => "fee"],
            ['name' => 'Notary Fee', 'type' => "fee"],
            ['name' => 'Sales Tax', 'type' => "tax"],
            ['name' => 'Sales Tax Penalty', 'type' => "penalty"],
            ['name' => 'New Resident Tax', 'type' => "tax"],
            ['name' => 'Gift Tax', 'type' => "tax"],
            ['name' => 'Even Trade Tax', 'type' => "tax"],
            ['name' => 'Emission Fee', 'type' => "fee"],
            ['name' => 'Emission Surcharge', 'type' => "fee"],
            ['name' => 'Interest', 'type' => "fee"],
            ['name' => 'Inspection Fee', 'type' => "fee"],
            ['name' => 'State Inspection Fee', 'type' => "fee"],
            ['name' => 'Dealer Inventory Tax', 'type' => "tax"],
            ['name' => 'VIT Tax', 'type' => "fee"],
            ['name' => 'Convenience Fee', 'type' => "fee"],
            ['name' => 'Processing Fee', 'type' => "fee"],
            ['name' => 'Mail Fee', 'type' => "fee"],
            ['name' => 'Vendors Comp', 'type' => "fee"],
            ['name' => 'Electronic Filing Fee', 'type' => "fee"]
        ];
    }
}
