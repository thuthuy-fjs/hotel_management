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

    public function getCompleteBooking($user, $time, $limit)
    {
        $data = $this->model->where('guest_id', $user)
            ->where('check_out_date', '<', $time)->paginate($limit);
        return $data;
    }

    public function getIncompleteBooking($user, $time, $limit)
    {
        $data = $this->model->where('guest_id', $user)
            ->where('check_out_date', '>', $time)->paginate($limit);
        return $data;
    }
}