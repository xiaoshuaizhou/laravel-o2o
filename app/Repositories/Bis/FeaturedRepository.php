<?php

namespace App\Repositories\Bis;

use App\Models\Bis\Featured;

/**
 * Class FeaturedRepository
 * @package App\Repositories\Bis
 */
class FeaturedRepository {
    /**
     * @var Featured
     */
    public $featured;

    /**
     * FeaturedRepository constructor.
     * @param Featured $featured
     */
    public function __construct(Featured $featured) {
        $this->featured = $featured;
    }
    /**
     * 根据type查询推荐位
     * @param $type
     * @return mixed
     */
    public function getNorMalFeaturedByType($type)
    {
        $condition = ['type' => $type];
        $featured = $this->featured->where($condition)
                ->where('status', '>=', 0)
                ->paginate();
        return $featured;
    }
    /**
     * 修改状态
     * @param $id
     * @param $status
     */
    public function changStatus($id,$status) {
        $featured = $this->featured->where('id' , $id)->first();
        $status == 0 ? $featured->status = 1 : $featured->status =0;
        $featured->save();
    }
    /**
     * 推荐位删除
     * @param $id
     */
    public function destory($id)
    {
        $featured = $this->featured->find($id);
        $featured->status = 2;
        $featured->save();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data) {
        return $this->featured->create($data);
    }

}