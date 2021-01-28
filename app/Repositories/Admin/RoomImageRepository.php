<?php
namespace App\Repositories\Admin;

use App\Models\Admin\RoomImageModel;
use App\Repositories\BaseRepository;

class RoomImageRepository extends BaseRepository
{

    public function getModel()
    {
        return RoomImageModel::class;
    }
}