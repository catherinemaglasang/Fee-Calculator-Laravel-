<?php

namespace Thirty98\Http\Controllers\Calculations;

use Thirty98\Http\Requests\Validators\DelawareRequestValidator;
use Thirty98\Http\Controllers\Controller;
use Auth;

class DelawareCalculationsController extends Controller
{
    public function mainCalculations(DelawareRequestValidator $request)
    {
        $input = $request->all();

        $data = [
            'defaults' => [
                'model_year'        => $input['model_year'],
                'price'             => $input['price'],
                'trade_in_value'    => $input['trade_in_value'],
                'no_of_years'       => $input['no_of_years'],
                'lender_yes'        => $input['lender'] ? true : false,
                'lender_no'         => $input['lender'] ? false : true,
                'transfer_yes'      => $input['transfer'] ? true : false,
                'transfer_no'       => $input['transfer'] ? false : true
            ],
            'model_year' => [
                '1' => '1 year',
                '2' => '2 years'
            ],
            'no_of_years' => [
                '1' => '1 year',
                '2' => '2 years',
                '3' => '3 years',
                '4' => '4 years',
                '5' => '5 years'
            ]
        ];
        
        //Use Middleware as much as possible
        if (!Auth::check()) {
            return redirect('login')->with('error', 'Please login first!');
        }
        
        
        if( !$this->validatePrices($input) ) {

            flash('error', 'Trade in value should not be larger than sales price!');

            return view('dashboard.content.calculator.delaware', compact('data'));
        }
        
        $data['results'] = $this->doTheMath($input);

        flash('success','Calculation Success check results at the result panel.');

        return view('dashboard.content.calculator.delaware', compact('data'));
    }

    private function validatePrices($input)
    {
        if($input['price'] > $input['trade_in_value'])
            return true;

        return false;
    }

    private function doTheMath($input)
    {
        $results = [
            'doc_fee'   => $this->docFeeMath($input),
            'year_fee'  => $this->yearFeeMath($input),
            'lender'    => $this->lenderMath($input),
            'transfer'  => $this->transferMath($input)
        ];

        $results['total'] = $this->totalMath($results);

        return $this->formatResults($results);
    }

    private function priceMath($input)
    {
        return (float)$result = $input['price'] - $input['trade_in_value'];
    }

    private function docFeeMath($input)
    {
        $result = (float) $this->priceMath($input) * .0375;

        if($result >= 8)
            return ceil($result);

        return 8;
    }

    // Calculates results for no. of registration years

    private function yearFeeMath($input)
    {
        return (float)$result = (int)$input['no_of_years'] * 40;
    }

    // Calculate result for lender option
    private function lenderMath($input)
    {
        if ( $input['lender'] )
            return 35;

        return 25; 
    }

    // Calculates result for transfer cost
    private function transferMath($input)
    {
        if($input['transfer'])
            return 10;

        return 0;
    }

    // Calculates total cost
    private function totalMath($results)
    {
        $total = (float) 0.00;

        foreach ($results as $key => $value) {
            $total += $value;
        }

        return $total;
    }

    // Format numbers with decinal anf separators
    private function formatResults($results)
    {
        foreach ($results as $key => $value) {
            $results[$key] = number_format($value, 2, '.', ',');
        }

        return $results;
    }
}













