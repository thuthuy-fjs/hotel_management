<?php
namespace App\Repositories\Admin;

interface RoomRepositoryInterface
{
    public function getRoom($hotel_id, $person_number, $times = []);

    public function search($keyword);
}