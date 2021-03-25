<?php

namespace App\Imports\Admin;

use App\Models\Admin\HotelModel;
use App\Models\Admin\RoomModel;
use App\Models\Admin\RoomTypeModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class RoomImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, SkipsOnError
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new RoomModel([
            'hotel_id' => HotelModel::where("hotel_name", $row['hotel_id'])->first()->id,
            'room_type_id' => RoomTypeModel::where("room_type", $row['room_type_id'])->first()->id,
            'room_name' => $row['room_name'],
            'room_price' => $row['room_price'],
            'room_images' => '["http:\/\/localhost:8080\/hotel_management\/public\/storage\/photos\/1\/rooms\/198286103.jpg"]',
        ]);
    }

    public function rules(): array
    {
        return [
            '*.hotel_id' => 'required|exists:hotels,hotel_name',
            '*.room_type_id' => 'required|exists:room_types,room_type',
            '*.room_name' => 'required|unique:room|max:255',
            '*.room_price' => 'required|',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'hotel_id.required' => 'Khách sạn là bắt buộc',
            'hotel_id.exists' => 'Không tồn tại khách sạn',
            'room_type_id.required' => 'Loại phòng nghỉ là bắt buộc',
            'room_type_id.exists' => 'Không tồn tại loại phòng nghỉ',
            'room_name.required' => 'Số phòng là bắt buộc',
            'room_price.required' => 'Giá phòng là bắt buộc',
            'room_name.unique' => 'Số phòng đã tồn tại',
            'room_name.max' => 'Số phòng quá dài',
            'room_price.numeric' => 'Giá phòng phải là số',
        ];
    }
}
