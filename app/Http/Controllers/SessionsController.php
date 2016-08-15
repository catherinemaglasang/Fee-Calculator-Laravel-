<?php

namespace Thirty98\Http\Controllers;

use Illuminate\Http\Request;
use Thirty98\Models\State;
use Jenssegers\Agent\Agent;
use Datahub;
use Auth;
use GuzzleHttp\Client;

class SessionsController extends Controller
{
    public function login()
    {
        $agent = new Agent();

        $data = [
            "agent" => $agent->isMobile()
        ];

        return view('auth.login', compact('data'))->with('states', State::all());;
    }

    public function postLogin(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        if ($this->signIn($request)) {
            flash('success','Welcome back!');
            // return redirect()->intended('/calculator/' . $this->getUserstate()->default);
            return redirect()->intended('/calculator/LA');
        }

        flash('error','Could not sign you in.');

        return redirect()->back();
    }

    public function logout()
    {
        Auth::Logout();

        flash('success','You have now been signed out. See ya.');

        return redirect('/');
    }

    protected function signIn(Request $request)
    {
        return Auth::attempt(
            $this->getCredentials($request),
            $request->has('remember')
        );
    }

    protected function getCredentials(Request $request)
    {
        return [
            'email'    => $request->input('email'),
            'password' => $request->input('password')
            // 'verified' => true
        ];
    }

    private function getUserstate()
    {
        $baseUrl = env('ADMIN_API_URL');
        $response = Datahub::get($baseUrl . 'application/state', ['user_id' => Auth::id()]);

        if($response->data->data) {
            return $response->data->data;
        }

        return null;
    }
}
