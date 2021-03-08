<?php

namespace App\Imports\Admin;

use App\Models\Admin\RoomModel;
use Maatwebsite\Excel\Concerns\ToModel;

class RoomImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new RoomModel([
            'id' => $row['id'],
            'hotel_id' => $row['hotel_id'],
            'room_type_id' => $row['room_type_id'],
            'room_name' => $row['room_name'],
            'room_price' => $row['room_price'],
            'room_images' => $row['room_images'],
        ]);
    }
}
