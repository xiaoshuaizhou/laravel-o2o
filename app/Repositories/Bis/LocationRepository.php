<?php

namespace App\Repositories\Bis;

use App\Models\Bis\Location;


/**
 * Class LocationRepository
 * @package App\Repositories\Bis
 */
class LocationRepository
{
    /**
     * @var Location
     */
    public $location;

    /**
     * LocationRepository constructor.
     * @param Location $location
     */
    public function __construct(Location $location) {
        $this->location = $location;
    }
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
        $res = $this->location->where($data)->first();
        return $res;
    }
    /**
     * @param $bisId
     * @return mixed
     */
    public function whereFormBisId($bisId) {
        return $this->location->where('bis_id', $bisId)->first()
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
        $res = $this->location->where($data)->get();
        return $res;
    }
    /**
     * 获取分店信息   is_main = 0
     * @param int $isMain
     * @return mixed
     */
    public function getBisByIsMain()
    {
        $locations = $this->location->where('status','<',2)->orderBy('id', 'desc')
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
    /**
     * 根据ids查询分店信息
     * @param $ids
     * @return string
     */
    public function getNormalLocationByIds($ids) {
        if (empty($ids)){
            return '';
        }
        $deal = $this->location->whereIn('id', [$ids])
                ->where('status', 1)
                ->get();
        return $deal;
    }
    /**
     * @param $id
     * @return mixed
     */
    public function find($id) {
        return $this->location->find($id);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data) {
        return $this->location->create($data);
    }
}
