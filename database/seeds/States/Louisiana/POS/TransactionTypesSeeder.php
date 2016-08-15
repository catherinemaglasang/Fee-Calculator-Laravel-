<?php

namespace Thirty98\Seeder\States\Louisiana\POS;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Thirty98\Models\POSLaTransactionType;

class TransactionTypesSeeder extends AbstractDatabaseSeeder
{
    public $state_code = 'LA';

    protected function executeSeeder()
    {
        foreach ($this->getTransactionTypeCodes() as $transaction_type) {
            $exists = POSLaTransactionType::where('code', '=', $transaction_type['code'])
                ->where('name', '=', $transaction_type['name'])
                ->where('priority', '=', $transaction_type['priority'])
                ->first();

            if (!$exists) {
                $insert_id = POSLaTransactionType::insertGetId([
                    'code' => $transaction_type['code'],
                    'name' => $transaction_type['name'],
                    'priority' => $transaction_type['priority']
                ]);

                if (!is_numeric($insert_id)) {
                    die('Insert Failed.');
                }
            }
        }
    }

    protected function getTransactionTypeCodes()
    {
        return [
            [
                'code' => 'QT33',
                'name' => 'Change of Address | Color of Vehicle',
                'priority' => 1
            ],
            [
                'code' => 'QT41',
                'name' => 'Lost | Stolen | Replacement Sticker',
                'priority' => 2
            ],
            [
                'code' => 'QT51V',
                'name' => 'Renewal of License Plate (VIN)',
                'priority' => 3
            ],
            [
                'code' => 'QT51LP',
                'name' => 'Renewal of License Plate (LICENSE PLATE)',
                'priority' => 4
            ],
            [
                'code' => 'QT61',
                'name' => 'Duplicate Title',
                'priority' => 5
            ],
            [
                'code' => 'QT52',
                'name' => 'Duplicate Title | Lien Added | Lien Removed',
                'priority' => 6
            ],
            [
                'code' => 'TT11',
                'name' => 'Issue New Plate | Transfer Special Plate',
                'priority' => 7
            ],
            [
                'code' => 'TT19',
                'name' => 'Multiple Transfer | No Plate | No Lien | No Title',
                'priority' => 8
            ],
            [
                'code' => 'TT21',
                'name' => 'Same Plate | None',
                'priority' => 9
            ],
            [
                'code' => 'TT24',
                'name' => 'Transfer Plate from Vehicle in their Name',
                'priority' => 10
            ],
            [
                'code' => 'TT25',
                'name' => 'Issue New Plate / Sticker | None',
                'priority' => 11
            ],
            [
                'code' => 'TT25ST',
                'name' => 'Issue New Sticker Only | None',
                'priority' => 12
            ],
            [
                'code' => 'TT28',
                'name' => 'License Plate Cancelled | Expired',
                'priority' => 13
            ],
            [
                'code' => 'TT29',
                'name' => 'Current Plate | None',
                'priority' => 14
            ],
            [
                'code' => 'TT57',
                'name' => 'Transfer Plate and Renewal',
                'priority' => 15
            ],
            [
                'code' => 'TT60',
                'name' => 'Transfer and Renewal of License Plate',
                'priority' => 16
            ],
            [
                'code' => 'TT64',
                'name' => 'Record and Cancel Liens',
                'priority' => 17
            ],
            [
                'code' => 'TT65',
                'name' => 'Print a Title that was issues as Paperless',
                'priority' => 18
            ]
        ];
    }

}
