<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bis\Bis;
use App\Models\Bis\Deal;
use App\Models\Bis\Location;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CityRepository;
use App\Repositories\Bis\BisRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Toplan\FilterManager\Facades\FilterManager;

class DealsController extends Controller
{
    public $cityRepository;
    public $categoryRepository;
    public $bisRepository;
    public $deal;
    /**
     * DealsController constructor.
     * @param $city
     */
    public function __construct(
            BisRepository $bisRepository,
            CityRepository $cityRepository,
            CategoryRepository $categoryRepository,
            Deal $deal
    )
    {
        $this->cityRepository = $cityRepository;
        $this->categoryRepository = $categoryRepository;
        $this->bisRepository = $bisRepository;
        $this->deal = $deal;
    }

    /**
     * 团购列表 多条件查询
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->isMethod('post')){
            $sdata = [];
            $sdataname = [];
            if (!empty($request->category_id)){
                $sdata['category_id'] = $request->category_id;
            }
            if (!empty($request->city_id)){
                $sdata['city_id'] = $request->city_id;
            }
            if (!empty($request->name)) {
                $sdataname['name'] = $request->name;
            }
            if (!empty($request->shangjianame)){
                $bis = $this->bisRepository->whereFormNameLike($request->shangjianame);
                if (empty($bis)) abort(404,'商户名不存在');
                $sdata['bis_id'] = $bis->id;
            }
            $time_data = [];
            if ($request->start_time && $request->end_time && strtotime($request->end_time) > strtotime($request->start_time )){
                $time_data['start_time'] = $request->start_time;
                $time_data['end_time'] = $request->end_time;
            }
            $deals = $this->deal->getNormalDealsByWhere($sdata, $sdataname, $time_data);
        }else {
            $deals = $this->deal->getNormalDeals();
        }
        $citys = $this->cityRepository->getNormalCity();
        $categorys = $this->categoryRepository->findFirstCategories();
        return view('admin.deal.index', compact('citys', 'categorys', 'deals'));
    }

    /**
     * 待审核的团购商品
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function review(Request $request) {
        if ($request->isMethod('post')){
            $sdata = [];
            $sdataname = [];
            if (!empty($request->category_id)){
                $sdata['category_id'] = $request->category_id;
            }
            if (!empty($request->city_id)){
                $sdata['city_id'] = $request->city_id;
            }
            if (!empty($request->name)) {
                $sdataname['name'] = $request->name;
            }
            if (!empty($request->shangjianame)){
                $bis = $this->bisRepository->whereFormNameLike($request->shangjianame);
                if (empty($bis)) abort(404,'商户名不存在');
                $sdata['bis_id'] = $bis->id;
            }
            $time_data = [];
            if ($request->start_time && $request->end_time && strtotime($request->end_time) > strtotime($request->start_time )){
                $time_data['start_time'] = $request->start_time;
                $time_data['end_time'] = $request->end_time;
            }
            $deals = $this->deal->getNormalDealsByWhere($sdata, $sdataname, $time_data,0);
        }else {
            $deals = $this->deal->getNormalDealsReview();
        }
        $citys = $this->cityRepository->getNormalCity();
        $categorys = $this->categoryRepository->findFirstCategories();

        return view('admin.deal.review', compact('citys', 'categorys', 'deals'));
    }

    /**
     * 团购商品编辑
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) {
        $deal = $this->deal->getNormalDealById($id);
        $citys = $this->cityRepository->getNormalCity();
        $categorys = $this->categoryRepository->findFirstCategories();
        $location = Location::where('bis_id', $deal->bis_id)->first();
        return view('admin.deal.edit', compact('citys', 'categorys', 'deal', 'location'));
    }

    /**
     * 编辑团购商品
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {
        $this->deal->updateById($request->all());
        return back();
    }

    /**
     * 团购商品下架
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destory($id)
    {
        $this->deal->deleteDealById($id);
        return back();
    }
}
