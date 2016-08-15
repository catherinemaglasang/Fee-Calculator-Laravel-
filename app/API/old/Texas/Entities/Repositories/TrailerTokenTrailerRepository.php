<?php

namespace Thirty98\API\Texas\Entities\Repositories;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Thirty98\API\Texas\Contracts\CalculatorRepositoryInterface;
use Thirty98\API\General\Entities\ApiException;
use Thirty98\API\General\Entities\ApiResponse;
use Thirty98\API\General\Entities\Helper;
use Thirty98\API\General\Models\Category;
use Thirty98\API\General\Models\County;
use Thirty98\API\General\Models\State;
use Thirty98\API\Texas\Models\Inspfee;

class TrailerTokenTrailerRepository implements CalculatorRepositoryInterface
{
    const STATE_CODE = 'TX';
    const CATEGORY = 'trailer';
    const TYPE = 'token-trailer';

    private $request;
    private $state;
    private $categoryTypeId;

    public function __construct(Request $request)
    {
        $this->request = $request;

        // Get state.
        $this->state = State::where('code', self::STATE_CODE)->first();

        // Get category type id.
        $categoryType = Category::where('name', self::CATEGORY)->first()->types()->where('name', self::TYPE)->first();
        $this->categoryTypeId = $categoryType->pivot->id;
    }

    /**
     * Get Fee by State.
     *
     * @param string $stateCode
     * @param string $feeName
     * @return float|null
     */
    public function getFeeByState($feeName = '')
    {
        $fee = $this->state->fees()->where('name', $feeName)->first();

        if (!$fee) {
            return null;
        }

        return floatval($fee->pivot->amount);
    }

    /**
     * Get sales tax  penalty.
     *
     * @param Request $request
     * @return float|int
     */
    public function getSalesTaxPenalty()
    {
        $dateNow = Carbon::now();
        $dateOfSale = $this->request->get('sale_date', $dateNow->toDateString());

        list($year, $month, $day) = explode('-', $dateOfSale);
        $dateOfSale = Carbon::createFromDate($year, $month, $day);

        $daysPast = $dateOfSale->diffInDays($dateNow);

        if ($daysPast >= 30 AND $daysPast <= 60) {
            return $this->salesTaxRate() * 0.05;
        }

        if ($daysPast > 60) {
            return $this->salesTaxRate() * 0.10;
        }

        return floatval(0);
    }

    /**
     * Get sales tax rate.
     *
     * @return mixed
     */
    public function salesTaxRate()
    {
        // TODO: GET_AVALARA (Sales Tax Rate)      NON-MOTOR VEHICLE
        return 0;
    }

    /**
     * Get taxable value.
     *
     * @return mixed
     */
    public function taxableValue()
    {
        if ($this->request->get('taxable_value', 0) < 0) {
            throw new ApiException(
                ApiResponse::CODE_BAD_REQUEST,
                'Taxable value must not be negative.',
                null,
                ApiResponse::HTTPCODE_BAD_REQUEST
            );
        }

        return $this->request->get('taxable_value');
    }

    /**
     * Get EMISSION_FEE.
     *
     * @return int|mixed
     */
    public function getEmissionFee()
    {
        $fuelType = strtoupper($this->request->get('fuel_type'));
        $gvw = $this->request->get('gvw', 0);
        $modelYear = $this->request->get('model_year', 0);

        $result = 0;

        if ($fuelType == 'DIESEL' AND $gvw >= 14000) {
            if ($modelYear <= 1996) {
                $result = $this->taxableValue() * 0.025;
            } else {
                if ($modelYear > 1996) {
                    $result = $this->taxableValue() * 0.01;
                }
            }
        }

        return floatval($result);
    }

    /**
     * Get title fee.
     *
     * @param string $countyName
     * @return null
     */
    public function getTitleFee($countyName = '')
    {
        $county = County::where('name', $countyName)->first();

        if (!$county) {
            return null;
        }

        $fee = $county->fees()->where('name', 'TITLE_FEE')->first();

        return floatval($fee->pivot->amount);
    }

    /**
     * Get DUP_TITLE_FEE
     *
     * @return float|null
     */
    public function getDupTitleFee()
    {
        $fee = $this->state->fees()
            ->where('name', 'DUP_TITLE_FEE')
            ->where('category_type_id', $this->categoryTypeId)
            ->first();

        if (!$fee) {
            return null;
        }

        return floatval($fee->pivot->amount);
    }

    /**
     * Get DLR_LT_PNLTY.
     *
     * @return int
     */
    public function getDealerLatePenalty()
    {
        $dateNow = Carbon::now();
        $dateOfSale = $this->request->get('sale_date', $dateNow->toDateString());

        list($year, $month, $day) = explode('-', $dateOfSale);
        $dateOfSale = Carbon::createFromDate($year, $month, $day);

        $daysPast = $dateOfSale->diffInDays($dateNow);

        if ($daysPast > 30) {
            return 10;
        }

        return 0;
    }

