<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins;

use Thirty98\API\Stdlib\Traits\DateValidationTrait;
use Thirty98\API\Stdlib\Traits\RequestTrait;

abstract class AbstractStateCalculator
{
    use DateValidationTrait;
    use RequestTrait;

    protected $state;

    protected $rule;

    protected $params;

    protected $rates;

    protected $totals = [];

    /**
     * NOTE: THIS IS A FINAL FUNCTION. DO NOT CHANGE ANYTHING IF NOT FAMILIAR
     *
     * Setting the calculation configuration
     *
     * @param array $rules
     * @param array $params
     * @param array $fee_rates
     */
    public final function setConfig(Array $rules, Array $params, Array $fee_rates)
    {
        $this->params = $params;
        $this->rule = $rules;
        $this->rates = $fee_rates;
    }

    /**
     * NOTE: THIS IS A FINAL FUNCTION. DO NOT CHANGE ANYTHING IF NOT FAMILIAR
     *
     * Overall computation
     *
     * @return Array
     */
    public final function getTotal()
    {
        $this->getComputation();

        $penalties = $this->sumAllPenalties();
        $taxes = $this->sumAllTaxes();
        $fees = $this->sumAllFees();

        $total['summary'] = $this->totals;

        $total['total'] = [
            "summary" => [
                "penalties" => $penalties,
                "taxes" => $taxes,
                "fees" => $fees,
            ],
            "overall" => $fees + $taxes + $penalties
        ];

        return $total;
    }

    /**
     * Removes fees, and adjusts overalls and totals.
     * @param string $group_name
     * @param $fee_name
     * @param string $category
     */
    public function removeFee($group_name, $fee_name, $category = "fees")
    {
        if (isset($this->totals[$group_name]['summary'][$fee_name])) {
            $this->totals[$group_name]['total']['summary'][$category] = $this->totals[$group_name]['total']['summary'][$category] - $this->totals[$group_name]['summary'][$fee_name];
            $this->totals[$group_name]['total']['overall'] = $this->totals[$group_name]['total']['overall'] - $this->totals[$group_name]['summary'][$fee_name];

            unset($this->totals[$group_name]['summary'][$fee_name]);
        }
    }

    /**
     * NOTE: THIS IS A FINAL FUNCTION. DO NOT CHANGE ANYTHING IF NOT FAMILIAR
     *
     * Update the calculation based on active/available fee(s)
     *
     * @param real $amount
     * @param string $fee_name
     * @param string $category
     */
    public final function updateTotal($amount, $group_name, $fee_name, $category = "fees")
    {
        if ($amount > 0) {
            $this->removeFee($group_name, $fee_name, $category = "fees");

            // Here set's the value of the object. Now where to find that a something shit.
            $this->totals[$group_name]['summary'][$fee_name] = $amount;

            if (!isset($this->totals[$group_name]['total']['summary'][$category])) {
                $this->totals[$group_name]['total']['summary'][$category] = $amount;
            } else {
                /**
                 * NOTE: Temporary patch for doubling the result for taxes. DO NOT REMOVE/ALTER IF NOT FAMILIAR.
                 */
                if ($category !== 'taxes') {
                    $amount = (float)$amount;

                    if (!is_numeric($this->totals[$group_name]['total']['summary'][$category])) {
                        $this->totals[$group_name]['total']['summary'][$category] = 0;
                    }
                    $this->totals[$group_name]['total']['summary'][$category] += $amount;
                }
            }

            $totals = $this->totals[$group_name]['total']['summary'];

            $penalties = !isset($totals['penalties']) ? 0 : (float)$totals['penalties'];
            $fees = !isset($totals['fees']) ? 0 : (float)$totals['fees'];
            $taxes = !isset($totals['taxes']) ? 0 : (float)$totals['taxes'];

            $this->totals[$group_name]['total']['overall'] = $fees + $penalties + $taxes;
        }
    }

    /**
     * THIS IS AN ABSTRACT FUNCTION WHERE YOU APPEND ANY COMPUTATION BASED ON STATE CALCULATION.
     *
     * NOTE: DO NOT EDIT IF NOT FAMILIAR!
     *
     * @return VOID
     */
    public function getComputation()
    {
        if ($this->params['no_fees'] == false) {
            //DO NOT EDIT THE SEQUENCE IF NOT FAMILIAR
            $this->getDocumentFee();
            $this->getTitleFee();
            $this->getLicenseFee();
            $this->getOtherFees();
            $this->getSalesTax();
            $this->getLateFees();
        } else {
            $this->getSalesTax();
        }
    }

    public function getDocumentFee()
    {
        if ($this->rule['document_fee'] === true) {
            $this->updateTotal($this->documentFee(), "Document Fee", "Document Fee", "fees");
        }
    }

