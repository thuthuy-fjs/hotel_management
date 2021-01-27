<?php
namespace App\Repositories\Admin;

use App\Models\Admin\CountryModel;
use App\Repositories\BaseRepository;

class CountryRepository extends BaseRepository implements CountryRepositoryInterface
{

    public function getModel()
    {
        return CountryModel::class;
    }

    public function getHotelFromProvince($id)
    {

    }
}