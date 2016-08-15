<?php

namespace Thirty98\API\Calculator\Utils\Services\StateFees\Louisiana;

use Thirty98\API\Calculator\Utils\Contracts\StateFees\SalesTaxServiceInterface;
use Thirty98\API\Calculator\Utils\Services\StateFees\AbstractSalesTaxService;
use Thirty98\Models\LACityParishSalesTax;

class SalesTaxService extends AbstractSalesTaxService implements SalesTaxServiceInterface
{
    protected $state = 'LA';
    protected $state_rates = [
        'State Sales Tax Rate' => 0.039700,
        'State Vendors Comp Rate' => 0.009350,
        'Tourism Tax Rate' => 0.000300,
        'Tourism Vendors Comp' => 0.009350
    ];
    protected $fee_service_model;

    public function __construct($details)
    {
        parent::__construct($details);

        $this->setParishCityCalculationConstants();
        $this->getSalesTax();

    }

    public function setParishCityCalculationConstants()
    {
        $city = $this->details['city'];
        $county = $this->details['county'];
        $rates = [];

        if($city == "none") {
            // ->take(5) to limit
            // Join the city and parish. limit 1 and get rate
            $rates = LACityParishSalesTax::join('cities', 'cities.id', '=', 'city_id')
                ->join('counties', 'cities.county_id', '=', 'counties.id')
                ->where('counties.slug', $county)
                ->select('area_tax', 'area_vendor_desc', 'parish_tax', 'parish_vendor_desc')
                ->first()->toArray();

            $this->state_rates['Area Tax'] = 0;
            $this->state_rates['Area Desc'] = 0;

            $this->state_rates['Parish Tax'] = $rates['parish_tax'];
            $this->state_rates['Parish Desc'] = $rates['parish_vendor_desc'];
        } else {
            $rates = LACityParishSalesTax::join('cities', 'cities.id', '=', 'city_id')
                ->join('counties', 'cities.county_id', '=', 'counties.id')
                ->where('cities.slug', $city)
                ->where('counties.slug', $county)
                ->select('area_tax', 'area_vendor_desc', 'parish_tax', 'parish_vendor_desc')
                ->first()->toArray();

            $this->state_rates['Area Tax'] = $rates['area_tax'];
            $this->state_rates['Area Desc'] = $rates['area_vendor_desc'];

            $this->state_rates['Parish Tax'] = $rates['parish_tax'];
            $this->state_rates['Parish Desc'] = $rates['parish_vendor_desc'];
        }

        /**
         * Modify attribute
         * $this->state_rates
         */


        /*var_dump($rates);
        die('GGs');*/
    }

    public final function getSalesTaxes()
    {

    }

    protected function round_basic($int)
    {
        return round($int, 6);
    }

    protected function getAreaValidation()
    {

    }

    protected function getSalesTaxLatePenalty()
    {

    }

    public function getSalesTax()
    {
        $sales_tax_breakdown = [
            'Sales Tax' => [
                'Total Tax' => $this->getTotalSalesTax(),
                'State Sales Tax' => $this->getStateSalesTax(),
                'State Vendors Comp' => $this->getStateVendorsComp(),
                'State Net Sales Tax' => $this->getNetStateSalesTax(),
                'State Tax Penalty' => $this->getStateTaxPenalty(),
                'State Interest' => $this->getStateInterest(),
            ],

            'Tourism' => [
                'Tourism Tax' => $this->getTourismTax(),
                'Tourism Vendors Comp Tax' => $this->getTourismVendorsComp(),
                'Net Tourism Tax' => $this->getNetTourismTax(),
                'Tourism Penalty' => $this->getTourismTaxPenalty(),
                'Tourism Interest' => $this->getTourismInterest()
            ],

            'Area Tax' => [
                'Municipality Sales Tax' => $this->getMunicipalitySalesTax(),
                'Municipality Vendors Comp' => $this->getMunicipalityVendorsComp(),
                'Net Municipality Sales Tax' => $this->getNetMunicipalitySalesTax(),
                'Municipality Sales Tax Penalty' => $this->getMunicipalitySalesTaxPenalty(),
                'Municipality Sales Tax Interest' => $this->getMunicipalitySalesTaxInterest(),
            ],

            'Parish Tax' => [
                'Parish Sales Tax' => $this->getParishSalesTax(),
                'Parish Vendors Comp' => $this->getParishVendorsComp(),
                'Net Parish Sales Tax' => $this->getNetParishSalesTax(),
                'Parish Sales Tax Penalty' => $this->getParishSalesTaxPenalty(),
                'Parish Sales Tax Interest' => $this->getParishSalesTaxInterest(),

            ],

            'City and Parish Rates' => [
                'Area Tax' => $this->state_rates['Area Tax'],
                'Area Desc' => $this->state_rates['Area Desc'],
                'Parish Tax' => $this->state_rates['Parish Tax'],
                'Parish Vendor Desc' => $this->state_rates['Parish Desc'],
            ]
        ];

        return [
            'Sales Tax Breakdown' => $sales_tax_breakdown
        ];
    }

