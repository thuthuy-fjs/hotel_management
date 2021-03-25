<?php

namespace App\Exports\Admin;


use App\Models\Admin\HotelModel;
use Illuminate\Contracts\Queue\Job;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class HotelExport implements FromCollection, WithHeadings, WithMapping
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
            return HotelModel::all();
        } elseif (ctype_digit($this->request)) {
            return HotelModel::where('province_id', $this->request)->get();
        }
        return HotelModel::where("hotel_name", "LIKE", "%$this->request%")
            ->orWhere("hotel_email", "LIKE", "%$this->request%")
            ->orWhere("hotel_website", "LIKE", "%$this->request%")->get();

    }

    public function headings(): array
    {
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
