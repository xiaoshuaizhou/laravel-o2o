<?php

namespace App\Http\Controllers\Bis;

use App\Models\Admin\Category;
use App\Models\Admin\Citys;
use App\Models\Bis\Account;
use App\Models\Bis\Deal;
use App\Models\Bis\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DealController extends Controller
{
    public $city;
    public $category;
    public $location;
    public $deal;
    /**
     * DealController constructor.
     * @param $city
     */
    public function __construct(
            Citys $city,
            Category $category,
            Location $location,
            Deal $deal
    ) {
        $this->city = $city;
        $this->category = $category;
        $this->location = $location;
        $this->deal = $deal;
    }

    /**
     * 团购列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('bis.deal.index');
    }

    /**
     * 添加团购商品
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        $bisId = session('bisuser')->bis_id;
        $citys = $this->city->findCitysByParentId();
        $categorys = $this->category->findFirstCategories();
        $bisLocations = $this->location->getBisByBisIds($bisId);
        return view('bis.deal.add', compact('citys', 'categorys', 'bisLocations'));
    }

    /**
     * 添加团购商品
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request) {
        $bisId = session('bisuser')->bis_id;
        $location = $this->location->find($request->location_ids[0]);
        $data = [
            'bis_id' => $bisId,
            'name' => $request->name,
            'image' => $request->image,
            'category_id' => $request->category_id,
            'se_category_id' => empty($request->category_id) ? '' : implode(',', $request->se_category_id),
            'city_id' => $request->city_id,
            'location_ids' => empty($request->location_ids) ? '' : implode(',', $request->location_ids),
            'start_time' => ($request->start_time),
            'end_time' => ($request->end_time),
            'total_count' => $request->total_count,
            'origin_price' => $request->origin_price,
            'current_price' => $request->current_price,
            'coupons_begin_time' => ($request->coupons_begin_time),
            'coupons_end_time' => ($request->coupons_end_time),
            'notes' => $request->notes,
            'description' => $request->description,
            'account_id' => Account::where('bis_id', $bisId)->first()->id,
            'xpoint' => $location->xpoint,
            'ypoint' => $location->ypoint,
        ];
        $this->deal->create($data);
        return back();
    }
}
