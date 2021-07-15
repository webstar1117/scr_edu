<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\EmailOtp;
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
use Mail;

class EmailRegisterController extends Controller
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
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        return redirect()->route('auth-login');
    }
    function sendNumber(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
        if ($validator->fails()) {
            echo json_encode(['status' => 'fail', 'data' => $validator->errors()]);
            return;
        } else {
            $email = $request->input('email');
            $otp = rand(100000, 999999);
            $this->sendEmail($email, $otp);

            $email_otp=new EmailOtp;
            $email_otp->otp=$otp;
            $email_otp->save();
            
            echo json_encode(['status' => 'sucess', 'data' =>$otp]);
        }
    }
    function verifyNumber(Request $request)
    {
        $otp = $request->input('otp');
        if (EmailOtp::where('otp', $otp)->exists()) {
            EmailOtp::where('otp', $otp)->delete();
            echo 'success';
        } else {
            echo 'fail';
        }
    }
    function resendNumber(Request $request)
    {
        $email = $request->input('email');
        $otp = rand(100000, 999999);
        $this->sendEmail($email,$otp);
        $email_otp=new EmailOtp;
        $email_otp->otp=$otp;
        $email_otp->save();
        echo json_encode(['status' => 'sucess', 'data' => $otp]);
      
    }



    function sendEmail($email,$otp)
    {
        Mail::raw('verification code: ' . $otp, function ($message) use($email) {
            $message->to($email)->subject("Check verification code");
            $message->from(env('MAIL_USERNAME'), 'sanlam');
        });
    }
}
