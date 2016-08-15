<?php

namespace Thirty98\Seeder\States;

use Illuminate\Database\Seeder;

class ArkansasSeeder extends Seeder
{
    public function run()
    {
        //Initial
        $this->call(\Thirty98\Seeder\States\Arkansas\TransactionTypeSeeder::class);
        $this->call(\Thirty98\Seeder\States\Arkansas\CountySeeder::class);
        $this->call(\Thirty98\Seeder\States\Arkansas\CitySeeder::class);
        $this->call(\Thirty98\Seeder\States\Arkansas\CityTaxRatesSeeder::class);
        $this->call(\Thirty98\Seeder\States\Arkansas\WeightClassSeeder::class);
        $this->call(\Thirty98\Seeder\States\Arkansas\PassengerWeightFeesSeeder::class);
        $this->call(\Thirty98\Seeder\States\Arkansas\TagPrefixesSeeder::class);
        $this->call(\Thirty98\Seeder\States\Arkansas\TagPullingUnitsSeeder::class);
        $this->call(\Thirty98\Seeder\States\Arkansas\RegistrationTypesSeeder::class);
        $this->call(\Thirty98\Seeder\States\Arkansas\VehicleUseTypesSeeder::class);
        $this->call(\Thirty98\Seeder\States\Arkansas\TrailerFeesSeeder::class);
        $this->call(\Thirty98\Seeder\States\Arkansas\TruckClassesSeeder::class);
        $this->call(\Thirty98\Seeder\States\Arkansas\CommercialWeightFeesSeeder::class);
        $this->call(\Thirty98\Seeder\States\Arkansas\StateVehicleTypeSeeder::class);
        $this->call(\Thirty98\Seeder\States\Arkansas\StateVehicleFeeSeeder::class);
        $this->call(\Thirty98\Seeder\States\Arkansas\StateVehicleTypeFeeSeeder::class);


    }
}
