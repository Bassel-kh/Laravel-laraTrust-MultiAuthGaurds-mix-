<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

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
}
