<?php

namespace Thirty98\Seeder\States;

use Illuminate\Database\Seeder;

class DelawareSeeder extends Seeder
{
    public function run()
    {
        //Initial
        $this->call(\Thirty98\Seeder\States\Delaware\CountySeeder::class);
        $this->call(\Thirty98\Seeder\States\Delaware\CitySeeder::class);
        
        //Fees
        $this->call(\Thirty98\Seeder\States\Delaware\CityFeeSeeder::class);
        $this->call(\Thirty98\Seeder\States\Delaware\FeeStateSeeder::class);
        $this->call(\Thirty98\Seeder\States\Delaware\CountyFeeSeeder::class);
        
        //others
        $this->call(\Thirty98\Seeder\States\Delaware\VehicleTypeSeeder::class);
        $this->call(\Thirty98\Seeder\States\Delaware\TransactionTypeSeeder::class);
    }
}
