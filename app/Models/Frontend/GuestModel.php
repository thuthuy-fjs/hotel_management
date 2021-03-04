<?php

namespace App\Models\Frontend;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class GuestModel extends Authenticatable
{
    use Notifiable;

    protected $table = 'guests';

    protected $fillable = [
        'first_name', 'last_name', 'user_name', 'email', 'password', 'phone', 'address', 'image', 'provider', 'provider_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function bookings(){
        return $this->hasMany('App\Models\Frontend\BookingModel', 'guest_id');
    }
}
