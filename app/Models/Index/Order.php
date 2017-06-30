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

    /**
     * 根据微信订单号跟新数据
     * @param $outtradeTo
     * @param $wecahtData
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateOrderByOutTradeTo($outtradeTo, $wecahtData) {
        $order = $this->where('out_trade_no', $outtradeTo)->first();
        if (!empty($wecahtData['transaction_id'])){
            $order->transaction_id = $wecahtData['transaction_id'];
        }
        if (!empty($wecahtData['total_fee'])){
            $order->pay_amount = $wecahtData['total_fee'] / 100;
            $order->pay_status = 1;
        }
        if (!empty($wecahtData['time_end'])){
            $order->pay_time = $wecahtData['time_end'];
        }
        $order->save();
        return back();
    }
}
