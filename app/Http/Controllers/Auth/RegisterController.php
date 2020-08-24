<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
/////////////////////////
use App\User;
use App\Admin;
use App\Customer;
use Illuminate\Http\Request;
////////////////////////

class RegisterController extends Controller
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
        $this->middleware('guest:admin');
        $this->middleware('guest:customer');
    }


    ////////////////// Begin Admin Methods ///////////////////

    public function showAdminRegisterForm()
    {
        return view('auth.register', ['url' => 'admin']);
    }

    ##############################
    //methods for creating an admin:
    protected function createAdmin(Request $request)
    {
        $this->validator($request->all())->validate();
        $admin = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->intended('login/admin');
    }


    ##################################

    ////////////////// End Admin Methods ///////////////////
    ///  ###############################################   ///


    ////////////////// Begin Customer Methods ///////////////////

    public function showCustomerRegisterForm()
    {
        return view('auth.register', ['url' => 'customer']);
    }

    ##############################
    //methods for creating an Customer:
    protected function createCustomer(Request $request)
    {
        $this->validator($request->all())->validate();
        $customer = Customer::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->intended('login/customer');
    }
    ////////////////// End Customer Methods ///////////////////
    ///  ###############################################   ///


    ////////////////// Begin Validation Methods ///////////////

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'unique:admins', 'unique:customers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    ////////////////// End Validation Methods ///////////////////
    /// ################################################   ///




}
