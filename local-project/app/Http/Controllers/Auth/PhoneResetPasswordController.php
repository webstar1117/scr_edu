<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class PhoneResetPasswordController extends Controller
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
            'phone_number' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('fail', 'Validation Error!');
        } else {
            $phone_number = $request->input('phone_number');
            $exist = User::where('phone_number', $phone_number)->first();
            if ($exist) {
                $response = $this->sendOTP($phone_number);
                $res = explode(":", $response);
                if ($res[0] == 'ID') {
                    Session::put('OTP', trim($res[1]));
                    return redirect()->route('phone-verify')->with('phone_number', $phone_number);
                } else {
                  return  redirect()->back()->with('fail', 'Verification is failed!');
                }
            } else {
                return redirect()->back()->with('fail', 'There is no registered phone!');
            }
        }
    }
    function verifyNumber(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'verify_number' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('fail', 'Validation Error!');
        } else {
            $verify_number = $request->input('verify_number');
            $phone_number = $request->input('phone_number');
            $password = $request->input('password');
            if ($verify_number == Session::get('OTP')) {
                User::where('phone_number', $phone_number)->update(['password' => Hash::make($password)]);
                return redirect()->route('auth-login-phone');
            } else {
                return redirect()->back()->with('fail', 'Verification code is incorrect!');
            }
        }
    }

    function sendOTP($phone_number)
    {
        $user = 'SanlamUganda';
        $pass = 'S@nlamUg@nda1';
        $to = $phone_number;
        $message = 'Hi';
        $response = Http::get('https://api.clickatell.com/http/sendmsg?user=' . $user . '&password=' . $pass . '&api_id=3654463&to=' . $to . '&text=' . $message);
        return $response->body();
    }
}
