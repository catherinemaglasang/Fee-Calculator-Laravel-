<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins;

use Thirty98\API\Calculator\Utils\Contracts\ConvenienceFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\DocumentFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\ElectronicFillingFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\LicenseFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\MailFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\MiscellaneousFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\NotaryFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\ProcessingFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\SalesTaxInterface;
use Thirty98\API\Calculator\Utils\Contracts\TitleFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\VendorsCompInterface;
use Thirty98\API\Stdlib\Helpers\TaxHelperService;
use App;

abstract class LouisianaCalculator extends AbstractStateCalculator implements
    DocumentFeeInterface,
    TitleFeeInterface,
    LicenseFeeInterface,
    MiscellaneousFeeInterface,
    SalesTaxInterface,
    MailFeeInterface,
    ProcessingFeeInterface,
    VendorsCompInterface,
    ConvenienceFeeInterface,
    ElectronicFillingFeeInterface,
    NotaryFeeInterface
{
    protected $state = 'LA';

    public function getComputation()
    {
        if ($this->ifParam($this->params, 'late_fees_only')) {
            $this->getLateFeesOnly();
            // $this->getLateFees();
        } else {
            /**
             * $this->getDocumentFee();
             * $this->getTitleFee();
             * $this->getLicenseFee();
             * $this->getOtherFees();
             * $this->getSalesTax();
             * $this->getLateFees();
             * $this->getTagAgencyFees();
             */
            if ($this->params['no_fees'] == false) {
                $this->getTitleFee();
                $this->getLicenseFee();
                $this->getOtherFees();
            }

            if ($this->params['exempt_from_sales_tax'] == false) {
                $this->getSalesTax();
            }
        }
    }

    public function getDocumentFee()
    {
        $this->updateTotal($this->documentFee(), "Document Fee", "Document Fee", "fees");
    }

    public function getTitleFee()
    {
        $this->updateTotal($this->handlingFee(), "Title Fee", "Handling Fee");

        if ($this->params['pos_transaction_type'] !== "QT33" &&
            $this->params['pos_transaction_type'] !== "QT51V" &&
            $this->params['pos_transaction_type'] !== "QT51LP"
        ) {
            if ($this->params['license_code'] !== "N") {
                $this->updateTotal($this->titleFee(), "Title Fee", "Title Fee");
            }

            $this->updateTotal($this->mortgageFee(), "Title Fee", "Mortgage Fee");
        }

        // Overrides.
        if($this->params['title_code'] === "Y") {
            $this->updateTotal($this->titleFee(), "Title Fee", "Title Fee");
        }

        if($this->params['title_code'] === "N" || $this->params['title_code'] === "F") {
            $this->removeFee("Title Fee", "Title Fee");
        }

        if($this->params['title_code'] === "E") {
            $this->updateTotal($this->expeditedFee(), "Title Fee", "Expedited Fee");
        }
    }

    public function getLicenseFee()
    {
        if (($this->params['pos_transaction_type'] !== "QT33"  &&
             $this->params['pos_transaction_type'] !== "QT61"  &&
             $this->params['pos_transaction_type'] !== "QT62") ||
             $this->params['pos_transaction_type'] === "QT51V" ||
             $this->params['pos_transaction_type'] === "QT51LP"
        ) {
            if ($this->params['pos_transaction_type'] === "TT25ST") {
                // Replacement Fee.
                $this->updateTotal($this->replacementFee(), "License Fee", "Replacement Fee");
            }

            if ($this->params['pos_plate_calculation_rules']['spov'] && $this->params['pos_transaction_type'] !== "TT25ST") {
                $this->updateTotal($this->licenseFee(), "License Fee", "License Fee");
            }

            $this->updateTotal($this->plateFee(), "License Fee", "Plate Fee");

            // Penalty and Interest.
            $license_fee = $this->licenseFee($this->params['taxable_value']);

            $this->updateTotal($this->licenseFeeLatePenalty($license_fee, $this->params['date_of_sale']), "License Fee", "License Fee Penalty");
            $this->updateTotal($this->interest($this->params['date_of_sale']), "License Fee", "Interest");
        }

        // Override license fee.
        if ($this->params['license_code'] === "U") {
            $this->removeFee("License Fee", "License Fee");
        }
    }

    public function getOtherFees()
    {
        if ($this->params['pos_transaction_type'] !== "QT33") {
            $this->updateTotal($this->params['vendors_comp'], "Other Fees", "Vendor's Comp");
        }

        if ($this->params['pos_transaction_type'] === "QT33") {
            $this->updateTotal(4, "Other Fees", "Other Fee");
        }

        $this->updateTotal($this->convenienceFee(), "Other Fees", "Convenience Fee");
        $this->updateTotal($this->processingFee(), "Other Fees", "Processing Fee");
        $this->updateTotal($this->mailFee(), "Other Fees", "Mail Fee");
        $this->updateTotal($this->checkFee(), "Other Fees", "Check Fee");

        // Override.
        if ($this->params['license_code'] === "T") {
            $this->updateTotal($this->transferFee(), "Other Fees", "Transfer Fee");
        }
    }

    public function getLateFees()
    {
        $taxable_value = isset($this->params['taxable_value']) ? $this->params['taxable_value'] : 0;
        $sales_tax_rate = isset($this->rates['sales_tax_rate']) ? $this->rates['sales_tax_rate'] : 0;

        $sales_tax = $this->salesTax($taxable_value, $sales_tax_rate);

        if ($this->rule['interest'] === true && $this->params['exempt_from_sales_tax'] === false && $sales_tax > 0.00 && $this->params['include_late_fees'] === true) {
            if ($this->rule['sales_tax_penalty'] === true && $sales_tax > 0) {
                $this->updateTotal($this->salesTaxLatePenalty($sales_tax, $this->params['date_of_sale']), "Late Fees", "Sales Tax Penalty", "penalties");

                // Sales Tax Penalties.
                $this->updateTotal($this->interest($this->params['date_of_sale']), "Late Fees", "Interest", "penalties");
                $this->updateTotal($this->stateTourismTaxPenalty($taxable_value, $this->params['date_of_sale']), "Late Fees", "Tourism Tax Penalty", "penalties");
                $this->updateTotal($this->stateTourismInterest($this->params['date_of_sale']), "Late Fees", "Tourism Interest", "penalties");

                // $this->updateTotal($this->parishMunicipalityTaxPenalty($sales_tax, $this->params['date_of_sale']), "Late Fees", "Parish/Municipality Tax Penalty", "penalties");
                $this->updateTotal($this->parishTaxPenalty($sales_tax, $this->params['date_of_sale']), "Late Fees", "Parish Tax Penalty", "penalties");

                if ($this->cityLimits() == true) {
                    $this->updateTotal($this->municipalityTaxPenalty($sales_tax, $this->params['date_of_sale']), "Late Fees", "Municipality Tax Penalty", "penalties");
                }

                // $this->updateTotal($this->parishMunicipalityInterest($this->params['date_of_sale']), "Late Fees", "Parish/Municipality Interest", "penalties");
                $this->updateTotal($this->parishInterest($this->params['date_of_sale']), "Late Fees", "Parish Interest", "penalties");

                if ($this->cityLimits() == true) {
                    $this->updateTotal($this->municipalityInterest($this->params['date_of_sale']), "Late Fees", "Municipality Interest", "penalties");
                }
            }
        }
    }

    public function getLateFeesOnly()
    {
        $taxable_value = isset($this->params['taxable_value']) ? $this->params['taxable_value'] : 0;
        $sales_tax_rate = isset($this->rates['sales_tax_rate']) ? $this->rates['sales_tax_rate'] : 0;
        $days_elapsed = isset($this->params['days_elapsed']) ? $this->params['days_elapsed'] : 0;

        $sales_tax = $this->salesTax($taxable_value, $sales_tax_rate); //DO NOT REMOVE IF NOT FAMILIAR

        if ($this->rule['sales_tax_penalty'] === true && $sales_tax > 0) {
            $this->updateTotal($this->salesTaxLatePenalty($sales_tax, $this->params['date_of_sale'], $days_elapsed), "Late Fees", "Sales Tax Penalty", "penalties");
        }

        if ($this->rule['interest'] === true && $this->params['exempt_from_sales_tax'] === false && $sales_tax > 0.00 && $this->params['include_late_fees'] === true) {

            // Sales Tax Penalties.
            $this->updateTotal($this->interest($this->params['date_of_sale'], $days_elapsed), "Late Fees", "Interest", "penalties");
            $this->updateTotal($this->stateTourismTaxPenalty($taxable_value, $this->params['date_of_sale'], $days_elapsed), "Late Fees", "Tourism Tax Penalty", "penalties");
            $this->updateTotal($this->stateTourismInterest($this->params['date_of_sale'], $days_elapsed), "Late Fees", "Tourism Interest", "penalties");

            $this->updateTotal($this->parishTaxPenalty($sales_tax, $this->params['date_of_sale'], $days_elapsed), "Late Fees", "Parish Tax Penalty", "penalties");

            //  dd($this->cityLimits());

            if ($this->cityLimits() == true) {
                $this->updateTotal($this->municipalityTaxPenalty($sales_tax, $this->params['date_of_sale'], $days_elapsed), "Late Fees", "Municipality Tax Penalty", "penalties");
            }

            // $this->updateTotal($this->parishMunicipalityInterest($this->params['date_of_sale']), "Late Fees", "Parish/Municipality Interest", "penalties");
            $this->updateTotal($this->parishInterest($this->params['date_of_sale'], $days_elapsed), "Late Fees", "Parish Interest", "penalties");

            if ($this->cityLimits() == true) {
                $this->updateTotal($this->municipalityInterest($this->params['date_of_sale'], $days_elapsed), "Late Fees", "Municipality Interest", "penalties");
            }
        }
    }


    public function getTagAgencyFees()
    {
        if ($this->rule['convenience_fee'] === true) {
            $this->updateTotal($this->convenienceFee(), "Tag Agency Fees", "Convenience Fee");
        }

        if ($this->rule['processing_fee'] === true) {
            $this->updateTotal($this->processingFee(), "Tag Agency Fees", "Processing Fee");
        }

        if ($this->rule['mail_fee'] === true) {
            $this->updateTotal($this->mailFee(), "Tag Agency Fees", "Mail Fee");
        }

        if ($this->rule['vendors_comp'] === true) {
            $state_vendor_comp = $this->stateVendorComp($this->params['taxable_value'], $this->rates['vendor_comp_rate']);
            $parish_vendor_comp = $this->parishVendorsComp($this->params['taxable_value'], $this->rates['vendor_comp_rate']);


            $this->updateTotal($state_vendor_comp, "Tag Agency Fees", "State Vendors Comp");
            $this->updateTotal($parish_vendor_comp, "Tag Agency Fees", "Parish Vendors Comp");

            if ($this->cityLimits() == true) {
                $municipality_vendor_comp = $this->municipalityVendorsComp($this->params['taxable_value'], $this->rates['vendor_comp_rate']);
                $this->updateTotal($municipality_vendor_comp, "Tag Agency Fees", "Municipality Vendors Comp");
            }
        }

        if ($this->params['transaction_type'] !== "DT" && $this->params['transaction_type'] !== "TRC") {
            $this->updateTotal($this->electronicFillingFee(), "Tag Agency Fees", "Electronic Filing Fee");
        }
    }

    public function getSalesTax()
    {
        $disabled_transaction_types = [
            "QT33",
            "QT41",
            "QT51V",
            "QT51LP",
            "TT64",
            "TT65",
        ];

        if (!in_array($this->params['pos_transaction_type'], $disabled_transaction_types)) {
            $sales_tax = $this->getNetSalesTax();

            $this->updateTotal($sales_tax, "Tax", "Sales Tax", "taxes");
            $this->updateTotal($this->rebateTax(), "Tax", "Rebate Tax", "taxes");
            $this->updateTotal($this->salesTaxLatePenalty($sales_tax, $this->params['date_of_sale']), "Tax", "Sales Tax Penalty", "taxes");
            $this->updateTotal($this->interest($this->params['date_of_sale']), "Tax", "Interest", "taxes");
        }
    }

    public function cityLimits()
    {
        if ($this->ifParam($this->params, 'city_limits') == true) {
            return true;
        } else {
            return false;
        }
    }

    // Value from Net State Tourism Tax
    public function getStateTourismTax()
    {
        // Get state tourism Rate.
        $taxable_amount = $this->params['taxable_value'];
        $tourism_rate = $this->rates['tourism_tax_rate'];
        $state_tourism_vendors_comp_rate = $this->rates['vendor_comp_rate'];

        $state_tourism_tax = $taxable_amount * $tourism_rate;
        $state_tourism_vendors_comp = $state_tourism_tax * $state_tourism_vendors_comp_rate;

        $net_state_tourism_tax = $state_tourism_tax - $state_tourism_vendors_comp;
        $net_state_tourism_tax = round($net_state_tourism_tax, 2);

        return $net_state_tourism_tax;
    }

    public function getNetSalesTax()
    {
        return $this->params['sales_tax_amount'];
    }

    public function getParishMunicipalityTax()
    {
        $taxable_amount = $this->params['taxable_value'];
        $area_tax = $this->rates['area_tax_rate'];
        $parish_tax = $this->rates['parish_tax_rate'];

        $municipality_sales_tax = $taxable_amount * $area_tax;
        $parish_sales_tax = $taxable_amount * $parish_tax;

        $parish_municipality_tax = $municipality_sales_tax + $parish_sales_tax;
        $parish_municipality_tax = round($parish_municipality_tax, 2);

        return $parish_municipality_tax;
    }

    public function getParishTax()
    {
        $taxable_amount = $this->params['taxable_value'];
        $parish_tax = $this->rates['parish_tax_rate'];

        // $parish_sales_tax = round($taxable_amount * $parish_tax, 2);
        $parish_sales_tax = $taxable_amount * $parish_tax;
        $parish_vendor_desc = $this->rates['parish_vendor_comp_rate'] * $parish_sales_tax;
        $parish_sales_tax = $parish_sales_tax - $parish_vendor_desc;

        return $parish_sales_tax;
    }

    public function getMunicipalityTax()
    {
        $taxable_amount = $this->params['taxable_value'];
        $area_tax = $this->rates['area_tax_rate'];

        // $municipality_sales_tax = round($taxable_amount * $area_tax, 2);
        $municipality_sales_tax = $taxable_amount * $area_tax;
        $municipality_vendor_desc = $this->rates['area_vendor_comp_rate'] * $municipality_sales_tax;
        $municipality_sales_tax = $municipality_sales_tax - $municipality_vendor_desc;

        return $municipality_sales_tax;
    }

    /**
     * Net values.
     */

    /**
     * end of Net Values.
     */

    /**
     * @param float $taxable_amount
     * @param float $sales_tax_rate
     * @return float
     */
    public function salesTax($taxable_amount, $sales_tax_rate)
    {
        return round($taxable_amount * $sales_tax_rate, 2);
    }

    public function documentFee()
    {
        return $this->rates['document_fee'];
    }

    /**
     * Manual computation
     *
     * @return real
     */
    public function titleFee()
    {
        return $this->rates['title_fee'];
    }

    /**
     * Use database value
     *
     * @return real
     */
    public function duplicateTitleFee()
    {
        return $this->titleFee() + $this->handlingFee();
    }

    public function stateTourismTax()
    {
        return 10000;
    }

    public function parishMunicipalityTax()
    {

    }

    public function handlingFee()
    {
        return $this->rates['handling_fee'];
    }

    public function titleCorrectionFee()
    {
        return $this->rates['title_correction_fee'];
    }

    public function mortgageFee()
    {
        $mortgage = isset($this->params['mortgage_fee']) ? $this->params['mortgage_fee'] : 0;

        return (float)$mortgage;
    }

    /**
     * Manual computation
     *
     * @return real
     */
    public function licenseFee($taxable_value = 0)
    {
        $rate = (round(($taxable_value - 10000) * $this->rates['license_fee_rate']) * 2);

        if ($rate < 0) {
            $rate = 0;
        }

        return $rate + 20;
    }

    public function expeditedFee()
    {
        return 10.00;
    }

    /**
     * Manual computation
     *
     * @return real
     */
    public function licenseTransferFee()
    {
        return $this->rates['license_transfer_fee'];
    }

    public function transferFee()
    {
        return 3.00;
    }

    public function replacementFee()
    {
        return 10.00;
    }

    /**
     * Manual computation
     *
     * @return real
     */
    public function licenseCreditFee()
    {
        return 0.00;
    }

    /**
     * Manual computation
     *
     * @return real
     */
    public function licenseCreditPenalty()
    {
        return 0.00;
    }

    public function towFee()
    {
        return 0.00;
    }

    public function notaryFee()
    {
        return $this->rates['notary_fee'];
    }

    public function convenienceFee()
    {
        if (isset($this->params['overrides']['convenience_fee'])) {
            return (float)$this->params['overrides']['convenience_fee'];
        } else {
            return $this->rates['convenience_fee'];
        }
    }

    public function processingFee()
    {
        if (isset($this->params['overrides']['processing_fee'])) {
            return (float)$this->params['overrides']['processing_fee'];
        } else {
            return $this->rates['processing_fee'];
        }
    }

    public function checkFee()
    {
        if (isset($this->params['overrides']['check_fee'])) {
            return (float)$this->params['overrides']['check_fee'];
        } else {
            return 0;
        }
    }

    public function mailFee()
    {
        if (isset($this->params['overrides']['mail_fee'])) {
            return (float)$this->params['overrides']['mail_fee'];
        } else {
            return $this->rates['mail_fee'];
        }
    }

    public function miscellaneousFee()
    {
        $miscellaneous_fee = isset($this->params['miscellaneous_fee']) ? (float)$this->params['miscellaneous_fee'] : 0;

        return $miscellaneous_fee;
    }

    public function electronicFillingFee()
    {
        return $this->rates['electronic_filing_fee'];
    }

    public function vendorsComp($taxable_value, $vendor_comp_rate)
    {
        // State vendor's comp.
        $state_vendor_comp = $this->stateVendorComp($taxable_value);
        $municipality_vendor_comp = ($taxable_value * $this->rates['area_tax_rate']) * $this->rates['area_vendor_comp_rate'];
        $parish_vendor_comp = ($taxable_value * $this->rates['parish_tax_rate']) * $this->rates['parish_vendor_comp_rate'];

        return round($state_vendor_comp + $municipality_vendor_comp + $parish_vendor_comp, 2);
    }

    public function stateVendorComp($taxable_value)
    {
        return ($taxable_value * $this->rates['sales_tax_rate']) * $this->rates['vendor_comp_rate'];
    }

    public function parishVendorsComp($taxable_value, $vendor_comp_rate)
    {
        return ($taxable_value * $this->rates['parish_tax_rate']) * $this->rates['parish_vendor_comp_rate'];;
    }

    public function municipalityVendorsComp($taxable_value, $vendor_comp_rate)
    {
        return ($taxable_value * $this->rates['area_tax_rate']) * $this->rates['area_vendor_comp_rate'];
    }

    public function salesTaxLatePenalty($sales_tax_value, $date_of_sale, $days_elapsed = false)
    {
        $penalty = $sales_tax_value * 0.05;
        $days = $this->getDays($date_of_sale);

        if ($days_elapsed) {
            $days = $days_elapsed;
        }

        $days = $days - 40;
        $months = 0;

        if ($days > 0) {
            $result = $days / 30;

            $split = explode('.', $result);

            $months = $split[0];
            $remainder = isset($split[1]) ? $split[1] : 0;

            if ($remainder != 0) {
                $months = $months + 1;
            }

            if ($months > 5) {
                $months = 5;
            }
        }

        return $penalty * $months;
    }

    public function licenseFeeLatePenalty($sales_tax_value, $date_of_sale, $days_elapsed = false)
    {
        $penalty = $sales_tax_value * 0.05;
        $days = $this->getDays($date_of_sale);

        if ($days_elapsed) {
            $days = $days_elapsed;
        }

        $days = $days - 40;
        $months = 0;

        if ($days > 0) {
            $result = $days / 30;

            $split = explode('.', $result);

            $months = $split[0];
            $remainder = isset($split[1]) ? $split[1] : 0;

            if ($remainder != 0) {
                $months = $months + 1;
            }

            if ($months > 5) {
                $months = 5;
            }
        }

        return $penalty * $months;
    }

    /**
     * New Tax Penalties for LA.
     * @param $taxable_value
     * @param $date_of_sale
     * @param $days_elapsed
     * @return mixed
     */
    public function stateTourismTaxPenalty($taxable_value, $date_of_sale, $days_elapsed = false)
    {
        $penalty = $taxable_value * $this->rates['tourism_tax_rate'];
        $days = $this->getDays($date_of_sale);

        if ($days_elapsed) {
            $days = $days_elapsed;
        }

        $months = ceil(($days - 40) / 30);
        $remainder = isset(explode('.', $days / 30)[1]) ? 1 : 0;

        if ($remainder) {
            $months += 1;
        }

        if ($months > 5) {
            $months = 5;
        }

        return $penalty * $months;
    }

    public function stateTourismInterest($date_of_sale, $days_elapsed = false)
    {
        $days = $this->getDays($date_of_sale);

        if ($days_elapsed) {
            $days = $days_elapsed;
        }

        $months = ceil(($days - 40) / 30);

        $remainder = isset(explode('.', $days / 30)[1]) ? 1 : 0;

        if ($remainder) {
            $months += 1;
        }

        if ($months > 5) {
            $months = 5;
        }

        $days = $months * 30;

        return $days * 0.0125;
    }

    public function parishMunicipalityTaxPenalty($taxable_value, $date_of_sale)
    {
        return $this->parishTaxPenalty($taxable_value, $date_of_sale) + $this->municipalityTaxPenalty($taxable_value, $date_of_sale);
    }


    public function parishTaxPenalty($taxable_value, $date_of_sale, $days_elapsed = false)
    {
        $parish_tax_penalty = $taxable_value * $this->rates['parish_tax_rate'];

        $penalty = $parish_tax_penalty * 0.05;

        $days = $this->getDays($date_of_sale);

        if ($days_elapsed) {
            $days = $days_elapsed;
        }

        $months = ceil(($days - 40) / 30);

        $remainder = isset(explode('.', $days / 30)[1]) ? 1 : 0;

        if ($remainder) {
            $months += 1;
        }

        if ($months > 5) {
            $months = 5;
        }

        return $penalty * $months;
    }

    public function municipalityTaxPenalty($taxable_value, $date_of_sale, $days_elapsed = false)
    {
        $parish_tax_penalty = $taxable_value * $this->rates['area_tax_rate'];

        $penalty = $parish_tax_penalty * 0.05;

        $days = $this->getDays($date_of_sale);

        if ($days_elapsed) {
            $days = $days_elapsed;
        }

        $months = ceil(($days - 40) / 30);

        $remainder = isset(explode('.', $days / 30)[1]) ? 1 : 0;

        if ($remainder) {
            $months += 1;
        }

        if ($months > 5) {
            $months = 5;
        }

        return $penalty * $months;
    }

    public function plateFee()
    {
        $pos_service = App::make("Thirty98\\API\\POS\\Services\\POSService");

        $taxable_value = isset($this->params['taxable_value']) ? $this->params['taxable_value'] : 0;
        $date_of_sale = isset($this->params['date_of_sale']) ? $this->params['date_of_sale'] : 0;
        $gvw = isset($this->params['gvw']) ? $this->params['gvw'] : 0;
        $number_of_passengers = isset($this->params['number_of_passengers']) ? $this->params['number_of_passengers'] : 0;
        $pos_transaction_type = isset($this->params['pos_transaction_type']);

        if ($pos_transaction_type === "QT51V" || $pos_transaction_type === "QT51LP") {
            $renewal = true;
        } else {
            $renewal = false;
        }

        $result = $pos_service->getPOSPlateCalculation($this->params['pos_plate_calculation_rules'],
            $taxable_value,
            $date_of_sale,
            $gvw,
            $number_of_passengers,
            $pos_transaction_type,
            $renewal
        );

        return $result;
    }

    public function parishMunicipalityInterest($date_of_sale)
    {
        return 2 * ($this->getDays($date_of_sale) * 0.0125);
    }

    public function rebateTax()
    {
        if ($this->params['date_of_sale'] >= '04/01/2016') {
            return $this->params['rebate'] * $this->params['rebate_tax_rate'];
        } else {
            return 0;
        }
    }

    public function parishInterest($date_of_sale, $days_elapsed = false)
    {
        $days = $this->getDays($date_of_sale);

        if ($days_elapsed) {
            $days = $days_elapsed;
        }

        return ($days * 0.0125);
    }

    public function municipalityInterest($date_of_sale, $days_elapsed = false)
    {
        $days = $this->getDays($date_of_sale);

        if ($days_elapsed) {
            $days = $days_elapsed;
        }

        return ($days * 0.0125);
    }

    /**
     * Current Date - Date of sale is the number of days multiplied by 1.25%
     * @param $date_of_sale
     * @param bool|false $days_elapsed
     * @return float|int
     */
    public function interest($date_of_sale, $days_elapsed = false)
    {
        $day_difference = $this->getDays($date_of_sale);

        if ($days_elapsed) {
            $day_difference = $days_elapsed;
        }

        $months = 0;

        if ($day_difference > 0) {
            $result = $day_difference / 30;

            $split = explode('.', $result);

            $months = $split[0];
            $remainder = isset($split[1]) ? $split[1] : 0;

            if ($remainder != 0) {
                $months = $months + 1;
            }
        }

        $days = 30 * $months;
        $result = $days * 0.0125;

        return $result;
    }

    public function sumAllTaxes()
    {
        $transaction_type = $this->params['transaction_type'];
        $total = parent::sumAllTaxes();

        $taxable_value = isset($this->params['taxable_value']) ? $this->params['taxable_value'] : 0;
        $sales_tax_rate = isset($this->rates['sales_tax_rate']) ? $this->rates['sales_tax_rate'] : 0;
        $sales_tax = $this->salesTax($taxable_value, $sales_tax_rate);

        if ($transaction_type != "DT" && $transaction_type) {
            $municipality_tax = 0;
            $parish_tax = 0;
            $rebate_tax = 0;
            $sales_tax_penalty = 0;
            $sales_tax_interest = 0;


            if ($this->params['taxable_value'] > 0) {
                if (isset($this->totals['Tax']['summary']['Tourism Tax'])) {
                    $total += $this->totals['Tax']['summary']['Tourism Tax'];

                    $this->totals['Tax']['total']['summary']['taxes'] += $this->totals['Tax']['summary']['Tourism Tax'];
                }

                if (isset($this->totals['Tax']['summary']['Parish Tax'])) {
                    $parish_tax = $this->getParishTax();
                }

                if (isset($this->totals['Tax']['summary']['Municipality Tax'])) {
                    $municipality_tax = $this->getMunicipalityTax();
                }

                if (isset($this->totals['Tax']['summary']['Rebate Tax'])) {
                    $rebate_tax = $this->rebateTax();
                }

                if (isset($this->totals['Tax']['summary']['Sales Tax Penalty'])) {
                    $sales_tax_penalty = $this->salesTaxLatePenalty($sales_tax, $this->params['date_of_sale']);
                }

                if (isset($this->totals['Tax']['summary']['Interest'])) {
                    $sales_tax_interest = $this->interest($this->params['date_of_sale']);
                }

                $total += round($parish_tax + $municipality_tax + $rebate_tax + $sales_tax_penalty + $sales_tax_interest, 2);
            }

            $total_amount = $total;
            $total = TaxHelperService::removeDecimal($total);
            $decimal = TaxHelperService::getDecimal($total_amount);

            if ($decimal) {
                if (TaxHelperService::checkBoundary($decimal, 0, 25)) {
                    if ($decimal == 0 || $decimal == 25) {
                    } else {
                        $total = $total . '.25';
                    }
                } else if (TaxHelperService::checkBoundary($decimal, 25, 50)) {
                    if ($decimal == 25 || $decimal == 50) {
                    } else {
                        $total = $total . '.50';
                    }
                } else if (TaxHelperService::checkBoundary($decimal, 50, 75)) {
                    if ($decimal == 50 || $decimal == 75) {

                    } else {
                        $total = $total . '.75';
                    }
                } else {
                    $total = ($total + 1);
                }
            } else {
                $total = $total;
            }

            $total = (float)$total;

            if ($total > 0) {
                $this->totals['Tax']['total']['overall'] = $total;
                $this->totals['Tax']['total']['summary']['taxes'] = $total;
            }

            return $total;
        } else {
            $this->totals['Tax']['total']['overall'] = 0;
            $this->totals['Tax']['total']['summary']['taxes'] = 0;

            return 0;
        }
    }

    protected final function sumAllFees()
    {
        $totals = 0;

        if (isset($this->totals['Title Fee']['total']['overall'])) {
            $totals = $totals + $this->totals['Title Fee']['total']['overall'];
        }

        if (isset($this->totals['Other Fees']['total']['overall'])) {
            $totals = $totals + $this->totals['Other Fees']['total']['overall'];
        }

        if (isset($this->totals['License Fee']['total']['overall'])) {
            $totals = $totals + $this->totals['License Fee']['total']['overall'];
        }

        return $totals;
    }

    protected final function sumAllPenalties()
    {
        // $total = parent::sumAllPenalties();
        $total = 0;

        // Exempt document fee and sales tax from nulling the fees
        if ($this->params['no_fees'] === true) {
            return $total;
        }

        if (isset($this->totals['Late Fees']['total']['summary']['penalties'])) {
            $total = $this->totals['Late Fees']['total']['summary']['penalties'];
        }

        return $total;
    }
}