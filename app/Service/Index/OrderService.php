<?php

namespace App\Service\Index;


use App\Repositories\Bis\DealRepository;
use App\Repositories\Index\OrderRepository;
use Auth;

/**
 * Class OrderService
 * @package App\Service\Index
 */
class OrderService
{
    /**
     * @var DealRepository
     */
    public $dealRepository;
    /**
     * @var OrderRepository
     */
    public $orderRepository;

    /**
     * OrderService constructor.
     * @param $dealRepository
     */
    public function __construct(DealRepository $dealRepository, OrderRepository $orderRepository)
    {
        $this->dealRepository = $dealRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * 订单入库
     * @param $id
     * @return mixed
     */
    public function indexService($id,$count, $price)
    {
        $deal = $this->dealRepository->find($id);
        if (empty($deal) || $deal->status != 1){
            abort(404, '商品不存在');
        }
        if (empty($_SERVER['HTTP_REFERER'])){
            abort(404, '请求不合法');
        }
        $orderNum = setOrderNum();
        //组装入库数据
        $data = [
            'out_trade_no' => $orderNum,
            'status' => 1,
            'user_id' => Auth::user()->id,
            'username' => Auth::user()->username,
            'deal_id' => $id,
            'deal_count' => intval($count),
            'total_price' => $price,
            'referer' => $_SERVER['HTTP_REFERER'],
        ];
        try{
            $id = $this->orderRepository->creates($data);
        }catch (\Exception $exception){
            abort(404, '订单提交失败');
            return back();
        }
        return $id;
    }

    /**
     * 支付页面
     * @param $id
     * @param $count
     * @return array
     */
    public function confirmService($id,$count)
    {
        $id = $id ? intval($id) : 0;
        if (!$id){
            abort(404, '参数不合法');
        }
        $count = $count ? intval($count) : 1;
        $deal = $this->dealRepository->find($id);
        if (empty($deal) || $deal->status != 1){
            abort(404, '商品不存在');
        }
        $deal = $deal->toArray();
        return [$count, $deal];
    }

    /**
     * 支付状态
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function paystatusService($id)
    {
        $id = $id ? $id : 0;
        if (!$id){
            return response()->json(['status'=>0]);
        }
        $order = $this->orderRepository->whereForm($id);
        if ($order->pay_status == 1 ){
            return response()->json(['status' => 1]);
        }
        return response()->json(['status'=>0]);
    }
}