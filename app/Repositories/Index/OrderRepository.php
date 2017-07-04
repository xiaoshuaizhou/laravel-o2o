<?php

namespace App\Repositories\Index;


use App\Models\Index\Order;

/**
 * Class OrderRepository
 * @package App\Repositories\Index
 */
class OrderRepository
{
    /**
     * @var Order
     */
    public $order;

    /**
     * OrderRepository constructor.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    /**
     * 订单添加
     * @param $data
     * @return mixed
     */
    public function creates($data) {
        $order = $this->order->create($data);
        return $order->id;
    }
    /**
     * 根据微信订单号跟新数据
     * @param $outtradeTo
     * @param $wecahtData
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateOrderByOutTradeTo($outtradeTo, $wecahtData) {
        $order = $this->order->where('out_trade_no', $outtradeTo)->first();
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
    /**
     * @param $id
     * @return mixed
     */
    public function whereForm($id)
    {
        return $this->order->where('id', $id)->first();
    }
    /**
     * @param $outTradeTo
     * @return mixed
     */
    public function whereFormByOutTradeNo($outTradeTo) {
        return $this->order->where('out_trade_no', $outTradeTo)->first();
    }
}
