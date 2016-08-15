<?php

namespace Thirty98\API\Stdlib\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Slugifier;

abstract class AbstractDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds by making sure it is executed within DB transaction
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();    
        try {
            Model::unguard();
            
            $this->executeSeeder();
            DB::commit();
            
            Model::reguard();  
        } catch (\Exception $error) { 
            DB::rollback();
            throw new \Exception(
                "Something's wrong executing " 
                . get_called_class()
                . PHP_EOL
                . "Error: " 
                . $error->getMessage() . " at line " . $error->getLine()
            );
            
        }
    }
    
    public function slugit($text, $separator = "_")
    {
        return Slugifier::slugify($text, $separator);
    }

    /**
     * @return void
     */
    abstract protected function executeSeeder();
}
