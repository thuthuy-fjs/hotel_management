<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class PasswordGuestReset extends Model
{
    protected $table = 'password_guest_resets';

    protected $fillable = [
        'email',
        'token',
    ];
}
