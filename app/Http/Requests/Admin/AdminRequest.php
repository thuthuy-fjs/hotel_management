<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
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
            'user_name' => 'required|max:255',
            'email' => [
                'required',
                'email',
            ],
            'password' => 'required|min:8',
        ];
    }

    public function attributes()
    {
        return [
            'user_name' => 'Tên đăng nhập',
            'email' => 'Email',
            'password' => 'Mật khẩu',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute là bắt buộc',
            'max' => ':attribute không quá 255 kí tự',
            'min' => ':attribute tối thiểu 8 kí tự',
            'email'=> ':attribute không đúng định dạng',
            'unique'=> ':attribute đã tồn tại. Vui lòng nhập email khác'
        ];
    }
}
