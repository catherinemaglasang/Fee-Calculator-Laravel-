<?php

namespace Thirty98\Seeder\States\Louisiana\POS;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Thirty98\Models\POSLaLicenseCodeTransactionType;
use Thirty98\Models\POSLaTransactionType;
use Thirty98\Models\POSLicenseCode;

class LicenseCodeTransactionTypesSeeder extends AbstractDatabaseSeeder
{

    protected function executeSeeder()
    {
        $license_codes_hash = $this->getHashMap($this->getLicenseCodes(), 'code', 'id');
        $pos_transaction_types_hash = $this->getHashMap($this->getTransactionTypes(), 'code', 'id');

        foreach ($this->getTransactionTypes() as $transaction_type) {
            foreach ($this->getLicenseCodes() as $license_code) {
                $selected = 0;

                switch ($transaction_type['code']) {
                    case "QT33":
                        if ($license_code['code'] === 'U') {
                            $selected = 1;
                        }
                        break;
                    case "QT41":
                        if ($license_code['code'] === 'L') {
                            $selected = 1;
                        }
                        break;
                    case "QT51V":
                        if ($license_code['code'] === 'R') {
                            $selected = 1;
                        }
                        break;
                    case "QT51LP":
                        if ($license_code['code'] === 'R') {
                            $selected = 1;
                        }
                        break;
                    case "QT61":
                        if ($license_code['code'] === 'U') {
                            $selected = 1;
                        }
                        break;
                    case "QT52":
                        if ($license_code['code'] === 'U') {
                            $selected = 1;
                        }
                        break;
                    case "TT11":
                        if ($license_code['code'] === 'N') {
                            $selected = 1;
                        }
                        break;
                    case "TT19":
                        if ($license_code['code'] === 'U') {
                            $selected = 1;
                        }
                        break;
                    case "TT21":
                        if ($license_code['code'] === 'T') {
                            $selected = 1;
                        }
                        break;
                    case "TT24":
                        if ($license_code['code'] === 'T') {
                            $selected = 1;
                        }
                        break;
                    case "TT25":
                        if ($license_code['code'] === 'U') {
                            $selected = 1;
                        }
                        break;
                    case "TT25ST":
                        if ($license_code['code'] === 'U') {
                            $selected = 1;
                        }
                        break;
                    case "TT28":
                        if ($license_code['code'] === 'U') {
                            $selected = 1;
                        }
                        break;
                    case "TT29":
                        if ($license_code['code'] === 'U') {
                            $selected = 1;
                        }
                        break;
                    case "TT57":
                        if ($license_code['code'] === 'U') {
                            $selected = 1;
                        }
                        break;
                    case "TT60":
                        if ($license_code['code'] === 'U') {
                            $selected = 1;
                        }
                        break;
                    case "TT64":
                        if ($license_code['code'] === 'U') {
                            $selected = 1;
                        }
                        break;
                    case "TT65":
                        if ($license_code['code'] === 'U') {
                            $selected = 1;
                        }
                        break;
                }

                $exists = POSLaLicenseCodeTransactionType::where('pos_license_code_id', '=', $license_codes_hash[$license_code['code']])
                    ->where('pos_transaction_type_id', '=', $pos_transaction_types_hash[$transaction_type['code']])
                    ->where('selected', '=', $selected)
                    ->first();

                if (!$exists) {
                    // Do insert.
                    $insert_id = POSLaLicenseCodeTransactionType::insertGetId([
                        'pos_license_code_id' => $license_codes_hash[$license_code['code']],
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


    protected function getLicenseCodes()
    {
        return POSLicenseCode::all();
    }

    public function getTransactionTypes()
    {
        return POSLaTransactionType::all();
    }
}
