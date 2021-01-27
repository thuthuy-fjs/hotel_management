<?php

namespace App\Exports\Admin;


use App\Models\Admin\HotelModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class HotelExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return HotelModel::all();
    }

    public function headings():array {
        return [
            'STT',
            'Tên khách sạn',
            "Điện thoại",
            "Email",
            "Website",
            "Mô tả",
        ];
    }

    public function map($hotel): array
    {
        return [
            $hotel->id,
            $hotel->hotel_name,
            $hotel->hotel_phone,
            $hotel->hotel_email,
            $hotel->hotel_website,
            $hotel->description
        ];
    }
}
