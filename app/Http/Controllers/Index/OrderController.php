<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\CommonController;
use App\Models\Admin\Category;
use App\Models\Admin\Citys;
use App\Models\Bis\Bis;
use App\Models\Bis\Deal;
use App\Models\Bis\Featured;
use App\Models\Bis\Location;
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
    public function __construct(Citys $citys, Category $category, Featured $featured, Deal $deal, Location $location, Bis $bis) {
        parent::__construct($citys, $category, $featured, $deal, $location, $bis);
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
        if (!$id){
            abort(404, '参数不合格');
        }
        $count = $count ? intval($count) : 1;
        $deal = $this->deal->find($id);
        if (empty($deal) || $deal->status != 1){
            abort(404, '商品不存在');
        }

        return view('index.confirm', compact('title', 'controller', 'city', 'citys', 'cats', 'deal', 'count'));
    }
}
