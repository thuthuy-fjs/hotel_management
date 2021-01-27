<?php
namespace App\Repositories\Admin;

use App\Models\Admin\RoomTypeModel;
use App\Repositories\BaseRepository;

class RoomTypeRepository extends BaseRepository implements RoomTypeRepositoryInterface
{

    public function getModel()
    {
        return RoomTypeModel::class;
    }

    public function getHotelFromProvince($id)
    {

    }
}