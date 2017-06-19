<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BisRequest extends FormRequest
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
                'name' => 'required|max:25',
                'city_id' => 'required|integer',
                'se_city_id' => 'required',
                'logo' => 'required',
                'licence_logo' => 'required',
                'bank_info' => 'required',
                'bank_name' => 'required',
                'bank_user' => 'required',
                'faren' => 'required',
                'faren_tel' => 'required|regex:/^1[34578][0-9]{9}$/',
                'email' => 'required|email',
                'tel' => 'required||regex:/^1[34578][0-9]{9}$/',
                'contact' => 'required',
                'category_id' => 'required|integer',
                'address' => 'required',
                'open_time' => 'required',
                'username' => 'required|max:25',
                'password' => 'required',
        ];
    }
}
