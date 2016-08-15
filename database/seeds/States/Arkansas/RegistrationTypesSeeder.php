<?php

namespace Thirty98\Seeder\States\Arkansas;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Thirty98\Models\ARRegistrationType;

class RegistrationTypesSeeder extends AbstractDatabaseSeeder
{
    public $state_code = 'AR';
    protected $table_name = 'ar_registration_types';

    protected function executeSeeder()
    {
        foreach ($this->getRegistrationTypes() AS $registration_type) {
            $exists = ARRegistrationType::where('name', $registration_type)->first();

            if (!$exists) {
                $result = ARRegistrationType::insertGetId([
                    'name' => $registration_type
                ]);

                if (!$result) {
                    die('Arkansas Registration Type. ' . PHP_EOL);
                }
            }

            continue;
        }
    }

    protected function getRegistrationTypes()
    {
        return [
            "PERMANENT",
            "ANNUAL"
        ];
    }

}
