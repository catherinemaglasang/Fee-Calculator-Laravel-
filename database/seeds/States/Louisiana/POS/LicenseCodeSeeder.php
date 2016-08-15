<?php

namespace Thirty98\Seeder\States\Louisiana\POS;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Thirty98\Models\POSLicenseCode;

class LicenseCodeSeeder extends AbstractDatabaseSeeder
{
    protected function executeSeeder()
    {
        foreach ($this->getLicenseCodes() as $license_code) {
            $exists = POSLicenseCode::where('code', '=', $license_code['code'])
                ->where('name', '=', $license_code['name'])
                ->where('priority', '=', $license_code['priority'])
                ->first();

            if (!$exists) {
                $insert_id = POSLicenseCode::insertGetId([
                    'code' => $license_code['code'],
                    'name' => $license_code['name'],
                    'priority' => $license_code['priority']
                ]);

                if (!is_numeric($insert_id)) {
                    die('Insert Failed.');
                }
            }
        }
    }

    protected function getLicenseCodes()
    {
        return [
            [
                'code' => 'C',
                'name' => 'Conversion',
                'priority' => 1
            ],
            [
                'code' => 'N',
                'name' => 'New',
                'priority' => 2
            ],
            [
                'code' => 'E',
                'name' => 'Expired',
                'priority' => 3
            ],
            [
                'code' => 'F',
                'name' => 'Free Plate',
                'priority' => 4
            ],
            [
                'code' => 'T',
                'name' => 'Transfer',
                'priority' => 5
            ],
            [
                'code' => 'L',
                'name' => 'Lost Plate',
                'priority' => 6
            ],
            [
                'code' => 'U',
                'name' => 'None',
                'priority' => 7
            ]
        ];
    }

}
