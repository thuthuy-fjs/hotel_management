<?php
namespace App\Repositories\Frontend;

use App\Models\Frontend\BookingModel;
use App\Repositories\BaseRepository;

class BookingRepository extends BaseRepository
{

    public function getModel()
    {
        return BookingModel::class;
    }

}