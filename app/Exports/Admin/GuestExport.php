<?php

namespace App\Exports\Admin;

use App\Models\Frontend\GuestModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class GuestExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return GuestModel::all();
    }

    public function headings():array {
        return [
            'STT',
            'Họ',
            "Tên",
            "Tên đăng nhập",
            "Email",
            "Địa chỉ",
            "Điện thoại",
        ];
    }

    public function map($guest): array
    {
        return [
            $guest->id,
            $guest->first_name,
            $guest->last_name,
            $guest->user_name,
            $guest->email,
            $guest->address,
            $guest->phone,
        ];
    }
}
