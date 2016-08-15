<?php

namespace Thirty98\Seeder\States\Louisiana\POS;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Thirty98\Models\POSLaTitleCodeTransactionType;
use Thirty98\Models\POSLaTransactionType;
use Thirty98\Models\POSTitleCode;

class TitleCodeTransactionTypesSeeder extends AbstractDatabaseSeeder
{

    protected function executeSeeder()
    {
        $title_codes_hash = $this->getHashMap($this->getTitleCodes(), 'code', 'id');
        $pos_transaction_types_hash = $this->getHashMap($this->getTransactionTypes(), 'code', 'id');

        foreach ($this->getTransactionTypes() as $transaction_type) {
            foreach ($this->getTitleCodes() as $title_code) {
                $selected = 0;

                switch ($transaction_type['code']) {
                    case "QT33":
                        if ($title_code['code'] === 'N') {
                            $selected = 1;
                        }
                        break;
                    case "QT41":
                        if ($title_code['code'] === 'N') {
                            $selected = 1;
                        }
                        break;
                    case "QT51V":
                        if ($title_code['code'] === 'N') {
                            $selected = 1;
                        }
                        break;
                    case "QT51LP":
                        if ($title_code['code'] === 'N') {
                            $selected = 1;
                        }
                        break;
                    case "QT61":
                        if ($title_code['code'] === 'Y') {
                            $selected = 1;
                        }
                        break;
                    case "QT52":
                        if ($title_code['code'] === 'Y') {
                            $selected = 1;
                        }
                        break;
                    case "TT11":
                        if ($title_code['code'] === 'Y') {
                            $selected = 1;
                        }
                        break;
                    case "TT19":
                        if ($title_code['code'] === 'Y') {
                            $selected = 1;
                        }
                        break;
                    case "TT21":
                        if ($title_code['code'] === 'Y') {
                            $selected = 1;
                        }
                        break;
                    case "TT24":
                        if ($title_code['code'] === 'Y') {
                            $selected = 1;
                        }
                        break;
                    case "TT25":
                        if ($title_code['code'] === 'Y') {
                            $selected = 1;
                        }
                        break;
                    case "TT25ST":
                        if ($title_code['code'] === 'Y') {
                            $selected = 1;
                        }
                        break;
                    case "TT28":
                        if ($title_code['code'] === 'Y') {
                            $selected = 1;
                        }
                        break;
                    case "TT29":
                        if ($title_code['code'] === 'Y') {
                            $selected = 1;
                        }
                        break;
                    case "TT57":
                        if ($title_code['code'] === 'Y') {
                            $selected = 1;
                        }
                        break;
                    case "TT60":
                        if ($title_code['code'] === 'Y') {
                            $selected = 1;
                        }
                        break;
                    case "TT64":
                        if ($title_code['code'] === 'Y') {
                            $selected = 1;
                        }
                        break;
                    case "TT65":
                        if ($title_code['code'] === 'N') {
                            $selected = 1;
                        }
                        break;
                }

                $exists = POSLaTitleCodeTransactionType::where('pos_title_code_id', '=', $title_codes_hash[$title_code['code']])
                    ->where('pos_transaction_type_id', '=', $pos_transaction_types_hash[$transaction_type['code']])
                    ->where('selected', '=', $selected)
                    ->first();

                if (!$exists) {
                    // Do insert.
                    $insert_id = POSLaTitleCodeTransactionType::insertGetId([
                        'pos_title_code_id' => $title_codes_hash[$title_code['code']],
                        'pos_transaction_type_id' => $pos_transaction_types_hash[$transaction_type['code']],
                        'selected' => $selected
                    ]);

                    if (!is_numeric($insert_id)) {
                        die('Insert failed.');
                    }
                }
            }
        }
    }


    protected function getTitleCodes()
    {
        return POSTitleCode::all();
    }

    public function getTransactionTypes()
    {
        return POSLaTransactionType::all();
    }
}
