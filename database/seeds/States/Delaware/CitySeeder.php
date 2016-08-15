<?php

namespace Thirty98\Seeder\States\Delaware;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Illuminate\Support\Facades\DB;
use Slugifier;

class CitySeeder extends AbstractDatabaseSeeder
{
    public $state_code = 'DE';
    protected $table_name = 'cities';
    
    protected function executeSeeder()
    {
        ;
    }
}
