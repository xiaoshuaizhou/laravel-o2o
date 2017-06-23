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
}
