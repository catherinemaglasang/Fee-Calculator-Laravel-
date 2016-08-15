<?php

namespace Thirty98\Seeder\States;

use Illuminate\Database\Seeder;

class TexasSeeder extends Seeder
{
    public function run()
    {
        //Initial
        $this->call(\Thirty98\Seeder\States\Texas\CountySeeder::class);
        $this->call(\Thirty98\Seeder\States\Texas\CitySeeder::class);
        $this->call(\Thirty98\Seeder\States\Texas\CountyFeeSeeder::class);

        $this->call(\Thirty98\Seeder\States\Texas\TransactionTypeSeeder::class);
        
        //Fees
        $this->call(\Thirty98\Seeder\States\Texas\CityFeeSeeder::class);
        $this->call(\Thirty98\Seeder\States\Texas\FeeStateSeeder::class);
        $this->call(\Thirty98\Seeder\States\Texas\StateVehicleFeeSeeder::class);
        $this->call(\Thirty98\Seeder\States\Texas\StateVehicleTypeSeeder::class);
        $this->call(\Thirty98\Seeder\States\Texas\StateVehicleTypeFeeSeeder::class);
        $this->call(\Thirty98\Seeder\States\Texas\WeightFeesSeeder::class);
        $this->call(\Thirty98\Seeder\States\Texas\FuelTypesSeederTexas::class);
        $this->call(\Thirty98\Seeder\States\Texas\InspectionFeeSeeder::class);
        

        
        
        //$this->call(\Thirty98\Seeder\States\Texas\SalesTaxVehicleMapping::class);
    }
}
