<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class RoomModel extends Model
{
    protected $table = 'room';
    protected $fillable = [
        'hotel_id', 'room_type_id', 'room_price'
    ];

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword != '') {
            $query->where(function ($query) use ($keyword) {
                $query->where("hotel_id", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }

    public function hotel()
    {
        return $this->belongsTo('App\Models\Admin\HotelModel', 'hotel_id');
    }

    public function roomType()
    {
        return $this->belongsTo('App\Models\Admin\RoomTypeModel', 'room_type_id');
    }

    public function images(){
        return $this->hasMany('App\Models\Admin\RoomImageModel', 'room_id');
    }

    public function facilities(){
        return $this->hasMany('App\Models\Admin\RoomFacilityModel', 'room_id');
    }
}
