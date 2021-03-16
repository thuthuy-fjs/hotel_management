<?php
namespace App\Repositories\Admin;

interface HotelRepositoryInterface
{
    public function getHotel($province_id, $times, $person_number);

    public function search($keyword);
}