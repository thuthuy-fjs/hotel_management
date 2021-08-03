<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PasswordResetModel extends Model
{
    protected $fillable = ['email', 'token',];
}
