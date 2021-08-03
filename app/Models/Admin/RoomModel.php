<?php

namespace App\Models\Admin;

use App\Models\Frontend\BookingModel;
use Illuminate\Database\Eloquent\Model;

class RoomModel extends Model
{
    protected $table = 'room';

    protected $fillable = [
        'hotel_id',
        'room_type_id',
        'room_number',
        'room_price',
        'room_images'
    ];

    public function hotel()
    {
        return $this->belongsTo(HotelModel::class, 'hotel_id');
    }

    public function type()
    {
        return $this->belongsTo(RoomTypeModel::class, 'room_type_id');
    }

    public function facility()
    {
        return $this->belongsTo(RoomFacilityModel::class, 'room_id');
    }

    public function bookings()
    {
        return $this->hasMany(BookingModel::class, 'room_id');
    }
}
