<?php

namespace App\Models\Admin;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AdminModel extends Authenticatable
{
    use Notifiable;

    public $table = 'admins';

    protected $fillable = [
        'first_name',
        'last_name',
        'user_name',
        'email',
        'password',
        'phone',
        'location',
        'image',
        'provider',
        'provider_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
