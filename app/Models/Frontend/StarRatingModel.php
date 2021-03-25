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
        return $this->belongsTo(GuestModel::class, 'guest_id');
    }

    public function booking()
    {
        return $this->belongsTo(BookingModel::class, 'booking_id');
    }
}
