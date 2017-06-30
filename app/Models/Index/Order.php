<?php

namespace App\Models\Index;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['out_trade_no', 'user_id', 'username', 'deal_id', 'total_price', 'referer', 'transaction_id', 'pay_time',
            'payment_id', 'pay_status', 'total_price', 'pay_amount', 'status', 'deal_count' ];

    /**
     * 订单添加
     * @param $data
     * @return mixed
     */
    public function creates($data) {
        $order = $this->create($data);
        return $order->id;
    }
}
