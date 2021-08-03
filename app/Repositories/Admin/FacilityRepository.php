<?php

namespace App\Repositories\Admin;

use App\Models\Admin\FacilityModel;
use App\Repositories\BaseRepository;

class FacilityRepository extends BaseRepository
{

    public function getModel()
    {
        return FacilityModel::class;
    }

}