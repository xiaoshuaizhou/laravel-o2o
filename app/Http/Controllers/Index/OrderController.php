<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\CommonController;
use App\Models\Admin\Category;
use App\Models\Admin\Citys;
use App\Models\Bis\Bis;
use App\Models\Bis\Deal;
use App\Models\Bis\Featured;
use App\Models\Bis\Location;
use App\Models\Index\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends CommonController
{
    /**
     * OrderController constructor.
     * @param Citys $citys
     * @param Category $category
     * @param Featured $featured
     * @param Deal $deal
     * @param Location $location
     * @param Bis $bis
     */
    public function __construct(Citys $citys, Category $category, Featured $featured, Deal $deal, Location $location, Bis $bis, Order $order) {
        parent::__construct($citys, $category, $featured, $deal, $location, $bis, $order);
        $this->middleware('auth');
    }

    /**
     * 支付页面
     * @param $id
     * @param $count
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirm($id,$count) {
        $title = '支付页';
        $controller = 'pay';
        $city = session('city');
        $citys = session('citys');
        $cats = session('cats');
        $id = $id ? intval($id) : 0;
        if (!$id){
            abort(404, '参数不合法');
        }
        $count = $count ? intval($count) : 1;
        $deal = $this->deal->find($id);
        if (empty($deal) || $deal->status != 1){
            abort(404, '商品不存在');
        }
        $deal = $deal->toArray();
        return view('index.confirm', compact('title', 'controller', 'city', 'citys', 'cats', 'deal', 'count'));
    }

    /**
     * 订单入库
     * @param $id
     * @param $count
     * @param $price
     */
    public function index($id, $count, $price) {
        $deal = $this->deal->find($id);
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
            'user_id' => \Auth::user()->id,
            'username' => \Auth::user()->username,
            'deal_id' => $id,
            'deal_count' => intval($count),
            'total_price' => $price,
            'referer' => $_SERVER['HTTP_REFERER'],
        ];
            try{
                $id = $this->order->creates($data);
            }catch (\Exception $exception){
                abort(404, '订单提交失败');
            }
            return redirect(url('index/pay', ['id'=> $id]));
    }

}
