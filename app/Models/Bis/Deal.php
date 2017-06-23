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
        $deals = $this->orderBy('id', 'desc')->get();
        return $deals;
    }

    /**
     * 根据where条件查询（多条件查询）
     * @param array $data
     * @return mixed
     */
    public function getNormalDealsByWhere($data, $time) {
        $data['status'] = 1;
        if (empty($time)){
            $deal = $this->where($data)
                    ->orderBy('id', 'desc')
                    ->get();
            return $deal;
        }else {
            $deal = $this->where($data)
                    ->whereBetween('created_at', [$time['start_time'], $time['end_time']])
                    ->orderBy('id', 'desc')
                    ->get();
            return $deal;
        }
    }
}
