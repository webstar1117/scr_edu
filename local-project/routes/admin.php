<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Admin')->prefix('admin')->group(function () {
    Route::get(
        '/login',
        'Auth\AdminLoginController@showLoginForm'
    )->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('pages-login', 'SkoteController@index');


    //List Users
    Route::get('/list-user', 'AdminHomeController@listUser')->name('admin.list-user');
    Route::post('/list-user/editUser', 'AdminHomeController@editUser');
    Route::post('/list-user/changeBlock', 'AdminHomeController@changeBlock');


    //Add routes before this line only
    // Route::get('/{any}', 'HomeController@index');    

    Route::get('/index', 'AdminHomeController@index')->name('admin.dashboard');
    Route::get('/', 'AdminHomeController@root')->name('admin.dashboard');
});
