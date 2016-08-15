<?php

namespace Thirty98\Seeder;

use Thirty98\API\Stdlib\Seeders\AbstractDatabaseSeeder;
use Illuminate\Support\Facades\DB;

class StatesSeeder extends AbstractDatabaseSeeder
{
    /**
     * @return void
     */
    protected function executeSeeder()
    {
        $iterator = 1;

        foreach ($this->getStates() AS $state) {
            
            $slug = $this->slugit($state['name']);
            $state['slug'] = $slug;
            $state['priority'] = $iterator;
            
            $exists =  DB::table('states')->where('code', $state['code'])
                ->where('slug', $slug)
                ->first();
            
            if (!$exists) {                 
                DB::table('states')->insert($state);                
            }

            $iterator++;

            continue;
        }
    }

    private function getStates()
    {
        return [
            ['code' => 'MCO/MSO', 'name' => 'MCO/MSO'],
            ['code' => 'AL', 'name' => 'Alabama'],
            ['code' => 'AK', 'name' => 'Alaska'],
            ['code' => 'AZ', 'name' => 'Arizona'],
            ['code' => 'AR', 'name' => 'Arkansas'],
            ['code' => 'CA', 'name' => 'California'],
            ['code' => 'CO', 'name' => 'Colorado'],
            ['code' => 'CT', 'name' => 'Connecticut'],
            ['code' => 'DE', 'name' => 'Delaware'],
            ['code' => 'DC', 'name' => 'District of Columbia'],
            ['code' => 'FL', 'name' => 'Florida'],
            ['code' => 'GA', 'name' => 'Georgia'],
            ['code' => 'HI', 'name' => 'Hawaii'],
            ['code' => 'ID', 'name' => 'Idaho'],
            ['code' => 'IL', 'name' => 'Illinois'],
            ['code' => 'IN', 'name' => 'Indiana'],
            ['code' => 'IA', 'name' => 'Iowa'],
            ['code' => 'KS', 'name' => 'Kansas'],
            ['code' => 'KY', 'name' => 'Kentucky'],
            ['code' => 'LA', 'name' => 'Louisiana'],
            ['code' => 'ME', 'name' => 'Maine'],
            ['code' => 'MD', 'name' => 'Maryland'],
            ['code' => 'MA', 'name' => 'Massachusetts'],
            ['code' => 'MI', 'name' => 'Michigan'],
            ['code' => 'MN', 'name' => 'Minnesota'],
            ['code' => 'MS', 'name' => 'Mississippi'],
            ['code' => 'MO', 'name' => 'Missouri'],
            ['code' => 'MT', 'name' => 'Montana'],
            ['code' => 'NE', 'name' => 'Nebraska'],
            ['code' => 'NV', 'name' => 'Nevada'],
            ['code' => 'NH', 'name' => 'New Hampshire'],
            ['code' => 'NJ', 'name' => 'New Jersey'],
            ['code' => 'NM', 'name' => 'New Mexico'],
            ['code' => 'NY', 'name' => 'New York'],
            ['code' => 'NC', 'name' => 'North Carolina'],
            ['code' => 'ND', 'name' => 'North Dakota'],
            ['code' => 'OH', 'name' => 'Ohio'],
            ['code' => 'OK', 'name' => 'Oklahoma'],
            ['code' => 'OR', 'name' => 'Oregon'],
            ['code' => 'PA', 'name' => 'Pennsylvania'],
            ['code' => 'RI', 'name' => 'Rhode Island'],
            ['code' => 'SC', 'name' => 'South Carolina'],
            ['code' => 'SD', 'name' => 'South Dakota'],
            ['code' => 'TN', 'name' => 'Tennessee'],
            ['code' => 'TX', 'name' => 'Texas'],
            ['code' => 'UT', 'name' => 'Utah'],
            ['code' => 'VT', 'name' => 'Vermont'],
            ['code' => 'VA', 'name' => 'Virginia'],
            ['code' => 'WA', 'name' => 'Washington'],
            ['code' => 'WV', 'name' => 'West Virginia'],
            ['code' => 'WI', 'name' => 'Wisconsin'],
            ['code' => 'WY', 'name' => 'Wyoming'],
        ];
    }
}
