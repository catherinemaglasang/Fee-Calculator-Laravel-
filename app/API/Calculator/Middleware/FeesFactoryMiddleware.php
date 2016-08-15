<?php

namespace Thirty98\API\Calculator\Middleware;

use Thirty98\API\Stdlib\Middleware\AbstractPostMiddleware;
use Thirty98\API\Calculator\Services\VehicleFeesService;

//use Thirty98\API\Calculator\Services\FeesConfigurationFactoryService;

class FeesFactoryMiddleware extends AbstractPostMiddleware
{
    protected $state;
    protected $vehicle;
    protected $vehicle_service;

    public function __construct(VehicleFeesService $vehicle)
    {
        $this->vehicle_service = $vehicle;
    }

    protected function postValidationRules()
    {
        /**
         * Need required for LA
         */
//        return [
//            'date_of_sale' => 'required|date',
//            'gvw' => 'required',
//            'farm_use' => 'required_if:state.code,LA',
//            'county' => 'required_if:state.code,LA',
//            'city' => 'required_if:state.code,LA'
//        ];

        $validations = [];

        $state_code = $this->payload['state']['code'];

        // Texas logic.
        if ($state_code === 'TX') {
            $vehicle_type = $this->payload['vehicle_type']['slug'];

            if ($vehicle_type === 'motorcycle' || $vehicle_type === 'mini_bike' || $vehicle_type === 'moped' ||
                $vehicle_type === 'atv_type_vehicle' || $vehicle_type === 'off_road_motorcycle'
            ) {
                $validations['processing_county'] = 'required';
            }
        }

        return $validations;
    }

