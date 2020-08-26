<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Password;
use Auth;
use Illuminate\Http\Request;



class ForgotPasswordController extends Controller
{
    public function __construct()
    {   //     We set the middleware to restrict access to this controller or its methods.
        //          It is important we defined all the different types of guests in the controller.
        //              This way, if one type of user is logged in and  try to reset password,
        //                   it will redirect you to a predefined authentication page.

        $this->middleware('guest');
        $this->middleware('guest:admin');
        $this->middleware('guest:customer');
    }

    /**
     * Show the reset email form.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function showLinkRequestForm(){
        return view('auth.passwords.email',[
            'url' => 'admin',
        ]);
    }
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function broker()
    {
        return Password::broker('admins');
    }
}
