<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Player;
use App\Models\UserFood;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Http\Request;


use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\SocialProvider;
use App\Rules\Captcha;
use Illuminate\Support\Facades\Session;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Http;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect('/auth-register')->withErrors($validator->errors());
        } else {
            return true;
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {
        User::create([
            'phone_number' => $request->input('phone_number'),
            'password' => Hash::make($request->input('password')),
        ]);
        return redirect()->route('auth-login-phone');
    }
    function sendNumber(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => ['required', 'numeric', 'unique:users'],
        ]);
        if ($validator->fails()) {
            echo json_encode(['status' => 'fail', 'data' => $validator->errors()]);
            return;
        } else {
            $number = $request->input('phone_number');
            $response = $this->Fstmsms($number);
            $res = explode(":", $response);

            if ($res[0] == 'ID') {
                Session::put('OTP', trim($res[1]));
                echo json_encode(['status' => 'sucess', 'data' => Session::get('OTP')]);
            } else {
                echo json_encode(['status' => 'error', 'data' => $res[1]]);
            }
        }
    }
    function verifyNumber(Request $request)
    {

        $otp = $request->input('otp');
        $verify_number = Session::get('OTP') == null ? $request->input('verify_number') : Session::get('OTP');
        if ($verify_number == $otp) {
            echo 'success';
        } else {
            echo 'fail';
        }
    }
    function resendNumber(Request $request)
    {
        $number = $request->input('phone_number');
        $response = $this->Fstmsms($number);
        $res = explode(":", $response);
        if ($res[0] == 'ID') {
            Session::put('OTP', trim($res[1]));
            echo json_encode(['status' => 'sucess', 'data' => Session::get('OTP')]);
        } else {
            echo json_encode(['status' => 'error', 'data' => $res[1]]);
        }
    }



    function Fstmsms($number)
    {
        $user = 'SanlamUganda';
        $pass = 'S@nlamUg@nda1';
        $to =$number;
        $message = 'Hi';
        $response = Http::get('https://api.clickatell.com/http/sendmsg?user=' . $user . '&password=' . $pass . '&api_id=3654463&to=' . $to . '&text=' . $message);
        return $response->body();
    }
}
