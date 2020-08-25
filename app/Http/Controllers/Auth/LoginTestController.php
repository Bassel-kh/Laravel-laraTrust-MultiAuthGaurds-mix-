<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
/////////////////////////////
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;

/// ///////////////////////

class LoginTestController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
    {   //     We set the middleware to restrict access to this controller or its methods.
        //          It is important we defined all the different types of guests in the controller.
        //              This way, if one type of user is logged in and you try to use another user type to log in,
        //                   it will redirect you to a predefined authentication page.

        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:customer')->except('logout');
    }
    ##########################################################
    ////////////////// Begin Admin Methods ///////////////////
    public function showLoginForm()
    {
        return view('Test.login');
    }

    public function Login(Request $request)
    {
//        $this->validate($request, [
//            'email' => 'required|email',
//            'password' => 'required|min:6'
//        ]);
        $this->validator($request->all())->validate();
        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/customer');
        }
        else {
            $errors = ['email'=> __('auth.failed')];
            return redirect()->intended('logintest')->withErrors($errors);
        }
//        return back()->withInput($request->only('email', 'remember'));
    }

    ////////////////// End Admin Methods ///////////////////
    #########################################################
    #########################################################
    ////////////////// Begin Customer Methods /////////////////
    public function showCustomerLoginForm()
    {
        return view('auth.login', ['url' => 'customer']);
    }

    public function customerLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ], [
            'email.required' => 'required'
        ]);

        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/customer');
        }
        return back()->withInput($request->only('email', 'remember'));
    }
    ////////////////// End Customer Methods /////////////////
    /// ###############################################  ////

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }
}
