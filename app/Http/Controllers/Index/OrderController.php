<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\CommonController;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CityRepository;
use App\Repositories\Bis\BisRepository;
use App\Repositories\Bis\DealRepository;
use App\Repositories\Bis\FeaturedRepository;
use App\Repositories\Bis\LocationRepository;
use App\Repositories\Index\OrderRepository;
use App\Service\Index\DetailService;
use App\Service\Index\ListService;
use Illuminate\Http\Request;
use Auth;

class OrderController extends CommonController
{
    /**
     * OrderController constructor.
     * @param CityRepository $cityRepository
     * @param CategoryRepository $categoryRepository
     * @param FeaturedRepository $featuredRepository
     * @param DealRepository $dealRepository
     * @param LocationRepository $locationRepository
     * @param BisRepository $bisRepository
     * @param OrderRepository $orderRepository
     */
    public function __construct(
            CityRepository $cityRepository,
            CategoryRepository $categoryRepository,
            FeaturedRepository $featuredRepository,
            DealRepository $dealRepository,
            LocationRepository $locationRepository,
            BisRepository $bisRepository,
            OrderRepository $orderRepository,
            DetailService $detailService,
            ListService $listService
    ) {
        parent::__construct(
                $cityRepository,
                $categoryRepository,
                $featuredRepository,
                $dealRepository,
                $locationRepository,
                $bisRepository,
                $orderRepository,
                $detailService,
                $listService
        );
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
        $deal = $this->dealRepository->find($id);
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
        }
        return redirect(url('index/pay', ['id'=> $id]));
    }

    /**
     * 判断支付状态
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function paystatus(Request $request) {
        $id = request('id');
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
