<?php

namespace App\Repositories\Admin;

use App\Models\Admin\HotelModel;
use App\Repositories\Admin\HotelRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class HotelRepository extends BaseRepository implements HotelRepositoryInterface
{

    public function getModel()
    {
        return HotelModel::class;
    }


    public function getHotel($province_id, $person_number, $limit)
    {
        $data = $this->model->where('province_id', $province_id)
            ->whereHas('rooms', function ($query) use ($person_number) {
                $query->wherein('room_type_id', function ($query) use ($person_number) {
                    $query->from("room_types")
                        ->where('person_number', '>=', $person_number)
                        ->select("id");
                });
            })->paginate($limit);
        return $data;

    }

    public function search($keyword)
    {
        if ($keyword != '') {
            $hotels = $this->model->where("hotel_name", "LIKE", "%$keyword%")
                ->orWhere("hotel_email", "LIKE", "%$keyword%")
                ->orWhere("hotel_website", "LIKE", "%$keyword%")
                ->paginate(10);
        }
        return $hotels;
    }
}