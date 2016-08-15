<?php

namespace Thirty98\Seeder\States\Arkansas;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Thirty98\Models\ARTagPrefix;

class TagPrefixesSeeder extends AbstractDatabaseSeeder
{
    public $state_code = 'AR';
    protected $table_name = 'ar_tax_prefixes';

    protected function executeSeeder()
    {
        foreach ($this->getTagPrefixes() AS $tag_prefix) {
            $exists = ARTagPrefix::where('name', $tag_prefix)->first();

            if (!$exists) {
                $result = ARTagPrefix::insertGetId([
                    'name' => $tag_prefix
                ]);

                if (!$result) {
                    die('Arkansas Tag Prefix Adding Failed. ' . PHP_EOL);
                }
            }

            continue;
        }
    }

    protected function getTagPrefixes()
    {
        return [
            "AA",
            "ST",
            "PT",
            "T"
        ];
    }

}
