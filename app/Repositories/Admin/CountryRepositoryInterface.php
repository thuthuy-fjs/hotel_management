<?php
namespace App\Repositories\Admin;

interface CountryRepositoryInterface
{
    public function getHotelFromProvince($id);
}