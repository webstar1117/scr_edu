<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//login with email
Route::get('/auth-login', function () {
   return view('auth-login');
})->name('auth-login');
Route::post('/auth-login', 'Auth\LoginController@login');

//login with phone
Route::get('/auth-login/phone', function () {
   return view('auth-login-phone');
})->name('auth-login-phone');
Route::post('/auth-login/phone', 'Auth\PhoneLoginController@login');

//register with email
Route::get('/auth-register', function () {
   return view('auth-register');
})->name('auth-register');
Route::post('/auth-register/email', 'Auth\EmailRegisterController@create');
Route::post('/auth-register/email/send-number', 'Auth\EmailRegisterController@sendNumber');
Route::post('/auth-register/email/verify-number', 'Auth\EmailRegisterController@verifyNumber');
Route::post('/auth-register/email/resend-number', 'Auth\EmailRegisterController@resendNumber');

//register with phone
Route::get('/auth-register/phone', function () {
   return view('auth-register-phone');
})->name('auth-register-phone');
Route::post('/auth-register', 'Auth\RegisterController@create');
Route::post('/auth-register/send-number', 'Auth\RegisterController@sendNumber');
Route::post('/auth-register/verify-number', 'Auth\RegisterController@verifyNumber');
Route::post('/auth-register/resend-number', 'Auth\RegisterController@resendNumber');

//reset password with email
Route::get('/auth-login/reset', function(){
   return view('auth-recoverpw');
});
Route::post('/reset-password/email', 'Auth\ResetPasswordController@sendNumber');
Route::get('/reset-password/email-confirm',function(){
   return view('email-verify');
})->name('email-verify');
Route::post('/reset-password/email/confirm', 'Auth\ResetPasswordController@verifyNumber');


//reset password with phone
Route::get('/auth-login/reset-phone', function(){
   return view('auth-recoverpw-phone');
});
Route::post('/reset-password/phone', 'Auth\PhoneResetPasswordController@sendNumber');
Route::get('/reset-password/phone-confirm',function(){
   return view('phone-verify');
})->name('phone-verify');
Route::post('/reset-password/phone/confirm', 'Auth\PhoneResetPasswordController@verifyNumber');




//others

Route::get('/about-us', function () {
   return view('about-us');
})->name('about-us');

Route::get('/faq', function () {
   return view('faq');
})->name('faq');


Route::get('/privacy-policy', function () {
   return view('privacy-policy');
})->name('privacy-policy');

Route::get('/terms', function () {
   return view('terms');
})->name('terms');


Auth::routes();

Route::get('pages-404', 'SkoteController@index');
Route::get('pages-500', 'SkoteController@index');
Route::get('pages-maintenance', 'SkoteController@index');
Route::get('pages-comingsoon', 'SkoteController@index');

Route::post('keep-live', 'SkoteController@live');

Route::get('index/{locale}', 'LocaleController@lang');

Route::get('auth/{provider}', 'Auth\RegisterController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');

Route::post('/contacts-profile', 'UserController@updateProfile');

//scr edu
Route::get('/scr-edu', 'ScrEduController@index')->name('scr-edu');
Route::post('/scr-edu/add', 'ScrEduController@add')->name('scr-edu-add');

//scr super
Route::get('/scr-super', 'ScrSuperController@index')->name('scr-super');
Route::post('/scr-super/add', 'ScrSuperController@add')->name('scr-super-add');

//List Users
Route::get('/list-user', 'HomeController@listUser')->name('list-user');
Route::post('/list-user/editUser', 'HomeController@editUser');
Route::post('/list-user/changeBlock', 'HomeController@changeBlock');

//account

Route::get('/account',function(){
   return view('account');
})->name('account');


Route::get('/index', function () {
   if (Auth::user()) {
      return redirect()->route('account');
   } else {
      return redirect()->route('auth-login');
   }
});

Route::get('/', function () {
   if (Auth::user()) {
      return redirect()->route('account');
   } else {
      return redirect()->route('auth-login');
   }
})->name('index');
