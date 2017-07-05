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
                'image' => 'required',
//                'tel' => 'required||regex:/^1[34578][0-9]{9}$/',
//                'contact' => 'required',
                'category_id' => 'required|integer',
//                'address' => 'required',
//                'open_time' => 'required',
//                'username' => 'required|max:25',
                'location_ids' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'total_count' => 'required|numeric',
                'origin_price' => 'reuqired|regex:^(([1-9]\d*)(\.\d{1,2})?)$|(0\.0?([1-9]\d?))$',
                'current_price' => 'reuqired|regex:^(([1-9]\d*)(\.\d{1,2})?)$|(0\.0?([1-9]\d?))$'

        ];
    }

    public function messages() {
        return [
                'name.required' => '团购名称不能为空',
                'name.max' => '团购名称最多25个字符',
                'city_id.required' => '请选择城市',
                'se_city_id.required' => '请选择二级城市',
                'image.required' => '请上传缩略图',
                'category_id.required' => '请选择分类',
                'location_ids.required' => '请选择支持门店' ,
                'start_time.required' => '请填写团购开始时间',
                'end_time.required' => '请填写团购结束时间',
                'total_count.required' =>'请填写库存',
                'total_count.numeric' =>'库存必须是数字',
                'origin_price.required' => '请填写原价',
                'origin_price.regex' => '请填写正确的原价',
                'current_price.required' => '请填写团购价',
                'current_price.regex' => '请填写正确的团购价',


        ];
    }
}
