<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Password;

use Auth;
use Illuminate\Http\Request;


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

    /////////////////////////////////// Begin Add ////////////////////////////////////////////
    protected function guard()
    {
        return Auth::guard('customer');
    }

    public function broker()
    {
        return Password::broker('customers');
    }

    /**
     * Show the reset password form.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null){
        return view('auth.passwords.reset',[
            'url' => 'customer','email' => $request->email,
            'token' => $token,
        ]);
    }
    /////////////////////////////////// End Add ////////////////////////////////////////////

}
