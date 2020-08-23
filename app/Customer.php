<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
//////////////////////////
use Laratrust\Traits\LaratrustUserTrait; // To Use LaraTrust
/////////////////////////

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
}
