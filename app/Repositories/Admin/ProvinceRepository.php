<?php
namespace App\Repositories\Admin;

use App\Models\Admin\ProvinceModel;
use App\Repositories\BaseRepository;

class ProvinceRepository extends BaseRepository implements ProvinceRepositoryInterface
{

    public function getModel()
    {
        return ProvinceModel::class;
    }

    public function getProvinceFromCountry($id)
    {
        $provinces = $this->model->find($id);
        return $provinces;
    }
}