<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BisRequest;
use App\Models\Bis\Bis;
use App\Models\Bis\Location;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CityRepository;
use App\Repositories\Bis\AccountRepository;
use App\Repositories\Bis\BisRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class BisController
 * @package App\Http\Controllers\Admin
 */
class BisController extends Controller
{
    /**
     * @var BisRepository
     */
    public $bisRepository;
    /**
     * @var CityRepository
     */
    public $cityRepository;
    /**
     * @var CategoryRepository
     */
    public $categoryRepository;
    /**
     * @var AccountRepository
     */
    public $accountRepository;
    /**
     * @var Location
     */
    public $location;
    /**
     * BisController constructor.
     * @param $bis
     */
    public function __construct(
        BisRepository $bisRepository,
        CityRepository $cityRepository,
        CategoryRepository $categoryRepository,
        AccountRepository $accountRepository,
        Location $location
    )
    {
        $this->bisRepository = $bisRepository;
        $this->cityRepository = $cityRepository;
        $this->accountRepository = $accountRepository;
        $this->categoryRepository = $categoryRepository;
        $this->location = $location;
    }

    /**
     * 商户列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $biss = $this->bisRepository->getBisByStatus(1);
        return view('admin.bis.apply', compact('biss'));
    }
    /**
     * 商户申请列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function apply()
    {
        $biss = $this->bisRepository->getBisByStatus(0);
        return view('admin.bis.apply', compact('biss'));
    }

    /**
     * 删除的商户
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destory()
    {
        $biss = $this->bisRepository->getBisByStatus(2);
        return view('admin.bis.dellist', compact('biss'));
    }

    /**
     * 查看商户申请信息
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id)
    {
        $bis = $this->bisRepository->getBisById($id);
        $account = $this->accountRepository->getBisByBisId($id);
        $location = $this->location->getBisByBisId($id);
        $citys = $this->cityRepository->findCitysByParentId();
        $categorys = $this->categoryRepository->findFirstCategories();
        return view('admin.bis.detail', compact('bis','citys','categorys', 'account', 'location'));
    }
}
