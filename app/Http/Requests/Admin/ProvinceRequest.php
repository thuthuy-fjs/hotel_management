<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProvinceRequest extends FormRequest
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
            'country_id' => 'required',
            'province_name' => [
                'required',
                'max:255',
                Rule::unique('provinces')->ignore($this->id),
            ],
            'province_image' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'country_id' => 'Quốc gia',
            'province_name' => 'Tên tỉnh thành',
            'province_image' => 'Ảnh',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute là bắt buộc',
            'max' => ':attribute không quá 255 kí tự',
            'email'=> ':attribute không đúng định dạng',
            'unique'=> ':attribute đã tồn tại. Vui lòng nhập tên khác'
        ];
    }
}
