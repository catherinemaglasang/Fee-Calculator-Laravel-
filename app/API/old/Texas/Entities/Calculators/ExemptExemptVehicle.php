<?php

namespace Thirty98\API\Texas\Entities\Calculators;

use Thirty98\API\General\Entities\Calculator;
use Thirty98\API\General\Entities\CalculatorResponse;
use Thirty98\API\Texas\Entities\Repositories\ExemptExemptVehicleRepository;

class ExemptExemptVehicle extends Calculator
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
        $this->calculateFees(new ExemptExemptVehicleRepository($this->calculatorInput->getRequest()));

        return new CalculatorResponse($this->fees, $this->tax, $this->penalties);
    }

    /**
     * Calculate all fees.
     *
     * @param ExemptExemptVehicleRepository $repository
     */
    private function calculateFees(ExemptExemptVehicleRepository $repository)
    {
        $this->fees = [
            'EMISSION_FEE' => 0,
            'TITLE_FEE' => 0,
            'DUP_TITLE_FEE' => 0,
            'LOCAL_FEE' => 0,
            'FARM_RANCH_EXEMPT' => 0,
            'REG_FEE' => 0,
            'REG_OPTIONS' => 0,
            'REG_DPS_FEE' => 0,
            'AUTOMAT_FEE' => 0,
            'TEMP_TAG_FEE' => 0,
            'DIESEL_FEE' => 0,
            'EMM_SURCHARGE' => 0,
            'YNG_FRMR_FEE' => 0,
            'VIT_TAX' => 0,
            'INSP_FEE' => 0,
            'PLATE_FEE' => 0
        ];

        $this->tax = [
            'SALES_TAX_RATE' => 0,
            'NEW_RESID_TAX' => 0,
            'GIFT_TAX' => 0,
            'EVEN_TRADE_TAX' => 0,
        ];

        $this->penalties = [
            'SALES_TAX_LT_PNLTY' => 0,
            'DLR_LT_PNLTY' => 0,
            'CASUAL_LT_PNLTY' => 0
        ];
    }
}

#END OF PHP FILE