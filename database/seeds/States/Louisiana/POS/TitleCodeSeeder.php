<?php

namespace Thirty98\Seeder\States\Louisiana\POS;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Thirty98\Models\POSTitleCode;

class TitleCodeSeeder extends AbstractDatabaseSeeder
{
    public $state_code = 'LA';

    protected function executeSeeder()
    {
        foreach ($this->getTitleCodes() as $title_code) {
            $exists = POSTitleCode::where('code', '=', $title_code['code'])
                ->where('name', '=', $title_code['name'])
                ->where('priority', '=', $title_code['priority'])
                ->first();

            if (!$exists) {
                $insert_id = POSTitleCode::insertGetId([
                    'code' => $title_code['code'],
                    'name' => $title_code['name'],
                    'priority' => $title_code['priority']
                ]);

                if (!is_numeric($insert_id)) {
                    die('Insert Failed.');
                }
            }
        }
    }

    protected function getTitleCodes()
    {
        return [
            [
                'code' => 'Y',
                'name' => 'Title Fee',
                'priority' => 1
            ],
            [
                'code' => 'N',
                'name' => 'No Charge',
                'priority' => 2
            ],
            [
                'code' => 'F',
                'name' => 'Free Title',
                'priority' => 3
            ],
            [
                'code' => 'E',
                'name' => 'Expedited Title',
                'priority' => 4
            ]
        ];
    }

}
