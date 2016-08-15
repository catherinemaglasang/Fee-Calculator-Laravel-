<?php

namespace Thirty98\Seeder\States\Delaware;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Illuminate\Support\Facades\DB;

class CountyFeeSeeder extends AbstractDatabaseSeeder
{
    public $state_code = 'DE';
    protected $table_name = 'counties_fees';
    
    protected function executeSeeder()
    {
        ;
    }
}
