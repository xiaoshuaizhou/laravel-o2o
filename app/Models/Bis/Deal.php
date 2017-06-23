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

    public function updateById($data) {
        dd($data);
        $deal = $this->find($data['id']);
        $deal->name  = $data['name'];
        $deal->image = $data['image'] ;
        $deal->category_id = $data['category_id'];
        $deal->city_id = $data['city_id'];
        $deal->location_ids = $data['location_ids'];
        $deal->start_time = $data['start_time'];
        $deal->end_time = $data['end_time'];
        $deal->total_count = $data['total_count'];
        $deal->origin_price = $data['origin_price'];
        $deal->current_price = $data['current_price'];
        $deal->coupons_begin_time = $data['coupons_begin_time'];
        $deal->coupons_end_time = $data['coupons_end_time'];
        $deal->notes = $data['notes'];
        $deal->description = $data['description'];
        $deal->account_id = $data['account_id'];

    }
}
