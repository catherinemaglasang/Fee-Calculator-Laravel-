<?php

namespace Thirty98\Http\Controllers;

use Thirty98\Http\Controllers\Controller;
use Thirty98\Http\Controllers\Models\States;
use Jenssegers\Agent\Agent;
use Datahub;
use Auth;

class DashboardController extends Controller
{
    /**
     * Create a new request instance attribute.
     *
     * @return void
     */
    public function __construct()
    {
        view()->share('user_state', $this->getUserstate());
    }

    public function useCalculator()
    {
        //Use Middleware as much as possible
        if (!Auth::check()) {
            return redirect('login')->with('error', 'Please login first!');
        }

        $agent = new Agent();

        $data = [
            "agent" => $agent->isMobile()
        ];
        
        return view('calculator.main', compact('data'))->with('states', States::all());
    }

    private function getUserstate()
    {
        $baseUrl = env('ADMIN_API_URL');
        $response = Datahub::get($baseUrl . 'application/state', ['user_id' => Auth::id()]);

        if($response->data->data)
            return $response->data->data;
        
        return null;
    }
}

// EOF
