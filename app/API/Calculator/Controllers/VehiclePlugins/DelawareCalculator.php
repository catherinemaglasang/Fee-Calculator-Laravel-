<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins;

use Thirty98\API\Calculator\Utils\Contracts\DocumentFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\TitleFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\LicenseFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\MiscellaneousFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\SalesTaxInterface;
use Thirty98\API\Calculator\Utils\Contracts\InspectionFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\DealerInventoryTaxInterface;

abstract class DelawareCalculator extends AbstractStateCalculator implements
    DocumentFeeInterface,
    TitleFeeInterface,
    LicenseFeeInterface,
    MiscellaneousFeeInterface,
    SalesTaxInterface,
    InspectionFeeInterface,
    DealerInventoryTaxInterface
{
    protected $state = 'TX';
    
    public function getComputation()
    {
        $output = parent::getComputation();
        
        //Additional computations here
        $output['Property Tax'] = $this->getPropertyTax();        
        
        return $output;
    }
    
    public function sumAllFees()
    {
        $total = parent::sumAllFees();
        $total += $this->getInspectionFee()['total']['summary']['fees'];
        
        return $total;
    }
    
    public function sumAllTaxes()
    {
        $total = parent::sumAllTaxes();
        $total += $this->getPropertyTax()['total']['summary']['taxes'];
        
        return $total;
    }
    
    public function sumAllPenalties()
    {
        $total = parent::sumAllPenalties();
        $total += $this->getOtherFees()['total']['summary']['penalties'];
        
        return $total;
    }    
        
    public function getLicenseFee()
    {
        $output = parent::getLicenseFee();
                
        if ($this->rule['automation_fee'] === true) {
            $automation = $this->automateFee();
            $output['summary']['Automation Fee'] = $automation;
            $output['total']['summary']['fees'] += $automation;
        }
        
        if ($this->rule['reg_dps_fee'] === true) {
            $reg = $this->regDpsFee();
            $output['summary']['Reg DPS Fee'] = $reg;
            $output['total']['summary']['fees'] += $reg;
        }
        
        if ($this->rule['local_fee'] === true) {
            $local = $this->localFee();
            $output['summary']['Local Fee'] = $local;
            $output['total']['summary']['fees'] += $local;
        }
        
        if ($this->rule['temp_tag_fee'] === true) {
            $temp = $this->tempTagFee();
            $output['summary']['Temp Tag Fee'] = $temp;
            $output['total']['summary']['fees'] += $temp;
        }
        
        if ($this->rule['diesel_fee'] === true) {
            $diesel = $this->dieselFee();
            $output['summary']['Diesel Fee'] = $diesel;
            $output['total']['summary']['fees'] += $diesel;
        }
        
        if ($this->rule['reg_inspection_fee'] === true) {
            $inspection = $this->regInspectionFee();
            $output['summary']['Registration Inspection Fee'] = $inspection;
            $output['total']['summary']['fees'] += $inspection;
        }
        
        if ($this->rule['young_farmer_fee'] === true) {
            $young = $this->youngFarmerFee();
            $output['summary']['Young Farmer Fee'] = $young;
            $output['total']['summary']['fees'] += $young;
        }
        
        //needed to compute the totals
        $fees       = $output['total']['summary']['fees'];
        $taxes      = $output['total']['summary']['taxes'];
        $penalties  = $output['total']['summary']['penalties'];
        
        $output['total']['overall'] = $fees + $taxes + $penalties;
        
        return $output;
    }
    
    public function getOtherFees()
    {
        $output = parent::getOtherFees();
        
        if ($this->rule['rebuit_salvage_fee'] === true) {
            $rebuilt = $this->rebuiltSalvageFee();
            $output['summary']['Rebuit Salvage Fee'] = $rebuilt;
            $output['total']['summary']['fees'] += $rebuilt;
        }
        
        if ($this->rule['deputy_fee'] === true) {
            $deputy = $this->deputyFee();
            $output['summary']['Deputy Fee'] = $deputy;
            $output['total']['summary']['fees'] += $deputy;
        }
        
        if ($this->rule['dealer_late_penalty'] === true) {
            $dealer = $this->dealerLatePenalty($this->params['date_of_sale']);
            $output['summary']['Dealer Late Penalty'] = $dealer;
            $output['total']['summary']['penalties'] += $dealer;
        }
        
        if ($this->rule['individual_late_penalty'] === true) {
            $individual = $this->individualLatePenalty($this->params['date_of_sale']);
            $output['summary']['Individual Late Penalty'] = $individual;
            $output['total']['summary']['penalties'] += $individual;
        }
        
        //needed to compute the totals
        $fees       = $output['total']['summary']['fees'];
        $taxes      = $output['total']['summary']['taxes'];
        $penalties  = $output['total']['summary']['penalties'];
        
        $output['total']['overall'] = $fees + $taxes + $penalties;
        
        return $output;
    }
    
    public function getSalesTax()
    {
        $output = parent::getSalesTax();
        
        if ($this->rule['new_registration_tax'] === true) {
            $new = $this->newResidenceTax();
            $output['summary']['New Resident Tax'] = $new;
            $output['total']['summary']['taxes'] += $new;
        }
        
        if ($this->rule['gift_tax'] === true) {
            $gift = $this->giftTax();
            $output['summary']['Gift Tax'] = $gift;
            $output['total']['summary']['taxes'] += $gift;
        }
        
        if ($this->rule['even_trade_tax'] === true) {
            $even = $this->evenTradeTax();
            $output['summary']['Even Trade Tax'] = $even;
            $output['total']['summary']['taxes'] += $even;
        }
        
        if ($this->rule['emission_fee'] === true) {
            $amount = $this->params['taxable_amount'];
            $fuel_type = $this->params['fuel_type'];
            $gvw = $this->params['gvw'];
            $year = $this->params['model_year'];
            $emission = $this->emmisionFee($amount, $fuel_type, $gvw, $year);
            $output['summary']['Emission Fee'] = $emission;
            $output['total']['summary']['fees'] += $emission;
        }
        
        if ($this->rule['emissions_surcharge'] === true) {
            $surcharge = $this->emmisionSurcharge();
            $output['summary']['Emissions Surcharge'] = $surcharge;
            $output['total']['summary']['fees'] += $surcharge;
        }
        
        //needed to compute the totals
        $fees       = $output['total']['summary']['fees'];
        $taxes      = $output['total']['summary']['taxes'];
        $penalties  = $output['total']['summary']['penalties'];
        
        $output['total']['overall'] = $fees + $taxes + $penalties;
        
        return $output;
    }
    
    
    public function getInspectionFee()
    {
        $output = [];
        $output['total']['summary']['fees']         = 0.00;
        $output['total']['summary']['penalties']    = 0.00;
        $output['total']['summary']['taxes']        = 0.00;
        
        if ($this->rule['inspection_fee'] === true) {
            $inspection = $this->inspectionFee();
            $output['summary']['State Inspection Fee'] = $inspection;
            $output['total']['summary']['fees'] += $inspection;
        }
        
        //needed to compute the totals
        $fees       = $output['total']['summary']['fees'];
        $taxes      = $output['total']['summary']['taxes'];
        $penalties  = $output['total']['summary']['penalties'];
        
        $output['total']['overall'] = $fees + $taxes + $penalties;
        
        return $output;        
    }
    
    public function getPropertyTax()
    {
        $output = [];
        $output['total']['summary']['fees']         = 0.00;
        $output['total']['summary']['penalties']    = 0.00;
        $output['total']['summary']['taxes']        = 0.00;
        
        if ($this->rule['dealer_inventory_tax'] === true) {
            
            $sales = $this->params['sales_price'];
            $freight = $this->params['freight'];
            $rebate = $this->params['rebate_discount'];
            $rate = $this->params['vit_tax_rate'];
            
            $dealer = $this->dealerInventoryTax($sales, $rebate, $rate, $freight);
            $output['summary']['Dealer Inventory Tax'] = $dealer;
            $output['total']['summary']['taxes'] += $dealer;
        }
        
        //needed to compute the totals
        $fees       = $output['total']['summary']['fees'];
        $taxes      = $output['total']['summary']['taxes'];
        $penalties  = $output['total']['summary']['penalties'];
        
        $output['total']['overall'] = $fees + $taxes + $penalties;
        
        return $output;
    }
    
    /**
     * Use database value
     * 
     * @return real
     */
    public function newResidenceTax()
    {
        return 90.00;
    }
    
    /**
     * Use database value
     * 
     * @return real
     */
    public function giftTax()
    {
        return 10.00;
    }
    
    /**
     * Use database value
     * 
     * @return real
     */
    public function evenTradeTax()
    {
        return 5.00;
    }
    
    /**
     * Use database value 
     * 
     * @return real
     */
    public function duplicateTitleFee()
    {
        return 2.00;
    }
    
    /**
     * Use database value 
     * 
     * @return real
     */
    public function tempTagFee()
    {
        return 5.00;
    }
    
    /**
     * Use database value 
     * 
     * @return real
     */
    public function automateFee()
    {
        return 1.00;
    }
    
    /**
     * Use database value 
     * 
     * @return real
     */
    public function regDpsFee()
    {
        return 1.00;
    }
    
    /**
     * Use database value 
     * 
     * @return real
     */
    public function youngFarmerFee()
    {
        return 5.00;
    }    
    
    /**
     * Same sa Registration FEE
     * 
     * @return real
     */
    public function licenseFee($taxable_amount = 0)
    {
        if ($this->params['farm_ranch'] === true) {
            return $taxable_amount * 0.5;
        }
        
        return $taxable_amount;
    }
    
    /**
     * Manual computation
     * 
     * @return real
     */
    public function titleFee()
    {
        return 10.00;
    }
    
    /**
     * Manual computation
     * 
     * @return real
     */
    public function localFee()
    {
        return 0.00;
    }
    
    /**
     * Manual computation
     * 
     * @return real
     */
    public function inspectionFee()
    {
        return 0.00;
    }
    
    /**
     * Manual Computation
     * 
     * @return real
     */
    public function dieselFee()
    {
        return 0.00;
    }
    
    /**
     * Manual Computation
     * 
     * @return type
     */
    public function regInspectionFee()
    {
        return $this->inspectionFee();
    }
    
    /**
     * Manual computation
     * 
     * @return real
     */
    public function dealerLatePenalty($date_of_sale)
    {
        if ($this->getDays($date_of_sale) > 30) {
            return 10.00;
        }
        
        return 0.00;
    }
    
    /**
     * Manual computation
     * 
     * @return real
     */
    public function individualLatePenalty($date_of_sale)
    {
        $due = $this->getDays($date_of_sale);
        
        if ($due > 30) {
            $amount = 25.00 * ceil($due/30);
            
            if ($amount > 250) {
                return 250.00;
            }
            
            return $amount;            
        }
        
        return 0.00;
    }
    
    /**
     * Manual computation
     * 
     * @return real
     */
    public function salesTax($taxable_value, $rate, Array $avalara = [])
    {
        return $taxable_value * $rate;
    }
    
    /**
     * Manual computation
     * 
     * @return real
     */
    public function salesTaxLatePenalty($sales_tax_value, $date_of_sale, Array $avalara = [])
    {
        $due = $this->getDays($date_of_sale);
        
        // between 30 to 60 days
        if ($due >= 30 && $due <= 60) {
            return $sales_tax_value * 0.05;
        }
        
        // more than 60 days
        if ($due > 60) {
            return $sales_tax_value * 0.10;
        }
        
        return 0;
    }
    
    /**
     * Manual computation (possible to be executed outside the scope)
     * 
     * @return real
     */
    public function emmisionFee($taxable_value, $fuel_type, $gvw, $model_year)
    {
        if (strtoupper($fuel_type) !== "D") {
            return 0.00;
        }
        
        if ($gvw <= 14000) {
            return 0.00;
        }
        
        if ($model_year <= "1996") {
            return $taxable_value * 0.025;
        } elseif ($model_year > "1996") {
            return $taxable_value * 0.01;
        }        
    }
    
    /**
     * Manual computation
     * 
     * @return real
     */
    public function emmisionSurcharge()
    {
        return 0.00;
    }
        
    /**
     * Manual computation for VIT TAX.
     * 
     * 
     * @param float $sale_price
     * @param float $rebate
     * @param float $rate
     * @param float $freight
     * @return real
     */
    public function dealerInventoryTax($sale_price = 0, $rebate = 0, $rate = 0, $freight = 0)
    {        
        return (($sale_price + $freight) - $rebate ) * $rate;
    }
    
    
    /**
     * No computation yet
     * 
     * @return real
     */
    public function miscellaneousFee()
    {
        return 0.00;
    }
    
    /**
     * No computation yet
     * 
     * @return real
     */
    public function rebuiltSalvageFee()
    {
        return 0.00;
    }
    
    /**
     * No computation yet
     * 
     * @return real
     */
    public function deputyFee()
    {
        return 0.00;
    }
}