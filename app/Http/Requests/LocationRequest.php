<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
                'bis_id' => 'required|integer',
                'tel' => 'required|regex:/^1[34578][0-9]{9}$/',
                'logo' => 'required',
                'name' => 'required|max:25',
                'contact' => 'required',
                'category_id' => 'required|integer',
                'category_path' => 'required',
                'city_id' => 'required|integer',
                'city_path' => 'required',
                'address' => 'required',
                'api_address' => 'required',
                'open_time' => 'required',
                'content' => 'required',
                'is_main' => 'required|in:0', //分店
                'xpoint' => 'required',
                'ypoint' => 'required',
                'bank_info' => 'required',
        ];
    }

    public function messages() {
        return [
            'name.required' => '分店名称不能为空',
        ];
    }
}
