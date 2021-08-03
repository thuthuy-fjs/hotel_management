<?php

namespace App\Repositories\Admin;

interface HotelRepositoryInterface
{
    public function getHotel($province_id, $person_number, $limit);

    public function search($keyword);
}