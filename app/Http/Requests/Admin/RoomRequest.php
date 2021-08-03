<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'hotel_id' => 'required',
            'room_type_id' => 'required',
            'room_number' =>'required|numeric',
            'room_price' => 'required|numeric',
            'room_images' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'hotel_id' => 'Loại chỗ nghỉ',
            'room_type_id' => 'Loại phòng nghỉ',
            'room_number' => 'Số lượng phòng',
            'room_price' => 'Giá tiền',
            'room_images' => 'Ảnh',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute là bắt buộc',
            'max' => ':attribute không quá 255 kí tự',
            'email'=> ':attribute không đúng định dạng',
            'numeric' => ':attribute phải là số',
            'unique'=> ':attribute đã tồn tại. Vui lòng nhập loại phòng nghỉ khác'
        ];
    }
}
