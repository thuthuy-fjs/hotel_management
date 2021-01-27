<?php
namespace App\Repositories\Admin;

use App\Models\Admin\HotelModel;
use App\Repositories\Admin\HotelRepositoryInterface;
use App\Repositories\BaseRepository;

class HotelRepository extends BaseRepository implements HotelRepositoryInterface
{

    public function getModel()
    {
        return HotelModel::class;
    }

    public function getHotelFromProvince($id)
    {

    }
}