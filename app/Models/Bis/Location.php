<?php

namespace App\Models\Bis;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['bis_id', 'logo', 'tel', 'name', 'contact', 'category_id', 'category_path', 'city_id', 'city_path', 'address', 'open_time', 'content', 'api_address', 'is_main', 'xpoint', 'ypoint', 'bank_info'];

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

    /**
     * 获取分店信息   is_main = 0
     * @param int $isMain
     * @return mixed
     */
    public function getBisByIsMain()
    {
        $locations = $this->where('status','<',2)->orderBy('id', 'desc')
                ->paginate(3);
        return $locations;
    }

    public function getLocationById($id) {
        return $this->where('id', $id)->first();
    }
}
