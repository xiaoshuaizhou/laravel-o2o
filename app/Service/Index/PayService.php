<?php

namespace App\Service\Index;


use App\Repositories\Bis\DealRepository;
use App\Repositories\Index\OrderRepository;
use App\Wxpay\Database\WxPayUnifiedOrder;
use Auth;

/**
 * Class PayService
 * @package App\Service\Index
 */
class PayService
{
    /**
     * @var OrderRepository
     */
    public $orderRepository;
    /**
     * @var DealRepository
     */
    public $dealRepository;
    /**
     * PayController constructor.
     */
    public function __construct(
        OrderRepository $orderRepository,
        DealRepository $dealRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->dealRepository = $dealRepository;
    }

    /**
     * @param $id
     * @return array|void
     */
    public function indexService($id)
    {
        if (empty($id)){
            abort(404, '请求不合法，请联系客服');
        }
        $order = $this->orderRepository->whereForm($id);
        if (empty($order) || $order->status != 1 || $order->pay_status != 0){
            return abort(404, '无法进行该操作');
        }
        //订单是否是用户本人提交
        if ($order->username != Auth::user()->username){
            abort(404, '非本人操作，请重新提交');
        }
        $deal = $this->dealRepository->whereForm($order->deal_id);
        //生成支付二维码
        $notify = new \App\Wxpay\NativePay();
        $input = new WxPayUnifiedOrder();
        $input->setBody($deal->name);
        $input->setAttach($deal->name);
        $input->setOutTradeNo($order->out_trade_no);
        $input->setTotalFee($order->total_price*100);
        $input->setTimeStart(date("YmdHis"));
        $input->setTimeExpire(date("YmdHis", time() + 600));
        $input->setGoodsTag("test");
        $input->setNotifyUrl(url('http://zhouxiaoshuai.me/weixinpay/notify')); //微信回调   支付成功后会触发这个url
        $input->setTradeType("NATIVE");
        $input->setProductId($order->id);
        $result = $notify->GetPayUrl($input);
        if (empty($result["code_url"])){
            $url = '';
        }else{
            $url = $result["code_url"];
        }
        return [$deal, $order, $url];
    }
}