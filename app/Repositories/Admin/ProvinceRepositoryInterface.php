<?php
namespace App\Repositories\Admin;

interface ProvinceRepositoryInterface
{
    public function getProvinceFromCountry($id);
}