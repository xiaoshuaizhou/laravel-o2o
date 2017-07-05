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
use App\Service\Index\OrderService;

class OrderController extends CommonController
{
    /**
     * @var OrderService
     */
    public $orderService;
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
            ListService $listService,
            OrderService $orderService
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
        $this->orderService = $orderService;
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
        $data = $this->orderService->confirmService($id, $count);
        $count = $data[0];
        $deal = $data[1];
        return view('index.confirm', compact('title', 'controller', 'city', 'citys', 'cats', 'deal', 'count'));
    }
    /**
     * 订单入库
     * @param $id
     * @param $count
     * @param $price
     */
    public function index($id, $count, $price) {
        $this->orderService->indexService($id, $count, $price);
        return redirect(url('index/pay', ['id'=> $id]));
    }

    /**
     * 判断支付状态
     * @return \Illuminate\Http\JsonResponse
     */
    public function paystatus() {
        return $this->orderService->paystatusService(request('id'));
    }

}
