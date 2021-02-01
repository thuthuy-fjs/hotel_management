<?php
namespace App\Repositories\Admin;

use App\Models\Admin\RoomModel;
use App\Repositories\BaseRepository;

class RoomRepository extends BaseRepository
{

    public function getModel()
    {
        return RoomModel::class;
    }
}