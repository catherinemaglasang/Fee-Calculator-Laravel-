<?php

namespace Thirty98\Http\Controllers;

use Thirty98\Http\Controllers\Controller;
use Thirty98\Http\Controllers\Models\Categories;
use Thirty98\Http\Controllers\Models\Counties;
use Thirty98\Http\Controllers\Models\States;
use Jenssegers\Agent\Agent;
use UserRightsServices;
use Datahub;
use Auth;

class CalculatorController extends Controller
{
    protected $agent;
    protected $rights;

    function __construct(Agent $agent, UserRightsServices $rights)
    {
        $this->agent = $agent;
        $this->rights = $rights;
        // $user_state = $this->getUserstate();
        // view()->share('user_state', $user_state);
    }

    public function main()
    {
        if (!Auth::check()) {
            return redirect('login')->with('error', 'Please login first!');
        }

        $data = [
            "counties" => Counties::where('state_code', '=', 'TX')->get(),
            "agent" => $this->agent->isMobile()
        ];

        return view('calculator.main', compact('data'))->with('states', States::all());
    }

    public function logs()
    {
        if (!Auth::check()) {
            return redirect('login')->with('error', 'Please login first!');
        }

        $data = [
            "counties" => Counties::where('state_code', '=', 'TX')->get(),
            "agent" => $this->agent->isMobile()
        ];

        return view('calculator.logs', compact('data'))->with('states', States::all());
    }

    public function useCalculatorTexas()
    {
        // $user_state = $this->getUserstate();

        if (!Auth::check()) {
            return redirect('login')->with('error', 'Please login first!');
        }

        $data = [
            "counties" => Counties::where('state_code', '=', 'TX')->get(),
            "agent" => $this->agent->isMobile()
        ];

        // if (!in_array("TX", $user_state->available) || !in_array("TX", $user_state->states)) {
        //     if (in_array($user_state->default, $user_state->available)) {
        //         return redirect('calculator/' . $user_state->default)->with('error', 'You dont have permission to use LA calculator!');
        //     } else {
        //         return redirect('calculator/main')->with('error', 'You dont have permission to use LA calculator!');
        //     }
        // } else {
        //     return view('calculator.tx', compact('data'))->with('states', States::all());
        // }

        return view('calculator.tx', compact('data'))->with('states', States::all());
    }

    public function useCalculatorArkansas()
    {
        // $user_state = $this->getUserstate();

        if (!Auth::check()) {
            return redirect('login')->with('error', 'Please login first!');
        }

        $data = [
            "counties" => Counties::where('state_code', '=', 'AR')->get(),
            "agent" => $this->agent->isMobile()
        ];

        // if ($this->rights->Calculators('AR')) {
        //     return view('calculator.ar', compact('data'))->with('states', States::all());
        // } else {
        //     return redirect('calculator/main')->with('error', 'You dont have permission to use LA calculator!');
        // }

        return view('calculator.ar', compact('data'))->with('states', States::all());
    }


    public function useCalculatorDelaware()
    {
        $user_state = $this->getUserstate();

        if (!Auth::check()) {
            return redirect('login')->with('error', 'Please login first!');
        }

        $data = [
            "counties" => Counties::where('state_code', '=', 'DE')->get(),
            "agent" => $this->agent->isMobile()
        ];

        if (!in_array("DE", $user_state->available) || !in_array("DE", $user_state->states)) {
            if (in_array($user_state->default, $user_state->available)) {
                return redirect('calculator/' . $user_state->default)->with('error', 'You dont have permission to use LA calculator!');
            } else {
                return redirect('calculator/main')->with('error', 'You dont have permission to use LA calculator!');
            }
        } else {
            return view('dashboard.content.calculator.delaware', compact('data'))->with('states', States::all());
        }
    }

    public function useCalculatorLouisiana()
    {
        // $user_state = $this->getUserstate();

        if (!Auth::check()) {
            return redirect('login')->with('error', 'Please login first!');
        }

        $data = [
            "counties" => Counties::where('state_code', '=', 'LA')->get(),
            "agent" => $this->agent->isMobile()
        ];

        // if (!in_array("LA", $user_state->available) || !in_array("LA", $user_state->states)) {
        //     if (in_array($user_state->default, $user_state->available)) {
        //         return redirect('calculator/' . $user_state->default)->with('error', 'You dont have permission to use LA calculator!');
        //     } else {
        //         return redirect('calculator/main')->with('error', 'You dont have permission to use LA calculator!');
        //     }
        // } else {
        //     return view('calculator.la', compact('data'))->with('states', States::all());
        // }

        return view('calculator.la', compact('data'))->with('states', States::all());

    }

    public function useCalculatorLouisiana2()
    {
        if (!Auth::check()) {
            return redirect('login')->with('error', 'Please login first!');
        }

        $data = [
            "counties" => Counties::where('state_code', '=', 'LA')->get(),
            "agent" => $this->agent->isMobile()
        ];

        return view('calculator.la2', compact('data'))->with('states', States::all());
    }

    private function getStateId($state = null)
    {
        if (!$state) {
            throw new \Exception("No State Provided", "404");
        }

        return States::where("name", $state)->first()->id;
    }

    private function getUserstate()
    {
        $baseUrl = env('ADMIN_API_URL');
        $response = Datahub::get($baseUrl . 'application/state', ['user_id' => Auth::id()]);

        if (is_null($response)) {
            return null;
        }

        if ($response->data->data)
            return $response->data->data;

        return null;
    }

    private function getRole()
    {
        $url = env('ADMIN_API_URL');
        try {
            $response = Datahub::get($url . 'application/userrole/' . Auth::id(), ['app' => 'calculator']);
            return $response->data->data;
        } catch (\Exception $e) {
            return false;
        }
    }
}
