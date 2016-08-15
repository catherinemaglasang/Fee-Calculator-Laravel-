<?php

namespace Thirty98\API\Louisiana\Contracts;

interface CalculatorRepositoryInterface
{
    /**
     * Get sales tax rate.
     * @return float
     */
    public function getSalesTaxRate();

    /**
     * Get inspection fee.
     * @return float
     */
    public function getVehInsFee();

    /**
     * Get notary fee.
     * @return float
     */
    public function getNotaryFee();

    /**
     * Get convenience fee.
     * @return float
     */
    public function getConvenienceFee();

    /**
     * Get processing fee.
     * @return float
     */
    public function getProcessingFee();

    /**
     * Get mail fee.
     * @return float
     */
    public function getMailFee();

    /**
     * Get service fee.
     * @return float
     */
    public function getServiceFee();

    /**
     * Get title fee.
     * @return float
     */
    public function getTitleFee();

    /**
     * Get title correction fee.
     * @return float
     */
    public function getTitleCorrectionFee();

    /**
     * Get handling fee.
     * @return float
     */
    public function getHandlingFee();

    /**
     * Get duplicate title fee.
     * @return float
     */
    public function getDupTitleFee();

    /**
     * Get reg fee.
     * @return float
     */
    public function getRegFee();

    /**
     * Get reciprocirt fee.
     * @return float
     */
    public function getReciprocity();

    /**
     * Get reg duplicated fee fee.
     * @return float
     */
    public function getRegDupFee();

    /**
     * Get license transfer fee.
     * @return float
     */
    public function getLicenseTrnsfrFee();

    /**
     * Get license fee.
     * @return float
     */
    public function getLicenseFee();

    /**
     * Get get duplicate fee.
     * @return float
     */
    public function getDupPlateFee();

    /**
     * Get person plate fee.
     * @return float
     */
    public function getPersnlPlateFee();

    /**
     * Get person plate admin fee.
     * @return float
     */
    public function getPersnlPlateAdminFee();

    /**
     * Get person handling fee.
     * @return float
     */
    public function getPersnlPlateHandlingFee();

    /**
     * Get spec plate fee.
     * @return float
     */
    public function getSpecPlateFee();

    /**
     * Get mortgage fee.
     * @return float
     */
    public function getMortgageFee();

    /**
     * Get license penalty fee.
     * @return float
     */
    public function getLicensePenaltyFee();

    /**
     * Get license dup fee.
     * @return float
     */
     public function getLicenseDupFee();

}
#END OF PHP FILE