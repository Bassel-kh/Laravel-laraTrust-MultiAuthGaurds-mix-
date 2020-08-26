<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
//////////////////////////
use Laratrust\Traits\LaratrustUserTrait; // To Use LaraTrust
/////////////////////////
use App\Notifications\CustomizeResetPassword as ResetPasswordNotification;

class Customer extends Authenticatable
{
    use Notifiable;
    use LaratrustUserTrait; // LaraTrust


    protected $guard = 'customer';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];




    public function sendPasswordResetNotification($token)
    {
        $notification = new ResetPasswordNotification("customer",$token);

        $this->notify($notification);

    }

}
