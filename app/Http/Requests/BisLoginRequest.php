<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BisLoginRequest extends FormRequest
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
            'username' => 'required|max:25',
            'password' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages() {
        return [
            'username.required' => '用户名不能为空',
            'username.max' => '用户名最多25字符',
            'password.required' => '密码不能为空'
        ];
    }
}