    /**
     * Get CASUAL_LT_PNLTY
     *
     * @return float
     */
    public function getCasualtyLatePenalty()
    {
        return floatval(30);
    }

    /**
     * Get LOCAL_FEE.
     *
     * @return float|null
     */
    public function getLocalFee()
    {
        $countyName = $this->request->get('county_name');

        $county = County::where('name', $countyName)->first();

        if (!$county) {
            return null;
        }

        $fee = $county->fees()->where('name', 'LOCAL_FEE')->first();

        return floatval($fee->pivot->amount);
    }

    /**
     * Get FARM_RANCH_EXEMPT.
     *
     * @return float
     */
    public function getFarmRanchExempt()
    {
        return 0;
    }

    /**
     * Get REG_DPS_FEE.
     *
     * @return float|null
     */
    public function getRegDpsFee()
    {
        return 0;
    }

    /**
     * Get AUIOMAT_FEE.
     *
     * @return float|null
     */
    public function getAutomatFee()
    {
        return 0;
    }

    /**
     * Get TEMP_TAG_FEE.
     *
     * @return float|null
     */
    public function getTempTagFee()
    {
        $fee = $this->state->fees()
            ->where('name', 'TEMP_TAG_FEE')
            ->where('category_type_id', $this->categoryTypeId)
            ->first();

        if (!$fee) {
            return null;
        }

        return floatval($fee->pivot->amount);
    }

    /**
     * Get DIESEL_FEE.
     *
     * @return float|null
     */
    public function getDieselFee()
    {
        return 0;
    }

    /**
     * Get EMM_SURCHARGE.
     *
     * @return float
     */
    public function getEmmSurcharge()
    {
        return 0;
    }

    /**
     * Get YNG_FRMR_FEE.
     *
     * @return null
     */
    public function getYngFrmrFee()
    {
        return 0;
    }

    /**
     * Get PLATE_FEE.
     *
     * @return mixed
     */
    public function getPlateFee()
    {
        // TODO: Implement getPlateFee() method.
    }

    /**
     *  Get REG_FEE.
     *
     * @param string $vin
     * @return float
     * @throws ApiException
     */
    public function getRegFee($vin = '')
    {
        // Get VIN Pattern.
        $vinPattern = $this->getVinPatternRecord($vin);

        // Get GVW and add 100.
        $gvwr = Helper::roundUpToHundreds($vinPattern->gross_vehicle_weight_rating) + 100;

        if ($gvwr <= 6000) {
            throw new ApiException(
                ApiResponse::CODE_BAD_REQUEST,
                'GVWR must be > 6000 lbs.',
                null,
                ApiResponse::HTTPCODE_BAD_REQUEST
            );
        }

        return floatval(15);
    }

    /**
     * Get VIN pattern.
     *
     * @param $vin
     * @return mixed
     * @throws ApiException
     */
    private function getVinPatternRecord($vin)
    {
        $vinPattern = DB::connection('mysql_mytrs')->table('DataOneVINPatterns')->where('VIN_PATTERN', $vin)->first();

        if (!$vinPattern) {
            throw new ApiException(
                ApiResponse::CODE_NOT_FOUND,
                'VIN Pattern not found. Please try a valid one.',
                null,
                ApiResponse::HTTPCODE_NOT_FOUND
            );
        }
        return $vinPattern;
    }

    /**
     * Get REG_OPTIONS.
     *
     * @return mixed
     */
    public function getRegOptions()
    {
        return 0;
    }

    /**
     * Get VIT_TAX.
     *
     * @return mixed
     */
    public function getVitTax()
    {
        $vitTaxRate = $this->request->get('vit_tax_rate', 0);
        $taxableValue = $this->taxableValue();
        $freight = $this->request->get('freight', 0);
        $tradeValue = $this->request->get('trade_value', 0);

        return $vitTaxRate * ($taxableValue + $freight + $tradeValue);
    }

    /**
     * Get INSP_FEE.
     *
     * @return float
     */
    public function getInspFee()
    {
        // Get parameters.
        $isNewVehicle = $this->request->get('is_new_vehicle', null);
        $countyName = $this->request->get('county_name');

        // If is_new_vehicle is not passed, return null.
        if (is_null($isNewVehicle)) {
            return null;
        }

        // Get county.
        $countyCode = strtoupper(str_replace(' ', '_', $countyName));
        $county = County::where('code', $countyCode)->first();
        if (!$county) {
            return null;
        }

        // If no INSP_FEE found, return 0 (no fee)
        $inspFee = Inspfee::where('county_id', $county->id)->first();
        if (!$inspFee) {
            return 0;
        }

        // Get appropriate INSP_FEE.
        if (boolval($isNewVehicle)) {
            return floatval($inspFee->NEW_MV_2YR);
        } else {

            // TODO: Look for EMM_INSP_FEE first, before assuming USED_MV_1YR as the fee.
            return floatval($inspFee->USED_MV_1YR);
        }
    }
}
#END OF PHP FILE