    protected function getTotalSalesTax()
    {
        return
            $this->getNetStateSalesTax() +
            $this->getSalesTaxLatePenalty() +
            $this->getParishSalesTaxInterest() +

            $this->getNetTourismTax() +
            $this->getTourismTaxPenalty() +
            $this->getTourismInterest() +

            $this->getNetMunicipalitySalesTax() +
            $this->getMunicipalitySalesTaxPenalty() +
            $this->getMunicipalitySalesTaxInterest() +

            $this->getNetParishSalesTax() +
            $this->getParishSalesTaxPenalty() +
            $this->getParishSalesTaxInterest();
    }

    /**
     * New Sales Tax Methods.
     */

    /**
     * Constants
     *  'State Sales Tax Rate'
     *  'State Vendors Comp Rate'
     *  'Tourism Tax Rate'
     *  'Tourism Vendors Comp'
     */

    /**
     * State Sales Tax.
     */
    protected function getStateSalesTax()
    {
        return $this->details['taxable_value'] * $this->state_rates['State Sales Tax Rate'];
    }

    protected function getStateVendorsComp()
    {
        return $this->getStateSalesTax() * $this->state_rates['State Vendors Comp Rate'];
    }

    protected function getNetStateSalesTax()
    {
        return $this->getStateSalesTax() - $this->getStateVendorsComp();
    }

    protected function getStateTaxPenalty()
    {
        $current_date = strtotime(date('Y-m-d'));
        $date_of_sale = strtotime($this->details['date_of_sale']);

        $days_elapsed = ceil(abs($date_of_sale - $current_date) / 86400);

        // If after 40th calendar day after date of sale.
        if ($days_elapsed >= 40) {


            // Limit the penalty to 5 months only.
            if ($days_elapsed > 150) {
                $days_elapsed = 150;
            }

            if($days_elapsed < 0) {
                $days_elapsed = 0;
            }

            $months_elapsed = (int)($days_elapsed / 30);

            // Penalty is 5 percent multiplied by months elapsed.
            $penalty = (.05 * $this->getStateSalesTax()) * $months_elapsed;

            return $penalty;
        } else {
            return 0;
        }
    }

    protected function getStateInterest()
    {
        $date_of_sale = $this->details['date_of_sale'];

        $current_date = strtotime(date('Y-m-d'));
        $date_of_sale = strtotime($date_of_sale);

        $days_elapsed = ceil(abs($date_of_sale - $current_date) / 86400);

        // If after 40th calendar day after date of sale.
        if ($days_elapsed > 0) {
            $interest = ($this->getStateSalesTax() * .0125) * $days_elapsed;

            return $interest;
        } else {
            return 0;
        }
    }

    /**
     * Tourism Tax.
     */
    protected function getTourismTax()
    {
        return $this->details['taxable_value'] * $this->state_rates['Tourism Tax Rate'];
    }

    protected function getTourismVendorsComp()
    {
        return $this->getTourismTax() * $this->state_rates['Tourism Vendors Comp'];
    }

    protected function getNetTourismTax()
    {
        return $this->getTourismTax() - $this->getTourismVendorsComp();
    }

    protected function getTourismTaxPenalty()
    {
        $current_date = strtotime(date('Y-m-d'));
        $date_of_sale = strtotime($this->details['date_of_sale']);

        $days_elapsed = ceil(abs($date_of_sale - $current_date) / 86400);

        // If after 40th calendar day after date of sale.
        if ($days_elapsed >= 40) {


            // Limit the penalty to 5 months only.
            if ($days_elapsed > 150) {
                $days_elapsed = 150;
            }

            if($days_elapsed < 0) {
                $days_elapsed = 0;
            }

            $months_elapsed = (int)($days_elapsed / 30);

            // Penalty is 5 percent multiplied by months elapsed.
            $penalty = (.05 * $this->getTourismTax()) * $months_elapsed;

            return $penalty;
        } else {
            return 0;
        }
    }

