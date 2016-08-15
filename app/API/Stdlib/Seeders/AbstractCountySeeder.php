<?php

namespace Thirty98\API\Stdlib\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractCountrySeeder extends AbstractDatabaseSeeder
{
    protected $state;
    
    protected $table = 'counties';
    
    
}
