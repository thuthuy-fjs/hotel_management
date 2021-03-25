<?php

namespace App\Imports\Admin;

use App\Models\Admin\CategoryModel;
use App\Models\Admin\HotelModel;
use App\Models\Admin\ProvinceModel;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class HotelImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, SkipsOnError
{
    use Importable, SkipsErrors, SkipsFailures;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $province = ProvinceModel::where("province_name", $row['province_id'])->first();
        $category = CategoryModel::where("category_name", $row['category_id'])->first();

        $row['province_id'] = $province->id;
        $row['category_id'] = $category->id;
        $row['hotel_image'] = 'http://localhost:8080/hotel_management/public/storage/photos/1/hotels/hotel.jpg';
        $row['description'] = null;
        $row['is_active'] = 1;

        return new HotelModel([
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

    public function customValidationAttributes()
    {
        return [
            '0' => 'province_id',
            '1' => 'category_id',
            '2' => 'hotel_name',
            '3' => 'hotel_phone',
            '4' => 'hotel_email',
            '5' => 'hotel_website'
        ];
 }

    public function rules(): array
    {
        return [
            '*.province_id' => 'required|exists:provinces,province_name',
            '*.category_id' => 'required|exists:categories,category_name',
            '*.hotel_name' => 'required|unique:hotels|max:255',
            '*.hotel_phone' => 'required|numeric',
            '*.hotel_email' => 'required|email',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'province_id.required' => 'Tỉnh thành là bắt buộc',
            'province_id.exists' => 'Không tồn tại tỉnh thành',
            'category_id.required' => 'Loại chỗ nghỉ là bắt buộc',
            'category_id.exists' => 'Không tồn tại loại chỗ nghỉ',
            'hotel_name.required' => 'Tên khách sạn là bắt buộc',
            'hotel_phone.required' => 'Số điện thoại là bắt buộc',
            'hotel_phone.numeric' => 'Số điện thoại phải là số',
            'hotel_email.required' => 'Email là bắt buộc',
            'hotel_email.email' => 'Email không đúng định dạng',
            'hotel_name.unique' => 'Khách sạn đã tồn tại',
            'hotel_name.max' => 'Tên khách sạn quá dài',
        ];
    }
}
