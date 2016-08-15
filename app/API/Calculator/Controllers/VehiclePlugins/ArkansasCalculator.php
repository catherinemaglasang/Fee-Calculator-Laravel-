<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins;

/*use Thirty98\API\Calculator\Utils\Contracts\DocumentFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\TitleFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\LicenseFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\MiscellaneousFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\SalesTaxInterface;
use Thirty98\API\Calculator\Utils\Contracts\MailFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\ProcessingFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\VendorsCompInterface;
use Thirty98\API\Calculator\Utils\Contracts\ConvenienceFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\ElectronicFillingFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\NotaryFeeInterface;*/

abstract class ArkansasCalculator extends AbstractStateCalculator // implements
    /*DocumentFeeInterface,
    TitleFeeInterface,
    LicenseFeeInterface,
    MiscellaneousFeeInterface,
    SalesTaxInterface,
    MailFeeInterface,
    ProcessingFeeInterface,
    VendorsCompInterface,
    ConvenienceFeeInterface,
    ElectronicFillingFeeInterface,
    NotaryFeeInterface*/
{
    protected $state = 'AR';

    public function getComputation()
    {
        parent::getComputation(); //DO NOT REMOVE IF NOT FAMILIAR
    }

    public function getDocumentFee()
    {
        $this->updateTotal($this->documentFee(), "Document Fee", "Document Fee");
    }

    public function getLicenseFee()
    {
        if ($this->rule['license_fee'] === true) {
            $this->updateTotal($this->licenseFee(), "License Fee", "Registration Fee", "fees");
        }

        if ($this->rule['transfer_plate_fee'] === true && $this->params['transfer_plate'] == true) {
            $this->updateTotal($this->licenseTransferFee(), "License Fee", "Transfer Plate Fee", "fees");
        }

        if ($this->rule['decal_fee'] === true) {
            $this->updateTotal($this->decalFee(), "License Fee", "Decal Fee", "fees");
        }

        if ($this->rule['postage_fee'] === true) {
            $this->updateTotal($this->postageFee(), "License Fee", "Postage Fee", "fees");
        }

        if ($this->rule['temp_tag_fee'] === true && $this->params['temp_tag'] == true) {
            $this->updateTotal($this->tempTag(), "License Fee", "Temp Tag", "fees");
        }
    }

    public function getSalesTax()
    {
        if ($this->rule['sales_tax'] === true && $this->params['exempt_from_sales_tax'] == false) {
            if ($this->rule['sales_tax'] === true) {
                $this->updateTotal($this->salesTax(), "Tax", "Sales Tax", "taxes");
            }

            if ($this->rule['city_tax'] === true) {
                $this->updateTotal($this->cityRate(), "Tax", "City Rate", "taxes");
            }

            if ($this->rule['county_tax'] === true) {
                $this->updateTotal($this->countyRate(), "Tax", "County Rate", "taxes");
            }
        }
    }

    public function getLateFees()
    {
        if ($this->rule['sales_tax_penalty'] === true) {
            $this->updateTotal($this->salesTaxLatePenalty(), "Late Fee", "Sales Tax Late Penalty", "penalties");
        }

        if ($this->rule['license_fee_penalty'] === true) {
            $this->updateTotal($this->registrationLatePenalty(), "Late Fee", "Registration Late Penalty", "penalties");
        }
    }

    public function sumAllTaxes()
    {
        $total = parent::sumAllTaxes();

        if (isset($this->totals['Tax']['summary']['City Rate'])) {
            $total += $this->totals['Tax']['summary']['City Rate'];
            $this->totals['Tax']['total']['summary']['taxes'] += $this->totals['Tax']['summary']['City Rate'];
        }

        if (isset($this->totals['Tax']['summary']['County Rate'])) {
            $total += $this->totals['Tax']['summary']['County Rate'];
            $this->totals['Tax']['total']['summary']['taxes'] += $this->totals['Tax']['summary']['County Rate'];
        }

        if (isset($this->totals['Tax']['total']['overall'])) {
            $this->totals['Tax']['total']['overall'] = $this->totals['Tax']['total']['summary']['taxes'];
        }

        return $total;
    }

    public function getTitleFee()
    {
        if ($this->params['no_fees'] === false && $this->rule['title_fee'] === true) {
            $this->updateTotal($this->titleFee(), "Title Fee", "Title Fee", "fees");

            if($this->ifParam($this->params, 'vehicle_financed') === true) {
                $this->updateTotal($this->lienFee(), "Title Fee", "Lien Fee", "fees");
            }
        }
    }

    public function decalFee()
    {
        return $this->rates['decal_fee'];
    }

    public function salesTax()
    {
        return $this->service->fetchArkansasSalesTax($this->params['city'], $this->params['taxable_value']);
    }

    public function salesTaxLatePenalty()
    {
        $grace_period = 30;
        $due = $this->getDays($this->params['date_of_sale']);

        if ($due > $grace_period) {
            return $this->salesTax() * .10;
        } else {
            return 0;
        }
    }

    public function registrationLatePenalty()
    {
        $grace_period = 30;
        $due = $this->getDays($this->params['date_of_sale']);

        if ($due > $grace_period) {
            $due = $due / 10;

            $number = explode('.', $due);
            $due = $number[0];

            if (isset($number[1])) {
                $due = $due + 1;
            }

            $due = floor($due);
        } else {
            $due = 0;
        }

        return 3 * $due;
    }

    public function cityRate()
    {
        return $this->service->fetchArkansasCityRate($this->params['city'], $this->params['taxable_value']);
    }

    public function countyRate()
    {
        return $this->service->fetchArkansasCountyRate($this->params['city'], $this->params['taxable_value']);
    }

    public function tempTag()
    {
        return 5.00;
    }

    public function postageFee()
    {
        return $this->rates['postage_fee'];
    }

    public function licenseTransferFee()
    {
        return $this->rates['license_transfer_fee'];
    }

    public function titleFee()
    {
        return $this->rates['title_fee'];
    }

    public function lienFee()
    {
        return $this->rates['lien_fee'];
    }

    public function documentFee()
    {
        return 129;
    }

    public function licenseFee()
    {
        return $this->rates['license_fee_rate'];
    }
}