<?php

namespace App\Imports\Admin;

use App\Models\Admin\HotelModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class HotelImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new HotelModel([
            'id' => $row['id'],
            'province_id' => $row['province_id'],
            'category_id' => $row['category_id'],
            'hotel_name' => $row['hotel_name'],
            'hotel_phone' => $row['hotel_phone'],
            'hotel_email' => $row['hotel_email'],
            'hotel_website' => $row['hotel_website'],
            'hotel_image' => $row['hotel_image'],
            'description' => $row['description'],
            'is_active' => $row['is_active'],
        ]);
    }
}
