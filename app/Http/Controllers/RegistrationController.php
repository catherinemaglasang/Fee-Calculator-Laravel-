<?php

namespace Thirty98\Http\Controllers;

use Thirty98\User;
use Illuminate\Http\Request;
use Thirty98\Mailers\AppMailer;
use Thirty98\Http\Controllers\Models\Counties;
use Thirty98\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;

use Auth;

class RegistrationController extends Controller
{

    protected $agent;

    function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }

    public function register()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        }

        $data = [
           "counties" => Counties::where('state_code','=', 'TX')->get(),
            "agent" => $this->agent->isMobile()
        ];

    	return view('auth.register', compact('data'));
    }

    public function postRegister(Request $request, AppMailer $mailer)
    {
    	$this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
    	]);

    	$user = User::create($request->all());

    	$mailer->sendEmailConfirmationTo($user);

    	flash('success','Please confirm your email address.');

    	return redirect()->back();
    }

    public function confirmEmail($token)
    {
        $user = User::whereToken($token)->firstOrFail()->confirmEmail();

        flash('success','You are now confirmed. Please login.');

        return redirect('login');
    }
}