    protected function updateRequest(Array $payload)
    {
        $this->state = $payload['state'];
        $this->vehicle = $payload['vehicle_type'];
        $this->county = isset($payload['processing_county']) ? $payload['processing_county'] : false;

        // die($this->county);

        $payload['fee_rates']['document_fee'] = $this->getDocumentFeeRate();

        $payload['fee_rates']['title_fee'] = $this->getTitleFeeRate();

        $payload['fee_rates']['license_fee_rate'] = $this->getLicenseFeeRate();
        $payload['fee_rates']['notary_fee'] = $this->getNotaryFeeRate();
        $payload['fee_rates']['license_transfer_fee'] = $this->getLicenseTransferFeeRate();

        // Other Fees.
        $payload['fee_rates']['convenience_fee'] = $this->getConvenienceFeeRate();
        $payload['fee_rates']['processing_fee'] = $this->getProcessingFeeRate();
        $payload['fee_rates']['mail_fee'] = $this->getMailFeeRate();
        $payload['fee_rates']['electronic_filing_fee'] = $this->getElectronicFilingFeeRate();

        // Private buses.
        $payload['fee_rates']['private_bus_fee_rate'] = $this->getPrivateBusFeeRate();
        $payload['fee_rates']['private_bus_hire_fee_rate'] = $this->getPrivateBusHireFeeRate();

        // Tourism Tax Rates
        // $payload['fee_rates']['sales_tax_rate'] = $this->getSalesTaxRate();
        $payload['fee_rates']['sales_tax_rate'] = $payload['sales_tax_rate'];
        $payload['fee_rates']['vendor_comp_rate'] = $this->getVendorCompRate();
        $payload['fee_rates']['tourism_tax_rate'] = $this->getTourismTaxRate();
        $payload['fee_rates']['area_tax_rate'] = isset($payload['Sales Tax Rate']['area_tax']) ? $payload['Sales Tax Rate']['area_tax'] : 0;
        $payload['fee_rates']['area_vendor_comp_rate'] = isset($payload['Sales Tax Rate']['area_vendor_desc']) ? $payload['Sales Tax Rate']['area_vendor_desc'] : 0;
        $payload['fee_rates']['parish_tax_rate'] = isset($payload['Sales Tax Rate']['parish_tax']) ? $payload['Sales Tax Rate']['parish_tax'] : 0;
        $payload['fee_rates']['parish_vendor_comp_rate'] = isset($payload['Sales Tax Rate']['parish_vendor_desc']) ? $payload['Sales Tax Rate']['parish_vendor_desc'] : 0;


        $payload['fee_rates']['vit_tax_rate'] = $this->getVitTaxRate();
        $payload['fee_rates']['handling_fee'] = $this->getHandlingFeeRate();
        $payload['fee_rates']['temp_tag_fee'] = $this->getTempTagFeeRate();
        $payload['fee_rates']['automate_fee'] = $this->getAutomateFeeRate();
        $payload['fee_rates']['local_fee'] = $this->getLocalFeeRate();
        $payload['fee_rates']['title_correction_fee'] = $this->getTitleCorrectionFeeRate();

        //$payload['fee_rates']['diesel_fee_rate']        = $this->getDieselFeeRate();

        //$payload['fee_rates']['duplicate_title_fee']    = $this->getDuplicateTitleFeeRate();
        //$payload['fee_rates']['gift_tax']                = $this->getGiftTaxRate();
        //$payload['fee_rates']['even_trade_tax']         = $this->getEvenTradeTaxRate();
        //$payload['fee_rates']['emission_fee_rate']      = $this->getEmissionFeeRate();
        //$payload['fee_rates']['reg_dps_fee']            = $this->getRegDpsFeeRate();
        //$payload['fee_rates']['young_farmers_fee']      = $this->getYoungFarmersFeeRate();
        //$payload['fee_rates']['inspection_fee']         = $this->getInspectionFeeRate();


        // Texas backend.
        /*
         *   NEW_RESID_TAX
         *   GIFT_TAX
         *   EVEN_TRADE_TAX
         *   DUP_TITLE_FEE
         *   DLR_LT_PNLTY
         *   CASUAL_LT_PNLTY
         *   REG_DPS_FEE
         *   AUTOMAT_FEE (like)
         *   TEMP_TAG_FEE
         *   YNG_FRMR_FEE
         */
        $payload['fee_rates']['new_resident_tax'] = $this->getNewResidentTaxRate();
        $payload['fee_rates']['gift_tax'] = $this->getGifTaxRate();
        $payload['fee_rates']['even_trade_tax'] = $this->getEvenTradeTaxRate();
        $payload['fee_rates']['duplicate_title_fee'] = $this->getDuplicateTitleTaxRate();
        $payload['fee_rates']['dealer_late_penalty'] = $this->getDealerLatePenaltyFeeRate();
        $payload['fee_rates']['casual_late_fee'] = $this->getCasualLatePenaltyFeeTaxRate();
        $payload['fee_rates']['reg_dps_fee'] = $this->getAutomationTaxFeeRate();
        $payload['fee_rates']['automation_fee'] = $this->getAutomationTaxFeeRate();
        $payload['fee_rates']['young_farmer_fee'] = $this->getYoungFarmTaxFeeRate();

        /*$load = [
            'new_resident_tax' => $this->getNewResidentTaxRate(),
            'gift_tax' => $this->getGifTaxRate(),
            'even_trade_tax' => $this->getEvenTradeTaxRate(),
            'duplicate_title_fee' => $this->getDuplicateTitleTaxRate(),
            'dealer_late_penalty' => $this->getDealerLatePenaltyFeeRate(),
            'casual_late_fee' => $this->getCasualLatePenaltyFeeTaxRate(),
            'reg_dps_fee' => $this->getRegDPSFeeTaxRate(),
            'automation_fee' => $this->getAutomationTaxFeeRate(),
            'young_farmer_fee' => $this->getYoungFarmTaxFeeRate()
        ];

        dd($load);*/

        // Unique for Arkansas
        //
        $payload['fee_rates']['lien_fee'] = $this->getLienFeeRate();
        $payload['fee_rates']['decal_fee'] = $this->getDecalFeeRate();
        $payload['fee_rates']['postage_fee'] = $this->getPostageFeeRate();

        $payload['fee_rates']['sample'] = 'HOHOHO';

        //  -- Postage Fee

        return $payload;
    }

    private function getYoungFarmTaxFeeRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Taxes\\" . $this->state['class'] . "\\YoungFarmerTaxFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $automation_tax_fee_class = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($automation_tax_fee_class, "setVehicleFeeService")) {
            $automation_tax_fee_class->setVehicleFeeService($this->vehicle_service);
        }

        return $automation_tax_fee_class->getRate();
    }

    private function getRegDPSFeeTaxRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Taxes\\" . $this->state['class'] . "\\RegDPSTaxFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $automation_tax_fee_class = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($automation_tax_fee_class, "setVehicleFeeService")) {
            $automation_tax_fee_class->setVehicleFeeService($this->vehicle_service);
        }

        return $automation_tax_fee_class->getRate();
    }

    private function getAutomationTaxFeeRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Taxes\\" . $this->state['class'] . "\\AutomationTaxFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $automation_tax_fee_class = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($automation_tax_fee_class, "setVehicleFeeService")) {
            $automation_tax_fee_class->setVehicleFeeService($this->vehicle_service);
        }

        return $automation_tax_fee_class->getRate();
    }

    private function getCasualLatePenaltyFeeTaxRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Taxes\\" . $this->state['class'] . "\\CasualFeeLatePenaltyTaxFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $casual_late_penalty_fee_class = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($casual_late_penalty_fee_class, "setVehicleFeeService")) {
            $casual_late_penalty_fee_class->setVehicleFeeService($this->vehicle_service);
        }

        return $casual_late_penalty_fee_class->getRate();
    }

    private function getDealerLatePenaltyFeeRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Taxes\\" . $this->state['class'] . "\\DealerLatePenaltyFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $dealer_late_penalty_tax_rate = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($dealer_late_penalty_tax_rate, "setVehicleFeeService")) {
            $dealer_late_penalty_tax_rate->setVehicleFeeService($this->vehicle_service);
        }

        return $dealer_late_penalty_tax_rate->getRate();
    }

    private function getDuplicateTitleTaxRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Taxes\\" . $this->state['class'] . "\\DuplicateTitleFeeTaxFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $duplicate_title_fee_class = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($duplicate_title_fee_class, "setVehicleFeeService")) {
            $duplicate_title_fee_class->setVehicleFeeService($this->vehicle_service);
        }

        return $duplicate_title_fee_class->getRate();
    }

    private function getEvenTradeTaxRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Taxes\\" . $this->state['class'] . "\\EvenTradeTaxFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $even_trade_tax_class = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($even_trade_tax_class, "setVehicleFeeService")) {
            $even_trade_tax_class->setVehicleFeeService($this->vehicle_service);
        }

        return $even_trade_tax_class->getRate();
    }

    private function getGifTaxRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Taxes\\" . $this->state['class'] . "\\GiftTaxFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $gift_tax_rate = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($gift_tax_rate, "setVehicleFeeService")) {
            $gift_tax_rate->setVehicleFeeService($this->vehicle_service);
        }

        return $gift_tax_rate->getRate();
    }

    private function getNewResidentTaxRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Taxes\\" . $this->state['class'] . "\\NewResidentTaxFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $new_resident_class = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($new_resident_class, "setVehicleFeeService")) {
            $new_resident_class->setVehicleFeeService($this->vehicle_service);
        }

        return $new_resident_class->getRate();
    }

    /**
     * Other Fees
     */

    private function getPrivateBusHireFeeRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Fees\\" . $this->state['class'] . "\\PrivateBusHireFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $title = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($title, "setVehicleFeeService")) {
            $title->setVehicleFeeService($this->vehicle_service);
        }

        return $title->getRate();
    }

    private function getPrivateBusFeeRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Fees\\" . $this->state['class'] . "\\PrivateBusFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $title = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($title, "setVehicleFeeService")) {
            $title->setVehicleFeeService($this->vehicle_service);
        }

        return $title->getRate();
    }

    private function getAreaFeeRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Fees\\" . $this->state['class'] . "\\AreaFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $title = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($title, "setVehicleFeeService")) {
            $title->setVehicleFeeService($this->vehicle_service);
        }

        return $title->getRate();
    }

    private function getParishFeeRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Fees\\" . $this->state['class'] . "\\ParishFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $title = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($title, "setVehicleFeeService")) {
            $title->setVehicleFeeService($this->vehicle_service);
        }

        return $title->getRate();
    }

    private function getTourismTaxRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Fees\\" . $this->state['class'] . "\\TourismTaxRateService";

        if (!class_exists($class)) {
            return 0;
        }

        $title = new $class($this->county, $this->vehicle['slug']);

        return $title->getRate();
    }

    private function getElectronicFilingFeeRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Fees\\" . $this->state['class'] . "\\ElectronicFilingFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $title = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($title, "setVehicleFeeService")) {
            $title->setVehicleFeeService($this->vehicle_service);
        }

        return $title->getRate();
    }

    private function getConvenienceFeeRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Fees\\" . $this->state['class'] . "\\ConvenienceFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $title = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($title, "setVehicleFeeService")) {
            $title->setVehicleFeeService($this->vehicle_service);
        }

        return $title->getRate();
    }

    private function getProcessingFeeRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Fees\\" . $this->state['class'] . "\\ProcessingFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $title = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($title, "setVehicleFeeService")) {
            $title->setVehicleFeeService($this->vehicle_service);
        }

        return $title->getRate();
    }

    private function getMailFeeRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Fees\\" . $this->state['class'] . "\\MailFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $title = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($title, "setVehicleFeeService")) {
            $title->setVehicleFeeService($this->vehicle_service);
        }

        return $title->getRate();
    }

    /**
     * end of Other Fee
     */
    private function getPostageFeeRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Fees\\" . $this->state['class'] . "\\PostageFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $title = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($title, "setVehicleFeeService")) {
            $title->setVehicleFeeService($this->vehicle_service);
        }

        return $title->getRate();
    }

    private function getDecalFeeRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Fees\\" . $this->state['class'] . "\\DecalFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $title = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($title, "setVehicleFeeService")) {
            $title->setVehicleFeeService($this->vehicle_service);
        }

        return $title->getRate();
    }

    private function getLicenseTransferFeeRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Fees\\" . $this->state['class'] . "\\LicenseTransferFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $title = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($title, "setVehicleFeeService")) {
            $title->setVehicleFeeService($this->vehicle_service);
        }

        return $title->getRate();
    }

    private function getHandlingFeeRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Fees\\" . $this->state['class'] . "\\HandlingFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $title = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($title, "setVehicleFeeService")) {
            $title->setVehicleFeeService($this->vehicle_service);
        }

        return $title->getRate();
    }

    private function getNotaryFeeRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Fees\\" . $this->state['class'] . "\\NotaryFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $title = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($title, "setVehicleFeeService")) {
            $title->setVehicleFeeService($this->vehicle_service);
        }

        return $title->getRate();
    }

    /**
     * end of Other Fees
     */

    private function getDocumentFeeRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Fees\\" . $this->state['class'] . "\\DocumentFeesService";

        if (!class_exists($class)) {
            return 0;
        }

        $document = new $class();

        return $document->getRate();
    }

    /**
     *
     * @param string $county
     * @return float
     */
    private function getTitleFeeRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Fees\\" . $this->state['class'] . "\\TitleFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $title = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($title, "setVehicleFeeService")) {
            $title->setVehicleFeeService($this->vehicle_service);
        }

        return $title->getRate();
    }

    private function getLienFeeRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Fees\\" . $this->state['class'] . "\\LienFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $title = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($title, "setVehicleFeeService")) {
            $title->setVehicleFeeService($this->vehicle_service);
        }

        return $title->getRate();
    }

    private function getSalesTaxRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Taxes\\" . $this->state['class'] . "\\SalesTaxRateService";

        if (!class_exists($class)) {
            return 0;
        }

        $sales = new $class();
        $sales->setVehicleCategory($this->vehicle['slug']);

        return $sales->getRate();
    }

    public function getVendorCompRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Taxes\\" . $this->state['class'] . "\\VendorCompRateService";

        if (!class_exists($class)) {
            return 0;
        }

        $vendor_comp = new $class();

        return $vendor_comp->getRate();

    }

    public function getVitTaxRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Taxes\\" . $this->state['class'] . "\\VitRateService";

        if (!class_exists($class)) {
            return 0;
        }

        $vit = new $class();

        return $vit->getRate();
    }

    private function getTempTagFeeRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Fees\\" . $this->state['class'] . "\\TempTagFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $tag = new $class();

        return $tag->getRate();
    }

    private function getAutomateFeeRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Fees\\" . $this->state['class'] . "\\AutomateFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $automate = new $class();

        return $automate->getRate();
    }


    private function getLocalFeeRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Fees\\" . $this->state['class'] . "\\LocalFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $local = new $class($this->county);

        return $local->getRate();
    }

    private function getTitleCorrectionFeeRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Fees\\" . $this->state['class'] . "\\TitleCorrectionFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $title = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($title, "setVehicleFeeService")) {
            $title->setVehicleFeeService($this->vehicle_service);
        }

        return $title->getRate();
    }

    private function getLicenseFeeRate()
    {
        $class = "Thirty98\\API\\Calculator\\Utils\\Services\\Fees\\" . $this->state['class'] . "\\LicenseFeeService";

        if (!class_exists($class)) {
            return 0;
        }

        $license = new $class($this->county, $this->vehicle['slug']);

        // NOTE: Only used if the fee is based on vehicle type, else do nothing
        if (method_exists($license, "setVehicleFeeService")) {
            $license->setVehicleFeeService($this->vehicle_service);
        }

        return $license->getRate();
    }
}