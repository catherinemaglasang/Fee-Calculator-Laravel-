<?php

namespace Thirty98\API\Texas\Entities\Calculators;

use Thirty98\API\General\Entities\ApiException;
use Thirty98\API\General\Entities\Calculator;
use Thirty98\API\General\Entities\CalculatorResponse;
use Thirty98\API\Texas\Entities\Repositories\MotorcycleOffRoadMotorcycleRepository;

class MotorcycleOffRoadMotorcycle extends Calculator
{
    const STATE_CODE = 'TX';

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
        try {

            $this->calculateFees(new MotorcycleOffRoadMotorcycleRepository($this->calculatorInput->getRequest()));
            return new CalculatorResponse($this->fees, $this->tax, $this->penalties);

        } catch (ApiException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw new ApiException(ApiResponse::CODE_BAD_REQUEST, $e->getMessage(), null, $e->getCode());
        }
    }

    /**
     * Calculate all fees.
     *
     * @param MotorcycleOffRoadMotorcycleRepository $repository
     */
    private function calculateFees(MotorcycleOffRoadMotorcycleRepository $repository)
    {
        $this->fees = [
            'EMISSION_FEE' => $repository->getEmissionFee(),
            'TITLE_FEE' => $repository->getTitleFee($this->calculatorInput->getRequest()->get('county_name')),
            'DUP_TITLE_FEE' => $repository->getDupTitleFee(),
            'LOCAL_FEE' => $repository->getLocalFee(),
            'FARM_RANCH_EXEMPT' => $repository->getYngFrmrFee(),
            'REG_FEE' => $repository->getRegFee($this->calculatorInput->getRequest()->get('vin_pattern')),
            'REG_OPTIONS' => $repository->getRegOptions(),
            'REG_DPS_FEE' => $repository->getRegDpsFee(),
            'AUTOMAT_FEE' => $repository->getAutomatFee(),
            'TEMP_TAG_FEE' => $repository->getTempTagFee(),
            'DIESEL_FEE' => $repository->getDieselFee(),
            'EMM_SURCHARGE' => $repository->getEmmSurcharge(),
            'YNG_FRMR_FEE' =>  $repository->getYngFrmrFee(),
            'VIT_TAX' => $repository->getVitTax(),
            'INSP_FEE' => $repository->getInspFee(),
            'PLATE_FEE' => 0, // Not yet implemented.
        ];

        $this->tax = [
            'SALES_TAX_RATE' => $repository->salesTaxRate(),
            'NEW_RESID_TAX' => $repository->getFeeByState('NEW_RESID_TAX'),
            'GIFT_TAX' => $repository->getFeeByState('GIFT_TAX'),
            'EVEN_TRADE_TAX' => $repository->getFeeByState('EVEN_TRADE_TAX'),
        ];

        $this->penalties = [
            'SALES_TAX_LT_PNLTY' => $repository->getSalesTaxPenalty(),
            'DLR_LT_PNLTY' => $repository->getDealerLatePenalty(),
            'CASUAL_LT_PNLTY' => $repository->getCasualtyLatePenalty()
        ];
    }
}

#END OF PHP FILE