<?php

namespace Thirty98\Http\Controllers\Manage;

use Thirty98\Http\Controllers\Models\Counties;
use Thirty98\Http\Controllers\Models\Categories;
use Thirty98\Http\Controllers\Models\States;
use Thirty98\Http\Controllers\Models\TexasDates as Date;
use Thirty98\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;


class TexasManagerController extends Controller
{
	public function getFees( $category, $subCategory)
	{

		$agent = new Agent();

		$data = [

			'state' => 'TX',
			'category' => $category,
			'type' => $subCategory,
			'state_id' => States::find('texas')->id,
			'mobile' => false

		];

		// Todo
		// 

		switch ($subCategory) {

			// Fees
			case 'state_fees':
				
				$data['categories'] = Categories::all();

				break;

			case 'city_fees':

				$data['categories'] = Categories::all();

				break;

			case 'county_fees':

				$data['categories'] = Categories::all();
				$data['counties'] = Counties::where('state_id','=',States::find('texas')->id)->get();

				break;

			// Penalties
			case 'state_penalties':

				$data['categories'] = Categories::all();

				break;

			case 'county_penalties':

				$data['categories'] = Categories::all();
				$data['counties'] = Counties::where('state_id','=',States::find('texas')->id)->get();

				break;

			// Tax

			case 'state_tax':

				$data['categories'] = Categories::all();

				break;

			case 'county_tax':

				$data['categories'] = Categories::all();
				$data['counties'] = Counties::where('state_id','=',States::find('texas')->id)->get();

				break;
			
			default:

				$data['categories'] = null;

				break;

		}

		return $data;
	}
}