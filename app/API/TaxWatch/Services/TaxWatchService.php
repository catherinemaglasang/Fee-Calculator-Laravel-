<?php

namespace Thirty98\API\TaxWatch\Services;

use Thirty98\API\TaxWatch\Models\TaxWatch;

class TaxWatchService
{

    protected $model;

    public function __construct(TaxWatch $model)
    {
        $this->model = $model;
    }

    public function getFees($taxable_value, $state, $street_address, $zip, $county, $city)
    {
        $fees = $this->model->getTaxWatchFees($taxable_value, $state, $street_address, $zip, $county, $city);

        $domicile_code = "";
        $domicile_name = "";
        $tax_rate = "";
        $tax_amount = "";
        $vendor_comp_rate = "";
        $vendor_comp_amount = "";

        $error = false;

        foreach ($fees as $key => $data) {
            switch ($key) {
                case "Domicile Code":
                    if ($data === "Not Found") {
                        $error = true;
                    }
                    break;
                case "Domicile Name":
                    if ($data === "") {
                        $error = true;
                    }
                    break;
                case "Tax Rate":
                    if ($data === "%") {
                        $error = true;
                    }
                    break;
                case "Tax Amount":
                    if ($data === "n/a") {
                        $error = true;
                    }
                    break;
                case "Vendor Comp Rate":
                    if ($data === "%") {
                        $error = true;
                    }
                    break;
            }
        }

        if ($error === true) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No tax watch result found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No tax watch results found in the ff inputs County: '{$county}', City: '{$city}', Street Address: '{$street_address}', Zip: '{$street_address}' in the state of '{$state}'"
                ]
            ];
        }

        return $fees;
    }
}

