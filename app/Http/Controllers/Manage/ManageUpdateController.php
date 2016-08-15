<?php

namespace Thirty98\Http\Controllers\Manage;

use Illuminate\Http\Request;
use Thirty98\Http\Controllers\Controller;
use Thirty98\Http\Controllers\Models\CategoriesTypes;
use Thirty98\http\controllers\models\Cities_Fees;
use Thirty98\Http\Controllers\Models\Types;
use Thirty98\Http\Controllers\Models\StateFees;
use Thirty98\Http\Controllers\Models\CountyFees;
use Thirty98\Http\Controllers\Models\Fees;
use Thirty98\Http\Controllers\Models\States;
use Thirty98\Http\Controllers\Models\TexasDates;

class ManageUpdateController extends Controller
{

	// Updates State Fee
	public function updateStateTable($state,$feeId,$categoryTypeId,$amount)
	{
		return StateFees::where('state_id','=',$state)
					->where('fee_id','=',$feeId)
					->where('category_type_id','=',$categoryTypeId)
					->update(['amount' => $amount]);
	}

	// Updates County Fee
	public function updateCountyFee($county,$feeId,$categoryTypeId,$amount)
	{
		return CountyFees::where('county_id','=',$county)
					->where('fee_id','=',$feeId)
					->where('category_type_id','=',$categoryTypeId)
					->update(['amount' => $amount]);
	}

	// Update City Fee
	public function updateCityFees($cityId, $feeId, $newFeeAmount, $startDate, $endDate)
	{
		$result = Cities_Fees::updateRaw($cityId, $feeId, $newFeeAmount, $startDate, $endDate);

		print $result;
	}

	// Updates County Fee
	public function updateDates($data)
	{
		$request = [];

		$tables = [
			'Texas' => TexasDates::class
		];

		$data = explode('&', $data);

		foreach ($data as $value) {
			$value = explode('=', $value);
			$request[$value[0]] = $value[1];
		}

		$state_name = States::where('id','=',$request['state_id'])->first()->name;

		return $tables[$state_name]::where('id','=',$request['id'])
					->update([
						'min_weight'	=> $request['min_weight'],
						'max_weight' 	=> $request['max_weight'],
						'amount' 		=> $request['amount'],
						'start_date' 	=> $request['start_date'],
						'end_date' 		=> $request['end_date']
					]);
	}
}
