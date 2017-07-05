<?php

namespace App\Http\Controllers\Index;
use App\Service\Index\PayService;
use App\Http\Controllers\Controller;
/**
 * Class PayController
 * @package App\Http\Controllers\Index
 */
class PayController extends Controller
{
    /**
     * @var PayService
     */
    public $payService;

    /**
     * PayController constructor.
     * @param PayService $payService
     */
    public function __construct(PayService $payService) {
        $this->payService = $payService;
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
        $data = $this->payService->indexService($id);
        $deal = $data[0];
        $order = $data[1];
        $url = $data[2];
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
