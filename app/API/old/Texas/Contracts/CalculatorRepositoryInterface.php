<?php

namespace Thirty98\API\Texas\Contracts;

interface CalculatorRepositoryInterface
{
    /**
     * Get fee by state.
     *
     * @param string $feeName
     * @return mixed
     */
    public function getFeeByState($feeName = '');

    /**
     * Get sales tax  penalty.
     *
     * @return float
     */
    public function getSalesTaxPenalty();

    /**
     * Get sales tax rate.
     *
     * @return float
     */
    public function salesTaxRate();

    /**
     * Get taxable value.
     *
     * @return float
     */
    public function taxableValue();

    /**
     * Get EMISSION_FEE.
     *
     * @return int|float
     */
    public function getEmissionFee();

    /**
     * Get title fee.
     *
     * @param string $countyName
     * @return null
     */
    public function getTitleFee($countyName = '');

    /**
     * Get DUP_TITLE_FEE
     *
     * @return float|null
     */
    public function getDupTitleFee();

    /**
     * Get DLR_LT_PNLTY.
     *
     * @return int
     */
    public function getDealerLatePenalty();

    /**
     * Get CASUAL_LT_PNLTY
     *
     * @return float
     */
    public function getCasualtyLatePenalty();

    /**
     * Get LOCAL_FEE.
     *
     * @return float
     */
    public function getLocalFee();

    /**
     * Get FARM_RANCH_EXEMPT.
     *
     * @return float
     */
    public function getFarmRanchExempt();

    /**
     * Get REG_DPS_FEE.
     *
     * @return float|null
     */
    public function getRegDpsFee();

    /**
     * Get AUIOMAT_FEE.
     *
     * @return float|null
     */
    public function getAutomatFee();

    /**
     * Get TEMP_TAG_FEE.
     *
     * @return float|null
     */
    public function getTempTagFee();

    /**
     * Get DIESEL_FEE.
     *
     * @return float|null
     */
    public function getDieselFee();

    /**
     * Get EMM_SURCHARGE.
     *
     * @return float
     */
    public function getEmmSurcharge();

    /**
     * Get YNG_FRMR_FEE.
     *
     * @return float
     */
    public function getYngFrmrFee();

    /**
     * Get PLATE_FEE.
     *
     * @return float
     */
    public function getPlateFee();

    /**
     * Get REG_FEE.
     *
     * @param string $vin
     * @return float
     */
    public function getRegFee($vin = '');

    /**
     * Get REG_OPTIONS.
     *
     * @return float
     */
    public function getRegOptions();

    /**
     * Get VIT_TAX.
     *
     * @return float
     */
    public function getVitTax();

    /**
     * Get INSP_FEE.
     *
     * @return float
     */
    public function getInspFee();
}
#END OF PHP FILE