<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/guestbook';

    public function showLoginForm()
    {
        return view('public.auth.login');
    }

    protected function attemptLogin(Request $request)
    {
        if($this->guard()->attempt(['email' => $request['login'], 'password' => $request['password']], true)){
            return true;
        }
        elseif($this->guard()->attempt(['username' => $request['login'], 'password' => $request['password']], true)){
            return true;
        }
        else{
            return false;
        }
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'login' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect(url('login'))->withInput()->withErrors(['error' => 'Неверный логин или пароль']);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
