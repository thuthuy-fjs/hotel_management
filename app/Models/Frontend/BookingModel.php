<?php

namespace App\Models\Frontend;

use App\Models\Admin\RoomModel;
use Illuminate\Database\Eloquent\Model;

class BookingModel extends Model
{
    protected $table = 'booking';

    protected $fillable = [
        'guest_id',
        'room_id',
        'name',
        'email',
        'booking_date',
        'check_in_date',
        'check_out_date',
        'total_price',
        'number_room',
        'booking_note',
        'payment_id',
        'is_payment'
    ];

    public function guest()
    {
        return $this->belongsTo(GuestModel::class, 'guest_id');
    }

    public function room()
    {
        return $this->belongsTo(RoomModel::class, 'room_id');
    }

    public function starRating()
    {
        return $this->belongsTo(StarRatingModel::class, 'booking_id');
    }

    public function payment()
    {
        return $this->belongsTo(PaymentModel::class, 'payment_id');
    }
}
