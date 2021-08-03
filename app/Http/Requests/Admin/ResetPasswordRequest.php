<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'password' => 'required|min:8',
            'password_confirm' => 'required|same:password',
        ];
    }

    public function attributes()
    {
        return [
            'password' => 'Mật khẩu mới',
            'password_confirm' => 'Mật khẩu xác nhận',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute là bắt buộc',
            'min' => ':attribute tối thiểu 8 kí tự',
            'same'=> ':attribute không chính xác'
        ];
    }
}
