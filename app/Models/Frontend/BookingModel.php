<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class BookingModel extends Model
{
    protected $table = 'booking';

    protected $fillable = [
        'guest_id',
        'room_id',
        'booking_date',
        'check_in_date',
        'check_out_date',
        'total_price',
        'booking_note',
        'is_payment'
    ];

    public function guest()
    {
        return $this->belongsTo('App\Models\Frontend\GuestModel', 'guest_id');
    }

    public function room()
    {
        return $this->belongsTo('App\Models\Admin\RoomModel', 'room_id');
    }
}
