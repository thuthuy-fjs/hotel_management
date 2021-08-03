<?php
namespace App\Repositories\Frontend;

use App\Models\Frontend\PaymentModel;
use App\Repositories\BaseRepository;

class PaymentRepository extends BaseRepository
{

    public function getModel()
    {
        return PaymentModel::class;
    }

}