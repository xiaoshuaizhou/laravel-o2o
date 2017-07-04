<?php

namespace App\Http\Controllers\Index;

use App\Models\Bis\Deal;
use App\Repositories\Index\OrderRepository;
use App\Wxpay\Database\WxPayUnifiedOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
/**
 * Class PayController
 * @package App\Http\Controllers\Index
 */
class PayController extends Controller
{
    public $orderRepository;
    /**
     * PayController constructor.
     */
    public function __construct(OrderRepository $orderRepository) {
        $this->orderRepository = $orderRepository;
        $this->middleware('auth');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id) {
        $title = '支付页';
        $controller = '';
        $city = session('city');
        $citys = session('citys');
        $cats = session('cats');

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
        $deal = Deal::where('id', $order->deal_id)->first();
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

        return view('index.payindex', compact('title', 'controller', 'city', 'citys', 'cats', 'order', 'deal', 'url'));
    }

    /**
     * 支付状态
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function paysuccess() {
        $title = '支付页';
        $controller = '';
        $city = session('city');
        $citys = session('citys');
        $cats = session('cats');
        return view('index.paysuccess',compact('title', 'controller', 'citys', 'city', $cats));
    }
}
