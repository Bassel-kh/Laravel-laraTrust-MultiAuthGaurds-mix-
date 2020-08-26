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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Begin laratrust /////////////////////////////////////////////////////////////

//    Route::get('/home', 'HomeController@index')->name('home');
//    Route::get('/admin', 'AdminController@index')->name('admin');
//    Route::get('/user', 'UserController@index')->name('user');

// End laratrust //////////////////////////////////////////////////////////////////

Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/login/customer', 'Auth\LoginController@showCustomerLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
Route::get('/register/customer', 'Auth\RegisterController@showCustomerRegisterForm');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/login/customer', 'Auth\LoginController@CustomerLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
Route::post('/register/customer', 'Auth\RegisterController@createCustomer');

Route::view('/home', 'home')->middleware('auth');
Route::view('/admin', 'admin')->middleware('auth:admin');
Route::view('/customer', 'customer')->middleware('auth:customer');


Route::get('/logintest', 'Auth\LoginTestController@showLoginForm');
Route::post('/logintest', 'Auth\LoginTestController@Login')->name('login.test');

////////////////////////////// Begin Admin Route ////////////////////////////

    Route::prefix('/admin')->name('admin.')->namespace('Auth\Admin')->group(function(){
        //All the admin routes will be defined here...

        //Forgot Password Routes
        Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');

        //Reset Password Routes
        Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');
    });

////////////////////////////// End Admin Route ////////////////////////////
#######################################################################

////////////////////////////// Begin Customer Route ////////////////////////////


        Route::prefix('/customer')->name('customer.')->namespace('Auth\Customer')->group(function(){
            //All the admin routes will be defined here...
            //Forgot Password Routes
            Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
            Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');

            //Reset Password Routes
            Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
            Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');
        });
////////////////////////////// End Customer Route ////////////////////////////
##############################################################################
