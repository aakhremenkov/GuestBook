<?php

namespace App\Http\Controllers\Auth;

use App\Helper;
use App\Notifications\UserCreated;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getSignupForm()
    {
        return view('public.auth.signup');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'birthdate' => 'date_format:"d/m/Y"',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function postSignupForm(Request $request)
    {
        $this->validator($request->all())->validate();
        $pass = Helper::GenerateRandomString(6);
        $birthdate = Carbon::createFromFormat('d/m/Y', $request->birthdate);

        $user = User::create([
            'username' => $request->username,
            'birthdate' => $birthdate,
            'sex' => $request->sex,
            'email' => $request->email,
            'password' => bcrypt($pass),
        ]);
        $user->notify(new UserCreated($user, $pass));
        session()->flash("info_msg", "Account created.");
        $this->guard()->login($user);
        return redirect(url('/'));
    }

    public function postSignupValidate(Request $request)
    {
        $this->validator($request->all())->validate();

        $birdate = Carbon::createFromFormat('d/m/Y', $request->birthdate);
        if($birdate > Carbon::now()->addYears(-6)){
            return new JsonResponse( ['birthdate' => ['You too young to post messages.']], 422);
        }
        return new JsonResponse( ['success' => ['success']]);
    }
}
