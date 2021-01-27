<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class RoomImageModel extends Model
{
    protected $table = 'room_images';

    public function room()
    {
        return $this->belongsTo('App\Models\Admin\RoomModel', 'room_id');
    }
}
