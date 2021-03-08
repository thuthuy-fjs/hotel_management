<?php

namespace App\Exports\Admin;

use App\Models\Admin\RoomModel;
use Maatwebsite\Excel\Concerns\FromCollection;;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RoomExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RoomModel::all();
    }

    public function headings():array {
        return [
            'STT',
            'Khách sạn',
            "Loại phòng",
            "Tên phòng",
            "Giá",
        ];
    }

    public function map($room): array
    {
        return [
            $room->id,
            $room->hotel_id,
            $room->room_type_id,
            $room->room_name,
            $room->room_price,
        ];
    }
}
