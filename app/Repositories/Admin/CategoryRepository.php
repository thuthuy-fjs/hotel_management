<?php
namespace App\Repositories\Admin;

use App\Models\Admin\CategoryModel;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    public function getModel()
    {
        return CategoryModel::class;
    }

    public function getHotelFromProvince($id)
    {

    }
}