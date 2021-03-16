<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

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
            'email' => 'required|email',
            'password' => 'min:8',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute is required!',
            'min' => ':attribute must be at least 8 character',
            'email' => ':attribute must be email'
        ];
    }
}
