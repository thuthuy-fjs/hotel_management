<?php

namespace App\Repositories\Frontend;

use App\Models\Frontend\StarRatingModel;
use App\Repositories\BaseRepository;

class StarRatingRepository extends BaseRepository
{

    public function getModel()
    {
        return StarRatingModel::class;
    }

    public function getStarRatingInHotel($hotel_id, $limit)
    {
        $data = $this->model->where(function ($query) use ($hotel_id) {
            $query->where(function ($query) use ($hotel_id) {

            });
        })->paginate($limit);
        return $data;
    }

}