<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PasswordAdminReset extends Model
{
    protected $table = 'password_admin_resets';
    protected $fillable = [
        'email',
        'token',
    ];
}
