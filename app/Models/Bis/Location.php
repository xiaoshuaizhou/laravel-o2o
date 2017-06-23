<?php

namespace App\Models\Bis;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['bis_id', 'logo', 'tel', 'name', 'contact', 'category_id', 'category_path', 'city_id', 'city_path', 'address', 'open_time', 'content', 'api_address', 'is_main', 'xpoint', 'ypoint', 'bank_info'];

    /**
     * 根据bis_id 查询主店的一条数据
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
     * 根据bis_id查询 全部数据
     * @param $bisId
     * @return mixed
     */
    public function getBisByBisIds($bisId) {
        $data = [
                'bis_id' => $bisId,
                'status' => 1
        ];
        $res = $this::where($data)->get();
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

    /**
     * 删除分店
     * @param $id
     */
    public function destory($id) {
        $location = $this->location->find($id);
        $location->status = 2;
        $location->save();;
    }
}
