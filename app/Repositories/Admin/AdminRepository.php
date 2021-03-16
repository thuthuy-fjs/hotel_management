<?php
namespace App\Repositories\Admin;

use App\Models\Admin\AdminModel;
use App\Repositories\BaseRepository;

class AdminRepository extends BaseRepository
{

    public function getModel()
    {
        return AdminModel::class;
    }
}