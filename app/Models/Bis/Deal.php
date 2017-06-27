<?php

namespace App\Models\Bis;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $fillable = [
            'bis_id',
            'name',
            'image' ,
            'category_id',
            'se_category_id' ,
            'city_id' ,
            'location_ids' ,
            'start_time' ,
            'end_time' ,
            'total_count' ,
            'origin_price' ,
            'current_price' ,
            'coupons_begin_time' ,
            'coupons_end_time' ,
            'notes' ,
            'description',
            'account_id',
            'xpoint' ,
            'ypoint'
    ];

    /**
     * 查询全部的团购商品
     * @return mixed
     */
    public function getNormalDeals()
    {
        $deals = $this->where('status', 1)->orderBy('id', 'desc')->paginate(1);
        return $deals;
    }
    /**
     * 查询未审核的团购商品
     * @return mixed
     */
    public function getNormalDealsReview()
    {
        $deals = $this->where('status', '<', 1)->orderBy('id', 'desc')->paginate(1);
        return $deals;
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
                $deal = $this->where($data)
                        ->orderBy('id', 'desc')
                        ->paginate(1);
                return $deal;
            }else {
                $deal = $this->where('name', 'like', '%' . $name['name'] . '%')
                        ->where($data)
                        ->orderBy('id', 'desc')
                        ->paginate(1);
                return $deal;
            }
        }else {
            if (empty($name)){
                $deal = $this->where($data)
                        ->whereBetween('created_at', [$time['start_time'], $time['end_time']])
                        ->orderBy('id', 'desc')
                        ->paginate(1);
                return $deal;
            }else {
                $deal = $this->where('name', 'like', '%' . $name['name'] . '%')
                        ->where($data)
                        ->whereBetween('created_at', [$time['start_time'], $time['end_time']])
                        ->orderBy('id', 'desc')
                        ->paginate(1);
                return $deal;
            }
        }
    }
    /**
     * 修改状态
     * @param $id
     * @param $status
     */
    public function changStatus($id,$status) {
        $category = $this->where('id' , $id)->first();
        $status == 0 ? $category->status = 1 : $category->status =0;
        $category->save();
    }

    /**
     * 根据ID查想数据
     * @param $id
     * @return mixed
     */
    public function getNormalDealById($id) {
        return $this->where('id', $id)->first();
    }

    /**
     * 团过商品编辑
     * @param $data
     */
    public function updateById($data) {
        $deal = $this->find($data['id']);
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
     * 团购商品下架（状态 == 2））
     * @param $id
     */
    public function deleteDealById($id)
    {
        $deal = $this->find($id);
        $deal->status = 2;
        $deal->save();
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
        $deals = $this->where('category_id', $catId)
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
     * 多条件查询，排序商品
     * @param array $data
     * @param $order
     * @return mixed
     */
    public function getDealByConditions($data=[], $order) {
        if (empty($data)){
            abort(404, '数据出错，请重试');
        }
        $deals = $this->where($data);
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
}