    public function getTitleFee()
    {
        if ($this->params['no_fees'] === false && $this->rule['title_fee'] === true) {
            $this->updateTotal($this->titleFee(), "Title Fee", "Title Fee", "fees");
        }

        if ($this->rule['duplicate_title_fee'] === true) {
            $this->updateTotal($this->duplicateTitleFee(), "Title Fee", "Duplicate Title Fee");
        }
    }

    public function getLicenseFee()
    {
        $title = "License Fee";

        if ($this->params['state']['code'] == "TX") {
            $title = "Registration Fee";
        }

        if ($this->rule['license_fee'] === true) {
            $license = $this->licenseFee($this->params['taxable_value']);
            $this->updateTotal($license, "License Fee", $title);
        }
    }

    public function getOtherFees()
    {
        if (isset($this->rule['miscellaneous_fee'])) {
            if ($this->rule['miscellaneous_fee'] === true) {
                $this->updateTotal($this->miscellaneousFee(), "Other Fee", "Miscellaneous Fee");
            }
        }
    }

    public function getSalesTax()
    {
        $sales = 0;
        if ($this->rule['sales_tax'] === true) {

            $taxable_amount = isset($this->params['taxable_value']) ? $this->params['taxable_value'] : 0;
            $sales_tax_rate = isset($this->rates['sales_tax_rate']) ? $this->rates['sales_tax_rate'] : 0;

            //Override taxable amount if exempted from sales tax
            if ($this->params['exempt_from_sales_tax']) {
                $taxable_amount = 0;
            }

            /**
             * Default computation would be:
             * sales tax = taxable amount *  sales tax rate
             */
            $sales = $this->salesTax($taxable_amount, $sales_tax_rate);

            if ($this->params['state']['code'] != 'LA') {
                $this->updateTotal($sales, "Tax", "Sales Tax", "taxes");
            }
        }

        return $sales; //MUST ALWAYS BE RETURNED
    }

    public function getLateFees()
    {
        $sales = $this->getSalesTax();

        if ($this->rule['sales_tax_penalty'] === true && $sales > 0) {
            $penalty = $this->salesTaxLatePenalty($sales, $this->params['date_of_sale']);
            $this->updateTotal($penalty, "Late Fee", "Sales Tax Penalty", "penalties");
        }
    }

    /**
     * THIS IS AN ABSTRACT FUNCTION WHERE YOU APPEND ANY COMPUTATION BASED ON STATE CALCULATION.
     *
     * NOTE: DO NOT EDIT IF NOT FAMILIAR!
     *
     * @return float
     */
    protected function sumAllFees()
    {
        $total = 0;

        if (isset($this->totals['Document Fee']['total']['summary']['fees'])) {
            $total += $this->totals['Document Fee']['total']['summary']['fees'];
        }

        if (isset($this->totals['Tax']['total']['summary']['fees'])) {
            $total += $this->totals['Taxes']['total']['summary']['fees'];
        }

        // Exempt document fee and sales tax interest from nulling the fees
        if ($this->params['no_fees'] === true) {
            return $total;
        }

        if (isset($this->totals['Title Fee']['total']['summary']['fees'])) {
            $total += $this->totals['Title Fee']['total']['summary']['fees'];
        }

        if (isset($this->totals['License Fee']['total']['summary']['fees'])) {
            $total += $this->totals['License Fee']['total']['summary']['fees'];
        }

        if (isset($this->totals['Other Fee']['total']['summary']['fees'])) {
            $total += $this->totals['Other Fee']['total']['summary']['fees'];
        }

        if (isset($this->totals['Late Fees']['total']['summary']['fees'])) {
            $total += $this->totals['Late Fees']['total']['summary']['fees'];
        }

        return $total;
    }

    /**
     * THIS IS AN ABSTRACT FUNCTION WHERE YOU APPEND ANY COMPUTATION BASED ON STATE CALCULATION.
     *
     * NOTE: DO NOT EDIT IF NOT FAMILIAR!
     *
     * @return float
     */
    protected function sumAllTaxes()
    {
        $total = 0;

        if (isset($this->totals['Tax']['total']['summary']['taxes'])) {
            if (is_numeric($this->totals['Tax']['total']['summary']['taxes'])) {
                $total += $this->totals['Tax']['total']['summary']['taxes'];
            }
        }

        return $total;
    }

    /**
     * THIS IS AN ABSTRACT FUNCTION WHERE YOU APPEND ANY COMPUTATION BASED ON STATE CALCULATION.
     *
     * NOTE: DO NOT EDIT IF NOT FAMILIAR!
     *
     * @return float
     */
    protected function sumAllPenalties()
    {
        $total = 0;

        if (isset($this->totals['Late Fee']['total']['summary']['penalties'])) {
            $total += $this->totals['Late Fee']['total']['summary']['penalties'];
        }

        return $total;
    }
}