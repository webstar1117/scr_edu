<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
use Illuminate\Support\Facades\Hash;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }
    function sendNumber(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('fail', 'Validation Error!');
        } else {
            $email = $request->input('email');
            $exist=User::where('email',$email)->first();
            if($exist){
                $otp = rand(100000, 999999);
                $this->sendEmail($email, $otp);
    
                Session::put('OTP', $otp);
                return redirect()->route('email-verify')->with('email', $email);
            }else{
                return redirect()->back()->with('fail', 'There is no registered email!');
            }

        }
    }
    function verifyNumber(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'verify_number' => ['required', 'numeric'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('fail', 'Validation Error!');
        } else {
            $verify_number = $request->input('verify_number');
            $email = $request->input('email');
            $password = $request->input('password');
            if ($verify_number == Session::get('OTP')) {
                User::where('email',$email)->update(['password' => Hash::make($password)]);
                return redirect()->route('auth-login');
            }else{
                return redirect()->back()->with('fail', 'Verification code is incorrect!');
            }
        }
            
    }

    function sendEmail($email,$otp)
    {
        Mail::raw('verification code: ' . $otp, function ($message) use ($email) {
            $message->to($email)->subject("Check verification code");
            $message->from(env('MAIL_USERNAME'), 'sanlam');
        });
    }
}
