<?php
namespace App\Repositories\Admin;

use App\Models\Admin\CategoryModel;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository
{

    public function getModel()
    {
        return CategoryModel::class;
    }
}