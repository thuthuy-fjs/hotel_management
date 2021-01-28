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
}