    protected function getTourismInterest()
    {
        $date_of_sale = $this->details['date_of_sale'];

        $current_date = strtotime(date('Y-m-d'));
        $date_of_sale = strtotime($date_of_sale);

        $days_elapsed = ceil(abs($date_of_sale - $current_date) / 86400);

        // If after 40th calendar day after date of sale.
        if ($days_elapsed > 0) {
            $interest = ($this->getTourismTax() * .0125) * $days_elapsed;

            return $interest;
        } else {
            return 0;
        }
    }

    /**
     * Area Tax.
     */
    protected function getMunicipalitySalesTax()
    {
        return $this->details['taxable_value'] * $this->state_rates['Area Tax'];
    }

    protected function getMunicipalityVendorsComp()
    {
        return $this->getMunicipalitySalesTax() * $this->state_rates['Area Desc'];
    }

    protected function getNetMunicipalitySalesTax()
    {
        return $this->getMunicipalitySalesTax() - $this->getMunicipalityVendorsComp();
    }

    protected function getMunicipalitySalesTaxPenalty()
    {
        $current_date = strtotime(date('Y-m-d'));
        $date_of_sale = strtotime($this->details['date_of_sale']);

        $days_elapsed = ceil(abs($date_of_sale - $current_date) / 86400);

        // If after 40th calendar day after date of sale.
        if ($days_elapsed >= 40) {


            // Limit the penalty to 5 months only.
            if ($days_elapsed > 150) {
                $days_elapsed = 150;
            }

            if($days_elapsed < 0) {
                $days_elapsed = 0;
            }

            $months_elapsed = (int)($days_elapsed / 30);

            // Penalty is 5 percent multiplied by months elapsed.
            $penalty = (.05 * $this->getMunicipalitySalesTax()) * $months_elapsed;

            return $penalty;
        } else {
            return 0;
        }
    }

    protected function getMunicipalitySalesTaxInterest()
    {
        $date_of_sale = $this->details['date_of_sale'];

        $current_date = strtotime(date('Y-m-d'));
        $date_of_sale = strtotime($date_of_sale);

        $days_elapsed = ceil(abs($date_of_sale - $current_date) / 86400);

        // If after 40th calendar day after date of sale.
        if ($days_elapsed > 0) {
            $interest = ($this->getMunicipalitySalesTax() * .0125) * $days_elapsed;

            return $interest;
        } else {
            return 0;
        }
    }

    /**
     * Parish Tax.
     */
    protected function getParishSalesTax()
    {
        return $this->details['taxable_value'] * $this->state_rates['Parish Tax'];
    }

    protected function getParishVendorsComp()
    {
        return $this->getParishSalesTax() * $this->state_rates['Parish Desc'];
    }

    protected function getNetParishSalesTax()
    {
        return $this->getParishSalesTax() - $this->getParishVendorsComp();
    }

    protected function getParishSalesTaxPenalty()
    {
        $current_date = strtotime(date('Y-m-d'));
        $date_of_sale = strtotime($this->details['date_of_sale']);

        $days_elapsed = ceil(abs($date_of_sale - $current_date) / 86400);

        // If after 40th calendar day after date of sale.
        if ($days_elapsed >= 40) {


            // Limit the penalty to 5 months only.
            if ($days_elapsed > 150) {
                $days_elapsed = 150;
            }

            if($days_elapsed < 0) {
                $days_elapsed = 0;
            }

            $months_elapsed = (int)($days_elapsed / 30);

            // Penalty is 5 percent multiplied by months elapsed.
            $penalty = (.05 * $this->getParishSalesTax()) * $months_elapsed;

            return $penalty;
        } else {
            return 0;
        }
    }

    protected function getParishSalesTaxInterest()
    {
        $date_of_sale = $this->details['date_of_sale'];

        $current_date = strtotime(date('Y-m-d'));
        $date_of_sale = strtotime($date_of_sale);

        $days_elapsed = ceil(abs($date_of_sale - $current_date) / 86400);

        // If after 40th calendar day after date of sale.
        if ($days_elapsed > 0) {
            $interest = ($this->getParishSalesTax() * .0125) * $days_elapsed;

            return $interest;
        } else {
            return 0;
        }
    }
}
