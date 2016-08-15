<?php

namespace Thirty98\Seeder\States;

use Illuminate\Database\Seeder;

class LouisianaSeeder extends Seeder
{
    public function run()
    {
        // Own sequence.
        $this->call(\Thirty98\Seeder\States\Louisiana\CountySeeder::class);
        $this->call(\Thirty98\Seeder\States\Louisiana\CitySeeder::class);
        $this->call(\Thirty98\Seeder\States\Louisiana\WeightFeeSeeder::class);
        $this->call(\Thirty98\Seeder\States\Louisiana\VehicleFeeSeeder::class);
        $this->call(\Thirty98\Seeder\States\Louisiana\FeeSeeder::class);
        $this->call(\Thirty98\Seeder\States\Louisiana\StateVehicleFeeSeeder::class);

        $this->call(\Thirty98\Seeder\States\Louisiana\TransactionTypeSeeder::class);
        $this->call(\Thirty98\Seeder\States\Louisiana\StateVehicleTypeSeeder::class);
        $this->call(\Thirty98\Seeder\States\Louisiana\StateVehicleTypeFeeSeeder::class);
        $this->call(\Thirty98\Seeder\States\Louisiana\PlateTypesSeeder::class);
        $this->call(\Thirty98\Seeder\States\Louisiana\StatePlateTypesSeeder::class);
        $this->call(\Thirty98\Seeder\States\Louisiana\StateVehiclePlateTypesSeeder::class);
        $this->call(\Thirty98\Seeder\States\Louisiana\LACityParishSalesTaxesSeeder::class);
        $this->call(\Thirty98\Seeder\States\Louisiana\LALicenseWeightFeesSeeder::class);
        $this->call(\Thirty98\Seeder\States\Louisiana\FuelTypesSeederLouisiana::class);
        $this->call(\Thirty98\Seeder\States\Louisiana\BodyStylesSeeder::class);

        // POS.
        $this->call(\Thirty98\Seeder\States\Louisiana\POS\StatePlateCodeCategorySeeder::class);
        $this->call(\Thirty98\Seeder\States\Louisiana\POS\StatePlateCodeSeeder::class);
        $this->call(\Thirty98\Seeder\States\Louisiana\POS\TitleCodeSeeder::class);
        $this->call(\Thirty98\Seeder\States\Louisiana\POS\LicenseCodeSeeder::class);
        $this->call(\Thirty98\Seeder\States\Louisiana\POS\TransactionTypesSeeder::class);
        $this->call(\Thirty98\Seeder\States\Louisiana\POS\LicenseCodeTransactionTypesSeeder::class);
        $this->call(\Thirty98\Seeder\States\Louisiana\POS\TitleCodeTransactionTypesSeeder::class);
        $this->call(\Thirty98\Seeder\States\Louisiana\POS\NorthAmericanStatesSeeder::class);



        /*
        //Initial
        $this->call(\Thirty98\Seeder\States\Louisiana\CountySeeder::class);
        $this->call(\Thirty98\Seeder\States\Louisiana\CitySeeder::class);
        
        //Fees
        $this->call(\Thirty98\Seeder\States\Louisiana\CityFeeSeeder::class);
        $this->call(\Thirty98\Seeder\States\Louisiana\FeeStateSeeder::class);
        $this->call(\Thirty98\Seeder\States\Louisiana\CountyFeeSeeder::class);
        
        //others
        $this->call(\Thirty98\Seeder\States\Louisiana\VehicleTypeSeeder::class);
        $this->call(\Thirty98\Seeder\States\Louisiana\TransactionTypeSeeder::class);*/
    }
}