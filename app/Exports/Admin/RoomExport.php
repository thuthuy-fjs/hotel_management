<?php

namespace App\Exports\Admin;

use App\Models\Admin\RoomModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RoomExport implements FromCollection, WithHeadings, WithMapping
{
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ($this->request == 'all') {
            return RoomModel::all();
        } elseif (ctype_digit($this->request)) {
            return RoomModel::where('hotel_id', $this->request)->get();
        }
        $keyword = $this->request;
        return RoomModel::where("room_name", "LIKE", "%$keyword%")
            ->orWhereHas('hotel', function ($query) use ($keyword) {
                $query->where('hotel_name', "LIKE", "%$keyword%");
            })->get();
    }

    public function headings(): array
    {
        return [
            'STT',
            'Quốc gia',
            'Tỉnh/Thành phố',
            'Khách sạn',
            "Loại phòng",
            "Số lượng",
            "Giá",
        ];
    }

    public function map($room): array
    {
        return [
            $room->id,
            $room->hotel->province->country->country_name,
            $room->hotel->province->province_name,
            $room->hotel->hotel_name,
            $room->type->room_type,
            $room->room_number,
            $room->room_price,
        ];
    }
}
