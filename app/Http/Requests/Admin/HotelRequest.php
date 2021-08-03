<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HotelRequest extends FormRequest
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
            'province_id' => 'required',
            'category_id' => 'required',
            'hotel_name' =>  [
                'required',
                'max:255',
                Rule::unique('hotels')->ignore($this->id),
            ],
            'hotel_phone' => 'required|numeric|regex:/^([0-9\s\-\+\(\)]*)$/',
            'hotel_email' => 'required|email',
            'hotel_image' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'province_id' => 'Tỉnh/Thành phố',
            'category_id' => 'Loại chỗ nghỉ',
            'hotel_name' => 'Tên chỗ nghỉ',
            'hotel_phone' => 'Điện thoại',
            'hotel_email' => 'Email',
            'hotel_image' => 'Ảnh',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute là bắt buộc',
            'max' => ':attribute không quá 255 kí tự',
            'email'=> ':attribute không đúng định dạng',
            'numeric' => ':attribute phải là số',
            'regex' => ':attribute không đúng định dạng',
            'unique'=> ':attribute đã tồn tại. Vui lòng nhập tên khác'
        ];
    }
}
