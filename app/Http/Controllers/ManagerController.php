<?php

namespace Thirty98\Http\Controllers;

use Illuminate\Http\Request;
use Thirty98\Http\Controllers\Models\Fee;
use Thirty98\User;
use Thirty98\Http\Controllers\Controller;
use Thirty98\Http\Controllers\Models\States;
use Thirty98\Http\Controllers\Manage\TexasManagerController as TexasManager;
use Thirty98\Http\Controllers\Manage\LouisianaManagerController as LouisianaManager;
use Auth;


class ManagerController extends Controller
{
	// First function here
	public function manageCalculator()
	{
		if ( !Auth::check() ) {
            return redirect('login')->with('login-error', 'Please login first!');
        }

        if( !Auth::user()->admin ) {
        	return 'You dont have suffecient administrative account!';
        }

		return view('dashboard.content.manage')->with('states', States::all());
	}

	// Louisiana calculator manager
	public function manageCalculatorLouisiana(Request $request, LouisianaManager $louisiana_manager)
	{

		switch ($request->input('cat')) {
			case 'fees':

				return $this->manageFeesController($request->input('cat'),$request->input('type'), $louisiana_manager);

				break;

			case 'city_fees':

				return $this->manageFeesController($request->input('cat'),$request->input('type'), $louisiana_manager);

				break;

			case 'penalties':

				return $this->managePenaltiesController($request->input('cat'),$request->input('type'), $louisiana_manager);

				break;

			case 'tax':

				return $this->manageTaxController($request->input('cat'),$request->input('type'), $louisiana_manager);

				break;

			case 'dates':

				return $this->manageDatesController($request->input('cat'),$request->input('type'), $louisiana_manager);

				break;

			default:
				# code...
				break;
		}
	}

	// Texas calculator manager
	public function manageCalculatorTexas(Request $request, TexasManager $texas_manager)
	{

		switch ($request->input('cat')) {
			case 'fees':
				
				return $this->manageFeesController($request->input('cat'),$request->input('type'),$texas_manager);

				break;

			case 'penalties':

				return $this->managePenaltiesController($request->input('cat'),$request->input('type'),$texas_manager);

				break;

			case 'tax':

				return $this->manageTaxController($request->input('cat'),$request->input('type'),$texas_manager);

				break;

			case 'dates':

				return $this->manageDatesController($request->input('cat'),$request->input('type'),$texas_manager);

				break;
			
			default:
				# code...
				break;
		}
	}

	// Manage Fees

	public function manageFeesController($category, $type, $state_manager)
	{
		$data = $state_manager->getFees($category, $type);
		
		return view('dashboard.content.manage.states', compact('data'))->with('states', States::all());
	}

	// Manage Penalties

	public function managePenaltiesController($category, $type, $texas_manager)
	{
		$data = $texas_manager->getFees($category, $type);
		
		return view('dashboard.content.manage.states', compact('data'))->with('states', States::all());
	}

	// Manage Tax

	public function manageTaxController($category, $type, $texas_manager)
	{
		$data = $texas_manager->getFees($category, $type);
		
		return view('dashboard.content.manage.states', compact('data'))->with('states', States::all());
	}

	// Manage Dates

	public function manageDatesController($category, $type, $texas_manager)
	{
		$data = [

			'state' => 'TX',
			'category' => $category,
			'type' => $type,
			'state_id' => States::find('texas')->id,
			'fee_types' => [
				[
					'name' => 'Fees',
					'slug' => 'fee'
				],
				[
					'name' => 'Penalties',
					'slug' => 'penalty'
				],
				[
					'name' => 'Tax',
					'slug' => 'tax'
				]
			]
		];

		return view('dashboard.content.manage.states', compact('data'))->with('states', States::all());

	}

}







