<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Category;
use App\Models\Admin\Citys;
use App\Models\Bis\Account;
use App\Models\Bis\Bis;
use App\Models\Bis\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BisController extends Controller
{
    public $bis;
    public $city;
    public $category;
    public $account;
    public $location;
    /**
     * BisController constructor.
     * @param $bis
     */
    public function __construct(
        Bis $bis,
        Citys $citys,
        Category $category,
        Account $account,
        Location $location
    )
    {
        $this->bis = $bis;
        $this->city = $citys;
        $this->account = $account;
        $this->category = $category;
        $this->location = $location;
    }

    /**
     * 商户列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $biss = $this->bis->getBisByStatus(1);
        return view('admin.bis.apply', compact('biss'));
    }
    /**
     * 商户申请列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function apply()
    {
        $biss = $this->bis->getBisByStatus(0);
        return view('admin.bis.apply', compact('biss'));
    }

    /**
     * 删除的商户
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destory()
    {
        $biss = $this->bis->getBisByStatus(-1);
        return view('admin.bis.apply', compact('biss'));
    }

    /**
     * 查看商户申请信息
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id)
    {
        $bis = $this->bis->getBisById($id);
        $account = $this->account->getBisByBisId($id);
        $location = $this->location->getBisByBisId($id);
        $citys = $this->city->findCitysByParentId();
        $categorys = $this->category->findFirstCategories();
        return view('admin.bis.detail', compact('bis','citys','categorys', 'account', 'location'));
    }
}
