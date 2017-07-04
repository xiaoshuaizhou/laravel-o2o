<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CityRepository;
use App\Repositories\Bis\AccountRepository;
use App\Repositories\Bis\BisRepository;
use App\Repositories\Bis\LocationRepository;
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
     * @var LocationRepository
     */
    public $locationRepository;

    /**
     * BisController constructor.
     * @param BisRepository $bisRepository
     * @param CityRepository $cityRepository
     * @param CategoryRepository $categoryRepository
     * @param AccountRepository $accountRepository
     * @param LocationRepository $locationRepository
     */
    public function __construct(
        BisRepository $bisRepository,
        CityRepository $cityRepository,
        CategoryRepository $categoryRepository,
        AccountRepository $accountRepository,
        LocationRepository $locationRepository
    )
    {
        $this->bisRepository = $bisRepository;
        $this->cityRepository = $cityRepository;
        $this->accountRepository = $accountRepository;
        $this->categoryRepository = $categoryRepository;
        $this->locationRepository = $locationRepository;
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
        $location = $this->locationRepository->getBisByBisId($id);
        $citys = $this->cityRepository->findCitysByParentId();
        $categorys = $this->categoryRepository->findFirstCategories();
        return view('admin.bis.detail', compact('bis','citys','categorys', 'account', 'location'));
    }
}
