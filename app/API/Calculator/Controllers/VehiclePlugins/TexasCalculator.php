<?php

namespace Thirty98\API\Calculator\Controllers\VehiclePlugins;

use Thirty98\API\Calculator\Utils\Contracts\DocumentFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\TitleFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\LicenseFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\MiscellaneousFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\SalesTaxInterface;
use Thirty98\API\Calculator\Utils\Contracts\InspectionFeeInterface;
use Thirty98\API\Calculator\Utils\Contracts\DealerInventoryTaxInterface;
use Thirty98\API\Vehicle\Services\VehicleService;

abstract class TexasCalculator extends AbstractStateCalculator implements
    DocumentFeeInterface,
    TitleFeeInterface,
    LicenseFeeInterface,
    MiscellaneousFeeInterface,
    SalesTaxInterface,
    InspectionFeeInterface,
    DealerInventoryTaxInterface
{
    protected $state = 'TX';
    protected $vehicle_service;

    public function __construct()
    {
        $this->vehicle_service = new VehicleService();
    }

    public function getComputation()
    {
        if($this->ifParam($this->params, 'late_fees_only') == true) {
            $this->getLateFeesOnly();
            // $this->getLateFees();
        } else {
            parent::getComputation(); //DO NOT REMOVE IF NOT FAMILIAR

            //Additional computations here
            if ($this->params['no_fees'] === false) {
                $this->getInspectionFee();
                $this->getPropertyTax();
            }
        }
    }

    public function getTaxes()
    {

    }

    public function getDocumentFee()
    {
        if($this->params['transaction_type'] != "DT" && $this->params['transaction_type'] != "TRC") {
            $this->updateTotal($this->documentFee(), "Document Fee", "Document Fee", "fees");
        }
    }

    public function getLicenseFee()
    {
        // parent::getLicenseFee(); //DO NOT REMOVE IF NOT FAMILIAR

        if ($this->params['rebuilt_salvage'] === false) {
            parent::getLicenseFee();
        }

        if ($this->rule['automation_fee'] === true) {
            $this->updateTotal($this->automateFee(), "License Fee", "Automation Fee");
        }


        if ($this->rule['reg_dps_fee'] === true) {
            $this->updateTotal($this->regDpsFee(), "License Fee", "Reg DPS Fee");
        }

        if ($this->rule['local_fee'] === true) {
            $this->updateTotal($this->localFee(), "License Fee", "Local Fee");
        }

        if ($this->rule['temp_tag_fee'] === true && $this->params['temp_tag'] == true) {
            $this->updateTotal($this->tempTagFee(), "License Fee", "Temp Tag Fee");
        }
        
        if (isset($this->params['fuel_type'])) {
            if ($this->rule['diesel_fee'] === true && $this->params['fuel_type'] === "D") {
                $this->updateTotal($this->dieselFee(), "License Fee", "Diesel Fee");
            }
        }

        if ($this->rule['inspection_fee'] === true && $this->params['include_inspection_fee'] == true && $this->params['new_or_used']) {
            $this->updateTotal($this->dealerInspectionFee(), "License Fee", "Dealer Inspection Fee");
        }
        
        if ($this->rule['reg_inspection_fee'] === true && $this->params['include_inspection_fee'] == true) {
            $this->updateTotal($this->regInspectionFee(), "License Fee", "Registration Inspection Fee");
        }

        if ($this->rule['young_farmer_fee'] === true && $this->params['farm_ranch'] == true) {
            $this->updateTotal($this->youngFarmerFee(), "License Fee", "Young Farmer Fee");
        }
    }

    public function getOtherFees()
    {
        parent::getOtherFees();  //DO NOT REMOVE IF NOT FAMILIAR

        if ($this->rule['rebuit_salvage_fee'] === true && $this->params['rebuilt_salvage'] === true) {
            $this->updateTotal($this->rebuiltSalvageFee(), "Other Fee", "Rebuit Salvage Fee");
        }

        if ($this->rule['deputy_fee'] === true) {
            $this->updateTotal($this->deputyFee(), "Other Fee", "Deputy Fee");
        }
    }

    public function getSalesTax()
    {
        $sales = parent::getSalesTax(); //DO NOT REMOVE IF NOT FAMILIAR

        if ($this->rule['new_registration_tax'] === true) {
            $this->updateTotal($this->newResidenceTax(), "Tax", "New Resident Tax", "taxes");
        }

        if ($this->rule['gift_tax'] === true) {
            $this->updateTotal($this->giftTax(), "Tax", "Gift Tax", "taxes");
        }

        if ($this->rule['even_trade_tax'] === true) {
            $this->updateTotal($this->evenTradeTax(), "Tax", "Even Trade Tax", "taxes");
        }

        if ($this->rule['emission_fee'] === true) {

            $amount = isset($this->params['taxable_value']) ? $this->params['taxable_value'] : 0;
            $fuel_type = isset($this->params['fuel_type']) ? $this->params['fuel_type'] : "G";
            $gvw = isset($this->params['gvw']) ? $this->params['gvw'] : 0;
            $year = $this->params['model_year'];

            $emission = $this->emissionFee($amount, $fuel_type, $gvw, $year);
            $this->updateTotal($emission, "Tax", "Emission Fee");
        }

        if ($this->rule['emissions_surcharge'] === true) {
            $this->updateTotal($this->emmisionSurcharge(), "Tax", "Emissions Surcharge");
        }
        
        return $sales; //MUST ALWAYS BE RETURNED
    }


    public function getInspectionFee()
    {
        if ($this->rule['inspection_fee'] === true && $this->params['include_inspection_fee'] === true) {
            $this->updateTotal($this->stateInspectionFee(), "Inspection Fees", "State Inspection Fee");
        }
    }

    public function getPropertyTax()
    {
        if ($this->rule['dealer_inventory_tax'] === true && $this->params['include_vit_tax'] === true) {

            $sales = isset($this->params['sales_price']) ? $this->params['sales_price'] : 0;
            $trade_value = isset($this->params['trade_in_value']) ? $this->params['trade_in_value'] : 0;
            $vit_rate = isset($this->rates['vit_tax_rate']) ? $this->rates['vit_tax_rate'] : 0;

            $dealer = $this->dealerInventoryTax($sales, $trade_value, $vit_rate);
            $this->updateTotal($dealer, "Property Tax", "Dealer Inventory Tax", "taxes");
        }
    }

    public function getLateFees()
    {
        parent::getLateFees();
        
        if ($this->rule['dealer_late_penalty'] === true) {
            $dealer = $this->dealerLatePenalty($this->params['date_of_sale']);
            $this->updateTotal($dealer, "Late Fee", "Dealer Late Penalty", "penalties");
        }
        
        if ($this->rule['individual_late_penalty'] === true) {
            if ($this->params['member_of_military']) {
                
            }

            $individual = $this->individualLatePenalty($this->params['date_of_sale']);
            $this->updateTotal($individual, "Late Fee", "Individual Late Penalty", "penalties");
        }
    }

    public function getLateFeesOnly()
    {
        $taxable_value = isset($this->params['taxable_value']) ? $this->params['taxable_value'] : 0;
        $sales_tax_rate = isset($this->rates['sales_tax_rate']) ? $this->rates['sales_tax_rate'] : 0;

        $sales_tax = $this->salesTax($taxable_value, $sales_tax_rate);
        $this->updateTotal($sales_tax, "Late Fees", "Sales Tax Penalty", "penalties");

        $dealer = $this->dealerLatePenalty($this->params['date_of_sale']);
        $this->updateTotal($dealer, "Late Fees", "Dealer Late Penalty", "penalties");

        $individual = $this->individualLatePenalty($this->params['date_of_sale']);
        $this->updateTotal($individual, "Late Fees", "Individual Late Penalty", "penalties");

        // parent::getLateFees();

        // salesTaxLatePenalty($sales_tax_value, $date_of_sale)

        if ($this->rule['dealer_late_penalty'] === true) {

        }

        if ($this->rule['individual_late_penalty'] === true) {
            if ($this->params['member_of_military']) {

            }
        }
    }

    public function documentFee()
    {
        return $this->rates['document_fee'];
    }

    /**
     * Use database value
     *
     * @return real
     */
    public function newResidenceTax()
    {
        return $this->rates['new_resident_tax'];
    }

    /**
     * Use database value
     *
     * @return real
     */
    public function giftTax()
    {
        return $this->rates['gift_tax'];
    }

    /**
     * Use database value
     *
     * @return real
     */
    public function evenTradeTax()
    {
        return $this->rates['even_trade_tax'];
    }

    /**
     * Use database value
     *
     * @return real
     */
    public function duplicateTitleFee()
    {
        return $this->rates['duplicate_title_fee'];
    }

    /**
     * Use database value
     *
     * @return real
     */
    public function tempTagFee()
    {
        return $this->rates['temp_tag_fee'];
    }

    /**
     * Use database value
     *
     * @return real
     */
    public function automateFee()
    {
        return $this->rates['automate_fee'];
    }

    /**
     * Use database value
     *
     * @return real
     */
    public function regDpsFee()
    {
        return $this->rates['reg_dps_fee'];
    }

    /**
     * Use database value
     *
     * @return real
     */
    public function youngFarmerFee()
    {
        return $this->rates['young_farmer_fee'];
    }

    /**
     * Same sa Registration FEE
     *
     * @return real
     */
    public function licenseFee($taxable_value = 0)
    {
        $gvw = isset($this->params['gvw']) ? $this->params['gvw'] : 0;
        $gvw = str_replace(',', '', $gvw);

        $weight = \Thirty98\API\General\Entities\Helper::roundUpToHundreds($gvw) + 100;

        $reg_fee = $this->vehicle_service->getTXWeightFee($weight);

        if(isset($reg_fee['error'])) {
            $reg_fee = 0;
        }

        return $reg_fee;
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
     * Manual computation
     *
     * @return real
     */
    public function localFee()
    {
        return $this->rates['local_fee'];
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

    public function dealerInspectionFee()
    {
        if (!isset($this->params['processing_county']) || $this->params['processing_county'] == false) {
            return 0;
        }

        $inspection_type = $this->params["inspection_type"];

        $fee = $this->vehicle_service->getTXInspectionFeeByCode($this->params["inspection_type"])->dealer_inspection_fee;

        $emission_countries = ["021", "044", "057", "062", "071", "078", "083", "100", "124", "127", "169", "183", "198", "219"];
        $tarvis_williamson = ["226", "245"];
        $county = $this->params["processing_county"];

        switch ($this->params['inspection_type']) {
            case "1YR"      :
                return $fee; //statewide except for emission counties
            case "2YR"      :
                return $fee; //statewide
            case "CW"       :
                return $fee; //statewide
            case "CDEC"     :
                return $fee; //statewide
            case "TLMC"     :
                return $fee; //statewide
            case "TSI"      :
                return ($county !== "070") ? 0.00 : $fee;
            case "ASM"      :
                return (!in_array($county, $emission_countries)) ? 0.00 : $fee;
            case "OBD"      :
                return (!in_array($county, $emission_countries)) ? 0.00 : $fee;
            case "EMONLY"   :
                return ($county !== "070") ? 0.00 : 2.75;
            case "EMONLY-ASM":
                return (!in_array($county, $emission_countries)) ? 0.00 : $fee;
            case "EMONLY-OBD":
                return (!in_array($county, $emission_countries)) ? 0.00 : $fee;
            case "TISOBD":
                return (!in_array($county, $tarvis_williamson)) ? 0.00 : $fee;
            case "OBDNL":
                return (!in_array($county, $tarvis_williamson)) ? 0.00 : $fee;
            case "NLTSI":
                return (!in_array($county, $tarvis_williamson)) ? 0.00 : $fee;
            case "SOEO": {
                if ($county == "070" || in_array($county, $emission_countries)) {
                    return $fee;
                }

                if (in_array($county, $tarvis_williamson)) {
                    return $fee;
                }
            }
            case "CWEO": {
                if (in_array($county, $emission_countries)) {
                    return $fee;
                }

                if (in_array($county, $tarvis_williamson)) {
                    return $fee;
                }

                if ($county == "070") {
                    return $fee;
                }

            }
            default:
                return 0.00;
        }
    }

    /*public function stateInspectionOptions(Request $request)
    {
        $county_code = '226';

        $emission_a_options = [
            'state_codes' => ['021', '083', '078', '100', '169', '044', '057', '062', '071', '124', '127', '183', '198', '219'],
            'options' => ['ASM', 'OBD', 'EMONLY-ASM', 'EMONLY-OBD', 'SOEO', 'CWEO']
        ];

        $el_paso_options = [
            'state_codes' => ['070'],
            'options' => ['SOEO', 'CWEO', 'EMONLY', 'TSI']
        ];
        $emission_counties_c_options = [
            'state_codes' => ['226', '245'],
            'options' => ['TISOBD', 'OBDNL', 'NLTSI', 'SOEO', 'CWEO']
        ];

        // Get all entries aside from these emission counties.
        $state_wide = ["2YR", "CW", "CDEC", "TLMC"];

        if (in_array($county_code, $emission_a_options['state_codes'])) {
            foreach($emission_a_options['options'] as $data) {
                array_push($state_wide, $data);
            }
        }

        if (in_array($county_code, $el_paso_options['state_codes'])) {
            foreach($el_paso_options['options'] as $data) {
                array_push($state_wide, $data);
            }
        }

        if (in_array($county_code, $emission_counties_c_options['state_codes'])) {
            foreach($emission_counties_c_options['options'] as $data) {
                array_push($state_wide, $data);
            }
        }

        $state_wide = array_unique($state_wide);



        $str = "";
        $iteration = 0;
        foreach($state_wide as $code) {
            if($iteration == count($state_wide) - 1) {
                $str .= "'" . $code . "'";
            } else {
                $str .= "'" . $code . "'" . ',';
            }

            $iteration++;
        }

        $sql = "SELECT * FROM tx_inspection_fees WHERE code IN " . "(" . $str . ")";
        $data = DB::select(DB::raw($sql));
    }*/

    public function stateInspectionFee()
    {
        if (!isset($this->params['processing_county'])) {
            return 0;
        }

        $fee = $this->vehicle_service->getTXInspectionFeeByCode($this->params["inspection_type"])->state_inspection_fee;

        $emission_countries = ["021", "044", "057", "062", "071", "078", "083", "100", "124", "127", "169", "183", "198", "219"];
        $tarvis_williamson = ["226", "245"];
        $county = $this->params["processing_county"];

        switch ($this->params['inspection_type']) {
            case "1YR"      :
                return $fee; //statewide except for emission counties
            case "2YR"      :
                return $fee; //statewide
            case "CW"       :
                return $fee; //statewide
            case "CDEC"     :
                return $fee; //statewide
            case "TLMC"     :
                return $fee; //statewide
            case "TSI"      :
                return ($county !== "070") ? 0.00 : $fee;
            case "ASM"      :
                return (!in_array($county, $emission_countries)) ? 0.00 : $fee;
            case "OBD"      :
                return (!in_array($county, $emission_countries)) ? 0.00 : $fee;
            case "EMONLY"   :
                return ($county !== "070") ? 0.00 : 2.75;
            case "EMONLY-ASM":
                return (!in_array($county, $emission_countries)) ? 0.00 : $fee;
            case "EMONLY-OBD":
                return (!in_array($county, $emission_countries)) ? 0.00 : $fee;
            case "TISOBD":
                return (!in_array($county, $tarvis_williamson)) ? 0.00 : $fee;
            case "OBDNL":
                return (!in_array($county, $tarvis_williamson)) ? 0.00 : $fee;
            case "NLTSI":
                return (!in_array($county, $tarvis_williamson)) ? 0.00 : $fee;
            case "SOEO": {
                if ($county == "070" || in_array($county, $emission_countries)) {
                    return $fee;
                }

                if (in_array($county, $tarvis_williamson)) {
                    return $fee;
                }
            }
            case "CWEO": {
                if (in_array($county, $emission_countries)) {
                    return $fee;
                }

                if (in_array($county, $tarvis_williamson)) {
                    return $fee;
                }

                if ($county == "070") {
                    return $fee;
                }

            }
            default:
                return 0.00;
        }
    }

    public function getSpecificInspectionFee()
    {

    }

    /**
     * Manual computation
     *
     * @return real
     */
    public function inspectionFee2()
    {
        if (!isset($this->params['processing_county'])) {
            return 0;
        }

        $emission_countries = ["021", "044", "057", "062", "071", "078", "083", "100", "124", "127", "169", "183", "198", "219"];
        $tarvis_williamson = ["226", "245"];
        $county = $this->params["processing_county"];

        switch ($this->params['inspection_type']) {
            case "1YR"      :
                return 7.50; //statewide except for emission counties
            case "2YR"      :
                return 16.75; //statewide
            case "CW"       :
                return 22.00; //statewide
            case "CDEC"     :
                return 22.00; //statewide
            case "TLMC"     :
                return 7.50; //statewide
            case "TSI"      :
                return ($county !== "070") ? 0.00 : 8.25;
            case "ASM"      :
                return (!in_array($county, $emission_countries)) ? 0.00 : 8.25;
            case "OBD"      :
                return (!in_array($county, $emission_countries)) ? 0.00 : 8.25;
            case "EMONLY"   :
                return ($county !== "070") ? 0.00 : 2.75;
            case "EMONLY-ASM":
                return (!in_array($county, $emission_countries)) ? 0.00 : 2.75;
            case "EMONLY-OBD":
                return (!in_array($county, $emission_countries)) ? 0.00 : 8.75;
            case "TISOBD":
                return (!in_array($county, $tarvis_williamson)) ? 0.00 : 10.25;
            case "OBDNL":
                return (!in_array($county, $tarvis_williamson)) ? 0.00 : 10.25;
            case "NLTSI":
                return (!in_array($county, $tarvis_williamson)) ? 0.00 : 4.75;
            case "SOEO": {
                if ($county == "070" || in_array($county, $emission_countries)) {
                    return 10.25;
                }

                if (in_array($county, $tarvis_williamson)) {
                    return 12.25;
                }
            }
            case "CWEO": {
                if (in_array($county, $emission_countries)) {
                    return 30.75;
                }

                if (in_array($county, $tarvis_williamson)) {
                    return 26.75;
                }

                if ($county == "070") {
                    return 24.75;
                }

            }
            default:
                return 0.00;
        }
    }

    /**
     * Manual Computation
     *
     * @return type
     */
    public function regInspectionFee()
    {
        $emission_countries = ["021", "044", "057", "062", "071", "078", "083", "100", "124", "127", "169", "183", "198", "219"];
        $tarvis_williamson = ["226", "245"];
        $county = $this->params["processing_county"];

        switch ($this->params['inspection_type']) {
            case "1YR":
                return 7.00; //statewide except for emission counties
            case "2YR":
                return 7.00; //statewide
            case "CW":
                return 40.00; //statewide
            case "CDEC":
                return 40.00; //statewide
            case "TLMC":
                return 7.00; //statewide
            case "TSI"      :
                return ($county !== "070") ? 0.00 : 18.50;
            case "ASM"      :
                return (!in_array($county, $emission_countries)) ? 0.00 : 31.50;
            case "OBD"      :
                return (!in_array($county, $emission_countries)) ? 0.00 : 31.50;
            case "EMONLY"   :
                return ($county !== "070") ? 0.00 : 11.50;
            case "EMONLY-ASM":
                return (!in_array($county, $emission_countries)) ? 0.00 : 24.50;
            case "EMONLY-OBD":
                return (!in_array($county, $emission_countries)) ? 0.00 : 18.50;
            case "TISOBD":
                return (!in_array($county, $tarvis_williamson)) ? 0.00 : 18.50;
            case "OBDNL":
                return (!in_array($county, $tarvis_williamson)) ? 0.00 : 18.50;
            case "NLTSI":
                return (!in_array($county, $tarvis_williamson)) ? 0.00 : 11.50;
            case "SOEO": {
                if (in_array($county, $emission_countries)) {
                    return 31.50;
                }

                if (in_array($county, $tarvis_williamson)) {
                    return 18.50;
                }

                if ($county == "070") {
                    return 18.50;
                }
            }
            case "CWEO": {
                if (in_array($county, $emission_countries)) {
                    return 58.50;
                }

                if ($county == "070" || in_array($county, $tarvis_williamson)) {
                    return 51.50;
                }
            }
            default:
                return 0.00;
        }
    }

    /**
     * Manual computation
     *
     * @return real
     */
    public function dealerLatePenalty($date_of_sale)
    {
        $grace_period = 30;

        if ($this->params['member_of_military'] === true) {
            $grace_period += 30;
        }

        if ($this->getDays($date_of_sale) > $grace_period) {
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

        $grace_period = 30;

        if ($this->params['member_of_military'] === true) {
            $grace_period += 30;
        }

        if ($due > $grace_period) {
            $amount = 25.00 * ceil($due / 30);

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
    public function salesTax($taxable_amount, $sales_tax_rate)
    {
        return $taxable_amount * $sales_tax_rate;
    }

    /**
     * Manual computation
     *
     * @return real
     */
    public function salesTaxLatePenalty($sales_tax_value, $date_of_sale)
    {
        $due = $this->getDays($date_of_sale);

        $grace_period = 30;
        $max_grace_period = 60;

        if ($this->params['member_of_military'] === true) {
            $grace_period += 30;
            $max_grace_period += 30;
        }

        // between 30 to 60 days
        if ($due >= $grace_period && $due <= $max_grace_period) {
            return $sales_tax_value * 0.05;
        }

        // more than 60 days
        if ($due > $max_grace_period) {
            return $sales_tax_value * 0.10;
        }

        return 0;
    }

    /**
     * Manual computation (possible to be executed outside the scope)
     *
     * @return real
     */
    public function emissionFee($taxable_value, $fuel_type, $gvw, $model_year)
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
    public function dealerInventoryTax($sale_price = 0, $trade_value = 0, $vit_rate = 0)
    {
        return (($sale_price + $trade_value)) * $vit_rate;
    }


    /**
     * No computation yet
     *
     * @return real
     */
    public function miscellaneousFee() 
    {
        return isset($this->params['miscellaneous_fee']) ? (float) $this->params['miscellaneous_fee'] : 0;
    }

    /**
     * No computation yet
     *
     * @return real
     */
    public function rebuiltSalvageFee()
    {
        return 65.00;
    }

    /**
     * No computation yet
     *
     * @return real
     */
    public function deputyFee()
    {
        return 5.00;
    }


    /**
     * THIS IS AN ABSTRACT FUNCTION WHERE YOU APPEND ANY COMPUTATION BASED ON STATE CALCULATION.
     *
     * NOTE: DO NOT EDIT IF NOT FAMILIAR!
     *
     * @return float
     */
    protected final function sumAllFees()
    {
        $total = parent::sumAllFees();

        // Exempt document fee and sales tax from nulling the fees
        if ($this->params['no_fees'] === true) {
            return $total;
        }

        if (isset($this->totals['Inspection Fees']['total']['summary']['fees'])) {
            $total += $this->totals['Inspection Fees']['total']['summary']['fees'];
        }

        if (isset($this->totals['Reg DPS Fee']['total']['summary']['fees'])) {
            $total += $this->totals['Inspection Fees']['total']['summary']['fees'];
        }

        if (isset($this->totals['Local Fee']['total']['summary']['fees'])) {
            $total += $this->totals['Inspection Fees']['total']['summary']['fees'];
        }

        if (isset($this->totals['Automation Fee']['total']['summary']['fees'])) {
            $total += $this->totals['Inspection Fees']['total']['summary']['fees'];
        }

        if (isset($this->totals['Temp Tag Fee']['total']['summary']['fees'])) {
            $total += $this->totals['Inspection Fees']['total']['summary']['fees'];
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
    protected final function sumAllTaxes()
    {
        $total = parent::sumAllTaxes();

        // Exempt document fee and sales tax from nulling the fees
        if ($this->params['no_fees'] === true) {
            return $total;
        }

        if (isset($this->totals['Property Tax']['total']['summary']['taxes'])) {
            $total += $this->totals['Property Tax']['total']['summary']['taxes'];
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
    protected final function sumAllPenalties()
    {
        $total = parent::sumAllPenalties();

        // Exempt document fee and sales tax from nulling the fees
        if ($this->params['no_fees'] === true) {
            return $total;
        }

        return $total;
    }
}