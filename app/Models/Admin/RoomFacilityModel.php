<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class RoomFacilityModel extends Model
{
    protected $table = 'room_facilities';

    protected $fillable = [
        'room_id', 'room_facility_id', 'description'
    ];

    public function room()
    {
        return $this->belongsTo(RoomModel::class, 'room_id');
    }

    public function facility()
    {
        return $this->belongsTo(RoomFacilityModel::class, 'room_facility_id');
    }

    public function room_facility()
    {
        return $this->belongsTo(FacilityModel::class, 'room_facility_id');
    }

}
