<?php

namespace Thirty98\API\Louisiana\Entities\Calculators;



use Thirty98\API\General\Entities\Calculator;
use Thirty98\API\General\Entities\CalculatorResponse;
use Thirty98\API\Louisiana\Entities\Repositories\TrailerBoatTrailerRepository;

class TrailerBoatTrailer extends Calculator
{
    const STATE_CODE = 'LA';

    private $fees;
    private $tax;
    private $penalties;

    /**
     * Category-Type calculator.
     * This do the calculation depending on the category and type given.
     *
     * @return CalculatorResponse
     */
    public function calculate()
    {
        $this->calculateFees(new TrailerBoatTrailerRepository($this->calculatorInput->getRequest()));

        return new CalculatorResponse($this->fees, $this->tax, $this->penalties);
    }

    /**
     * Calculate all fees.
     *
     * @param BusCityBusRepository $repositories
     */
    private function calculateFees(TrailerBoatTrailerRepository $repositories)
    {
        $this->fees = [
            'VEH_INSP_FEE' => $repositories->getVehInsFee(),
            'SERVICE_FEE' => $repositories->getServiceFee(),
            'TITLE_FEE' => $repositories->getTitleFee(),
            'TITLE_CORRECTION_FEE' => $repositories->getTitleCorrectionFee(),
            'HANDLING_FEE' => $repositories->getHandlingFee(),
            'DUP_TITLE_FEE' => $repositories->getDupTitleFee(),
            'REG_FEE ' => $repositories->getRegFee(),
            'REG_DUP_FEE ' => $repositories->getRegDupFee(),
            'LICENSE_TRNSFR_FEE' => $repositories->getLicenseTrnsfrFee(),
            'DUP_PLATE_FEE' => $repositories->getDupPlateFee(),
            'PERSNL_PLATE_FEE' => $repositories->getPersnlPlateFee(),
            'PERSL_PLATE_ADMIN_FEE' => $repositories->getPersnlPlateAdminFee(),
            'PERSL_PLATE_HANDLING_FEE' => $repositories->getPersnlPlateHandlingFee(),
            'SPEC_PLATE_FEE' => '',
            'MORTGAGE_FEE' => $repositories->getMortgageFee(),
            'LICENSE_PNLTY_FEE' => $repositories->getLicensePenaltyFee(),
            'LICENSE_DUP_FEE' => $repositories->getLicenseDupFee(),
            'NOTARY_FEE' => $repositories->getNotaryFee(),
            'PROCESSING_FEE' => $repositories->getProcessingFee(),
            'CONVENIENCE_FEE' => $repositories->getConvenienceFee(),
            'MAIL_FEE' => $repositories->getMailFee(),
            'LICENSE_FEE' => $repositories->getLicenseFee()
        ];

        // By doc header (Louisiana)
        $this->tax = [
            'SALES_TAX_RATE' => $repositories->getSalesTaxRate(),
            'RECIPROCITY' => 'Full'
        ];

        $this->penalties = [

        ];
    }
}

#END OF PHP FILE<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/3/2015
 * Time: 6:57 PM
 */