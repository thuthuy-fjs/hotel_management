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

}