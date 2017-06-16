<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Overtrue\Pinyin\Pinyin;

class Citys extends Model
{
    protected $table = 'citys';
    protected $fillable = ['name', 'uname', 'listorder', 'parent_id', 'status', 'is_default'];
    /**
     * 根据ID获取城市信息
     * @param int $id
     * @return mixed
     */
    public function getCitysByParentId($parentId=0) {
        $condition = [
            'parent_id' =>$parentId
        ];
        return Citys::where($condition)->paginate();
    }

    /**
     * 根据ID获取数据
     * @param $id
     * @return mixed
     */
    public function getCityById($id) {
        return $this::find($id);
    }

    /**
     * 修改状态
     * @param $id
     * @param $status
     */
    public function changStatus($id,$status) {
        $category = $this::where('id' , $id)->first();
        $status == 0 ? $category->status = 1 : $category->status =0;
        $category->save();
    }

    public function updateCityById($data) {
        $pinyin = new Pinyin();

        $city = $this::find($data['id']);
        $city->name = $data['name'];
        $city->uname = $pinyin->sentence($data['name']);
        $city->parent_id = $data['parent_id'];

        $city->save();
    }
}
