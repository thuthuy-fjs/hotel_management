<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

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
            'hotel_name' => 'required|max:255',
            'hotel_phone' => 'required|numeric',
            'hotel_email' => 'required|email',
            'hotel_image' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute is required!',
            'email' => ':attribute must be email',
        ];
    }
}
