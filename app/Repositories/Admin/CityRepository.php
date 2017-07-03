<?php

namespace App\Repositories\Admin;


use App\Models\Admin\Citys;
use Overtrue\Pinyin\Pinyin;
use Request;
/**
 * Class CityRepository
 * @package App\Repositories\Admin
 */
class CityRepository
{
    /**
     * @var Citys
     */
    public $city;

    /**
     * CityRepository constructor.
     * @param $city
     */
    public function __construct(Citys $city)
    {
        $this->city = $city;
    }

    /**
     * @param \Request $request
     * @return mixed
     */
    public function create($request)
    {
        $pinyin = new Pinyin();
        $data = [
            'uname' => $pinyin->permalink(request('name')),
            'listorder' => 0,
            'status' => 1,
            'is_default' => 0
        ];
       $res = $this->city->create(array_merge($request, $data));
       return $res;
    }
    /**
     * @param $cityuname
     * @return mixed
     */
    public function whereFrom($cityuname)
    {
        return $this->city->where(['uname'=> $cityuname])->first();

    }
    /**
     * 获取二级城市
     * @return mixed
     */
    public function getNormalCity()
    {
        $citys = $this->city->where('parent_id', '>', 0)
            ->where('status', '=', 1)
            ->orderBy('id', 'desc')
            ->get();
        return $citys;
    }
    /**
     * 根据listorder城市排序
     * @param $id
     * @param $listorder
     * @return mixed
     */
    public function listorder($id, $listorder)
    {
        return $this->city->where(['id' => $id])->update(['listorder' => $listorder]);
    }
    /**
     * 根据ID编辑城市
     * @param $data
     */
    public function updateCityById($data) {
        $pinyin = new Pinyin();

        $city = $this->city->find($data['id']);
        $city->name = $data['name'];
        $city->uname = $pinyin->sentence($data['name']);
        $city->parent_id = $data['parent_id'];

        $city->save();
    }
    /**
     * 修改状态
     * @param $id
     * @param $status
     */
    public function changStatus($id,$status) {
        $city = $this->city->where('id' , $id)->first();
        $status == 0 ? $city->status = 1 : $city->status =0;
        $city->save();
    }
    /**
     * 根据ID获取数据
     * @param $id
     * @return mixed
     */
    public function getCityById($id) {
        return $this->city->find($id);
    }

    /**
     * api接口（此处返回一个collection）
     * @param int $parentId
     * @return mixed
     */
    public function findCitysByParentId($parentId=0)
    {
        $condition = [
            'parent_id' =>$parentId
        ];
        $res = $this->city->where($condition)
            ->orderBy('id', 'desc')
            ->orderBy('listorder', 'desc')
            ->get();
        return $res;
    }
    /**
     * 根据ID获取城市信息
     * @param int $id
     * @return mixed
     */
    public function getCitysByParentId($parentId=0) {
        $condition = [
            'parent_id' =>$parentId
        ];
        $res = $this->city->where($condition)
            ->orderBy('id', 'desc')
            ->orderBy('listorder', 'desc')
            ->paginate();
        return $res;
    }
}
