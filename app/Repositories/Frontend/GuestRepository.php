<?php
namespace App\Repositories\Frontend;

use App\Models\Frontend\GuestModel;
use App\Repositories\BaseRepository;

class GuestRepository extends BaseRepository
{

    public function getModel()
    {
        return GuestModel::class;
    }

}