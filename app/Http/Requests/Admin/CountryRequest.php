<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CountryRequest extends FormRequest
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
            'country_name' => [
                'required',
                'max:255',
                Rule::unique('countries')->ignore($this->id),
            ],
        ];
    }

    public function attributes()
    {
        return [
            'country_name' => 'Quốc gia',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute là bắt buộc',
            'max' => ':attribute không quá 255 kí tự',
            'unique'=> ':attribute đã tồn tại. Vui lòng nhập tên khác'
        ];
    }
}
