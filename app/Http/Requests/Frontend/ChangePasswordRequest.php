<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ];
    }

    public function attributes()
    {
        return [
            'current_password' => 'Mật khẩu hiện tại',
            'new_password' => 'Mật khẩu mới',
            'confirm_password' => 'Mật khẩu xác nhận',
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
