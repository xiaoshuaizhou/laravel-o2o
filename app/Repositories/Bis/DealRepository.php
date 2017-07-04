<?php

namespace App\Repositories\Bis;

use App\Models\Bis\Deal;

/**
 * Class DealRepository
 * @package App\Repositories\Bis
 */
class DealRepository
{
    /**
     * @var Deal
     */
    public $deal;

    /**
     * DealRepository constructor.
     * @param Deal $deal
     */
    public function __construct(Deal $deal) {
        $this->deal = $deal;
    }
    /**
     * 购买商品
     * @param $id
     * @param $count
     * @return mixed
     */
    public function updateBuyCountById($id, $count) {
        return  $this->deal->where('id', $id)->increment('buy_count', $count);
    }
    /**
     * 根据分类和城市查询商品（首页）
     * @param $catId
     * @param $cityId
     * @param $limit
     * @return mixed
     */
    public function getDealByCategoryIdAndCityId($catId, $cityId, $limit=4)
    {
        $deals = $this->deal->where('category_id', $catId)
                ->where('city_id', $cityId)
                ->where('status', 1)
                ->where('end_time', '>', time()) //修改完类型  end_time修复bug
                ->orderBy('listorder', 'desc')
                ->orderBy('id', 'desc');
        if ($limit){
            $deals->limit($limit);
        }
        $deals = $deals->get();
        return $deals;
    }
    /**
     * 团购商品下架（状态 == 2））
     * @param $id
     */
    public function deleteDealById($id)
    {
        $deal = $this->deal->find($id);
        $deal->status = 2;
        $deal->save();
    }
    /**
     * 团过商品编辑
     * @param $data
     */
    public function updateById($data) {
        $deal = $this->deal->find($data['id']);
        $deal->name  = $data['name'];
        $deal->category_id = $data['category_id'];
        $deal->city_id = $data['city_id'];
        $deal->location_ids = implode(',', $data['location_ids']);
        $deal->start_time = $data['start_time'];
        $deal->end_time = $data['end_time'];
        $deal->total_count = $data['total_count'];
        $deal->origin_price = $data['origin_price'];
        $deal->current_price = $data['current_price'];
        $deal->coupons_begin_time = $data['coupons_begin_time'];
        $deal->coupons_end_time = $data['coupons_end_time'];
        $deal->notes = $data['notes'];
        $deal->description = $data['description'];

        $deal->save();
    }
    /**
     * 根据ID查想数据
     * @param $id
     * @return mixed
     */
    public function getNormalDealById($id) {
        return $this->deal->where('id', $id)->first();
    }
    /**
     * 修改状态
     * @param $id
     * @param $status
     */
    public function changStatus($id,$status) {
        $category = $this->deal->where('id' , $id)->first();
        $status == 0 ? $category->status = 1 : $category->status =0;
        $category->save();
    }
    /**
     * 根据where条件查询（多条件查询）
     * @param array $data
     * @return mixed
     */
    public function getNormalDealsByWhere($data, $name=[], $time, $status=1) {
        $data['status'] = $status;
        if (empty($time)){
            if (empty($name)){
                $deal = $this->deal->where($data)
                        ->orderBy('id', 'desc')
                        ->paginate(1);
                return $deal;
            }else {
                $deal = $this->deal->where('name', 'like', '%' . $name['name'] . '%')
                        ->where($data)
                        ->orderBy('id', 'desc')
                        ->paginate(1);
                return $deal;
            }
        }else {
            if (empty($name)){
                $deal = $this->deal->where($data)
                        ->whereBetween('created_at', [$time['start_time'], $time['end_time']])
                        ->orderBy('id', 'desc')
                        ->paginate(1);
                return $deal;
            }else {
                $deal = $this->deal->where('name', 'like', '%' . $name['name'] . '%')
                        ->where($data)
                        ->whereBetween('created_at', [$time['start_time'], $time['end_time']])
                        ->orderBy('id', 'desc')
                        ->paginate(1);
                return $deal;
            }
        }
    }
    /**
     * 查询未审核的团购商品
     * @return mixed
     */
    public function getNormalDealsReview()
    {
        $deals = $this->deal->where('status', '<', 1)->orderBy('id', 'desc')->paginate(1);
        return $deals;
    }
    /**
     * 查询全部的团购商品
     * @return mixed
     */
    public function getNormalDeals()
    {
        $deals = $this->deal->where('status', 1)->orderBy('id', 'desc')->paginate(1);
        return $deals;
    }
    /**
     * 多条件查询，排序商品
     * @param array $data
     * @param $order
     * @return mixed
     */
    public function getDealByConditions($data=[], $order) {
        if (empty($data)){
            abort(404, '数据出错，请重试');
        }
        //商品和分类多对多的关系
//        $datas[] = 'end_time > '. date('Y-m-d H:i:s'); //使用定时器定时任务扫描表中的时间
//        if ($data['se_category_id']){
//            $datas[] = " find_in_set(".$data['se_category_id'].", se_category_id)" ;
//        }
//        if (!empty($data['category_id'])){
//            $datas[] = " category_id = ".$data['category_id'] ;
//        }
//        $datas[] = 'status=1';
//        if ($data['city_id']){
//            $datas[] = " city_id = ".$data['city_id'] ;
//        }
        $deals = $this->deal->where($data);
        if ($order == 'order_sales'){
            $deals->orderBy('buy_count', 'desc');
        }elseif ($order == 'order_price'){
            $deals->orderBy('current_price', 'desc');
        }elseif($order == 'order_time'){
            $deals->orderBy('created_at', 'desc');
        }
        $deals = $deals->paginate();
        return $deals;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data) {
        return $this->deal->create($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id) {
        return $this->deal->find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function whereForm($id) {
        return $this->deal->where('id', $id)->first();
    }
}
