<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class RoomFacilityModel extends Model
{
    protected $table = 'room_facilities';


    public function room()
    {
        return $this->belongsTo('App\Models\Admin\RoomModel', 'room_id');
    }

    public function facility()
    {
        return $this->belongsTo('App\Models\Admin\RoomFacilityModel', 'room_facility_id');
    }


}
