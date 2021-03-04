<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class StarRatingModel extends Model
{
    protected $table = 'star_rating';

    protected $fillable = [
        'guest_id', 'booking_id', 'level', 'description'
    ];

    public function guest()
    {
        return $this->belongsTo('App\Models\Frontend\GuestModel', 'guest_id');
    }

    public function booking()
    {
        return $this->belongsTo('App\Models\Frontend\BookingModel', 'booking_id');
    }
}
