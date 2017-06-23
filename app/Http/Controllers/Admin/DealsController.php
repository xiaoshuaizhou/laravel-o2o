<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Category;
use App\Models\Admin\Citys;
use App\Models\Bis\Account;
use App\Models\Bis\Bis;
use App\Models\Bis\Deal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Toplan\FilterManager\Facades\FilterManager;

class DealsController extends Controller
{
    public $city;
    public $category;
    public $deal;
    /**
     * DealsController constructor.
     * @param $city
     */
    public function __construct(
            Citys $city,
            Category $category,
            Deal $deal

    )
    {
        $this->city = $city;
        $this->category = $category;
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
            if (!empty($request->category_id)){
                $sdata['category_id'] = $request->category_id;
            }
            if (!empty($request->city_id)){
                $sdata['city_id'] = $request->city_id;
            }
            if (!empty($request->name) ){
                $name = $request->name;
                $deals = $this->deal->when($name, function ($query) use ($name) {
                            return $query->where('name', 'like', '%'.$name.'%' );
                        })
                        ->get();
            }
            if (!empty($request->shangjianame)){
                $bis = Bis::where('name', 'like', '%'.$request->shangjianame.'%')->first();
                if (empty($bis)) abort(404,'商户名不存在');
                $sdata['bis_id'] = $bis->id;
            }
            $time_data = [];
            if ($request->start_time && $request->end_time && strtotime($request->end_time) > strtotime($request->start_time )){
                $time_data['start_time'] = $request->start_time;
                $time_data['end_time'] = $request->end_time;
            }
            $deals = $this->deal->getNormalDealsByWhere($sdata,$time_data);
        }else {
            $deals = $this->deal->getNormalDeals();
        }
        $citys = $this->city->getNormalCity();
        $categorys = $this->category->findFirstCategories();
        return view('admin.deal.index', compact('citys', 'categorys', 'deals'));
    }
}
