<?php

namespace App\Repositories\Admin;

use App\Models\Admin\RoomFacilityModel;
use App\Repositories\BaseRepository;

class RoomFacilityRepository extends BaseRepository
{

    public function getModel()
    {
        return RoomFacilityModel::class;
    }

    public function findByRoom($room_id){
        $data = $this->model->where('room_id', $room_id)->get();
        return $data;
    }
}