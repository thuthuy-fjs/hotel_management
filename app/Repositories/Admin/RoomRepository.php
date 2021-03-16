<?php

namespace App\Repositories\Admin;

use App\Models\Admin\RoomModel;
use App\Repositories\BaseRepository;

class RoomRepository extends BaseRepository implements RoomRepositoryInterface
{

    public function getModel()
    {
        return RoomModel::class;
    }

    public function getRoom($hotel_id, $person_number, $times = [])
    {
        $data = $this->model->where('hotel_id', $hotel_id)
            ->whereDoesntHave('bookings', function ($query) use ($times) {
                $query->whereBetween('check_in_date', $times)
                    ->orWhereBetween('check_out_date', $times)
                    ->orWhere(function ($query) use ($times) {
                        $query->where('check_in_date', '<', $times[0])
                            ->where('check_out_date', '>', $times[1]);
                    });
            })->whereHas('type', function ($query) use ($person_number) {
                $query->where('person_number', '>=', $person_number);
            })->get();
        return $data;
    }

    public function search($keyword)
    {
        if ($keyword != '') {
            $rooms = $this->model->where("room_name", "LIKE", "%$keyword%")
                ->orWhereHas('hotel', function ($query) use ($keyword) {
                    $query->where('hotel_name', "LIKE", "%$keyword%");
                })->get();
        }
        return $rooms;
    }
}