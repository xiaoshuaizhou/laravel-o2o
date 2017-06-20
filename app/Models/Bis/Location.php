<?php

namespace App\Models\Bis;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['bis_id', 'logo', 'name', 'contact', 'category_id', 'category_path', 'city_id', 'city_path', 'address', 'open_time', 'content', 'api_address', 'is_main', 'xpoint', 'ypoint', 'bank_info'];

    /**
     * 根据bis_id 查询数据
     * @param $bisId
     * @return mixed
     */
    public function getBisByBisId($bisId)
    {
        $data = [
            'bis_id' => $bisId,
            'is_main' => 1
        ];
        $res = $this::where($data)->first();
        return $res;
    }
}
