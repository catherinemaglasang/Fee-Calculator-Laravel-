<?php

namespace Thirty98\API\General\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Thirty98\API\General\Entities\APISeeder;

class States extends APISeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->comment("\nSeeding States data...");
        DB::beginTransaction();
        
        try {
            foreach ($this->getStates() AS $state) {

                if (!DB::table('states')->where('code', $state['code'])->first()) {
                    
                    DB::table('states')->insert($state);
                    
                    $this->command->comment("Added \'{$state['code']} - {$state['name']}\' in States table.");
                } else {
                    $this->command->comment("\"{$state['code']} - {$state['name']}\" state already exists in States table.");
                }
            }
            
            DB::commit();
            $this->command->comment("Successfully added States data \n");
            
        } catch (\Exception $e) {
            $this->command->error('Unable to seed States data. Error:' . $e->getMessage());
            
            DB::rollback();
        }
    }

    private function getStates()
    {
        $now = Carbon::now()->toDateTimeString();

        return [
            ['code' => 'AL', 'name' => 'Alabama', 'created_at' => $now],
            ['code' => 'AK', 'name' => 'Alaska', 'created_at' => $now],
            ['code' => 'AZ', 'name' => 'Arizona', 'created_at' => $now],
            ['code' => 'AR', 'name' => 'Arkansas', 'created_at' => $now],
            ['code' => 'CA', 'name' => 'California', 'created_at' => $now],
            ['code' => 'CO', 'name' => 'Colorado', 'created_at' => $now],
            ['code' => 'CT', 'name' => 'Connecticut', 'created_at' => $now],
            ['code' => 'DE', 'name' => 'Delaware', 'created_at' => $now],
            ['code' => 'DC', 'name' => 'District of Columbia', 'created_at' => $now],
            ['code' => 'FL', 'name' => 'Florida', 'created_at' => $now],
            ['code' => 'GA', 'name' => 'Georgia', 'created_at' => $now],
            ['code' => 'HI', 'name' => 'Hawaii', 'created_at' => $now],
            ['code' => 'ID', 'name' => 'Idaho', 'created_at' => $now],
            ['code' => 'IL', 'name' => 'Illinois', 'created_at' => $now],
            ['code' => 'IN', 'name' => 'Indiana', 'created_at' => $now],
            ['code' => 'IA', 'name' => 'Iowa', 'created_at' => $now],
            ['code' => 'KS', 'name' => 'Kansas', 'created_at' => $now],
            ['code' => 'KY', 'name' => 'Kentucky', 'created_at' => $now],
            ['code' => 'LA', 'name' => 'Louisiana', 'created_at' => $now],
            ['code' => 'ME', 'name' => 'Maine', 'created_at' => $now],
            ['code' => 'MD', 'name' => 'Maryland', 'created_at' => $now],
            ['code' => 'MA', 'name' => 'Massachusetts', 'created_at' => $now],
            ['code' => 'MI', 'name' => 'Michigan', 'created_at' => $now],
            ['code' => 'MN', 'name' => 'Minnesota', 'created_at' => $now],
            ['code' => 'MS', 'name' => 'Mississippi', 'created_at' => $now],
            ['code' => 'MO', 'name' => 'Missouri', 'created_at' => $now],
            ['code' => 'MT', 'name' => 'Montana', 'created_at' => $now],
            ['code' => 'NE', 'name' => 'Nebraska', 'created_at' => $now],
            ['code' => 'NV', 'name' => 'Nevada', 'created_at' => $now],
            ['code' => 'NH', 'name' => 'New Hampshire', 'created_at' => $now],
            ['code' => 'NJ', 'name' => 'New Jersey', 'created_at' => $now],
            ['code' => 'NM', 'name' => 'New Mexico', 'created_at' => $now],
            ['code' => 'NY', 'name' => 'New York', 'created_at' => $now],
            ['code' => 'NC', 'name' => 'North Carolina', 'created_at' => $now],
            ['code' => 'ND', 'name' => 'North Dakota', 'created_at' => $now],
            ['code' => 'OH', 'name' => 'Ohio', 'created_at' => $now],
            ['code' => 'OK', 'name' => 'Oklahoma', 'created_at' => $now],
            ['code' => 'OR', 'name' => 'Oregon', 'created_at' => $now],
            ['code' => 'PA', 'name' => 'Pennsylvania', 'created_at' => $now],
            ['code' => 'RI', 'name' => 'Rhode Island', 'created_at' => $now],
            ['code' => 'SC', 'name' => 'South Carolina', 'created_at' => $now],
            ['code' => 'SD', 'name' => 'South Dakota', 'created_at' => $now],
            ['code' => 'TN', 'name' => 'Tennessee', 'created_at' => $now],
            ['code' => 'TX', 'name' => 'Texas', 'created_at' => $now],
            ['code' => 'UT', 'name' => 'Utah', 'created_at' => $now],
            ['code' => 'VT', 'name' => 'Vermont', 'created_at' => $now],
            ['code' => 'VA', 'name' => 'Virginia', 'created_at' => $now],
            ['code' => 'WA', 'name' => 'Washington', 'created_at' => $now],
            ['code' => 'WV', 'name' => 'West Virginia', 'created_at' => $now],
            ['code' => 'WI', 'name' => 'Wisconsin', 'created_at' => $now],
            ['code' => 'WY', 'name' => 'Wyoming', 'created_at' => $now],
            ['code' => 'AS', 'name' => 'American Samoa', 'created_at' => $now],
            ['code' => 'GU', 'name' => 'Guam', 'created_at' => $now],
            ['code' => 'MP', 'name' => 'Northern Mariana Islands', 'created_at' => $now],
            ['code' => 'PR', 'name' => 'Puerto Rico', 'created_at' => $now],
            ['code' => 'VI', 'name' => 'Virgin Islands', 'created_at' => $now],
            ['code' => 'UM', 'name' => 'U.S. Minor Outlying Islands', 'created_at' => $now]
        ];
    }
}
