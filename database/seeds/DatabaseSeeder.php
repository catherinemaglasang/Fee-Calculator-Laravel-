<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * NOTE: Do not change anything if not familiar.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Exact sequence.
         */
        // General Seeders
        $this->call(\Thirty98\Seeder\StatesSeeder::class);
        $this->call(\Thirty98\Seeder\TransactionTypeSeeder::class);
        $this->call(\Thirty98\Seeder\FeesMasterlistSeeder::class);
        $this->call(\Thirty98\Seeder\VehicleTypeMasterlist::class);
        $this->call(\Thirty98\Seeder\FormFieldMasterlist::class);
        $this->call(\Thirty98\Seeder\FuelTypesSeeder::class);

        
        //State Seeders
        $this->call(\Thirty98\Seeder\States\TexasSeeder::class);
        $this->call(\Thirty98\Seeder\States\LouisianaSeeder::class);
        $this->call(\Thirty98\Seeder\States\ArkansasSeeder::class);
        //$this->call(\Thirty98\Seeder\States\DelawareSeeder::class);

        // Temp users seeder.
        $this->call(\Thirty98\Seeder\TempUserSeeder::class);
    }
}