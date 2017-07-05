<?php

namespace App\Http\Controllers\Bis;

use App\Http\Requests\BisRequest;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CityRepository;
use App\Repositories\Bis\AccountRepository;
use App\Repositories\Bis\DealRepository;
use App\Repositories\Bis\LocationRepository;
use App\Service\Bis\DealService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class DealController
 * @package App\Http\Controllers\Bis
 */
class DealController extends Controller
{
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
     * @var DealRepository
     */
    public $dealRepository;
    /**
     * @var DealService
     */
    public $dealService;

    /**
     * DealController constructor.
     * @param AccountRepository $accountRepository
     * @param CityRepository $cityRepository
     * @param CategoryRepository $categoryRepository
     * @param LocationRepository $locationRepository
     * @param DealRepository $dealRepository
     * @param DealService $dealService
     */
    public function __construct(
            AccountRepository $accountRepository,
            CityRepository $cityRepository,
            CategoryRepository $categoryRepository,
            LocationRepository $locationRepository,
            DealRepository $dealRepository,
            DealService $dealService
    ) {
        $this->cityRepository = $cityRepository;
        $this->categoryRepository = $categoryRepository;
        $this->accountRepository = $accountRepository;
        $this->locationRepository = $locationRepository;
        $this->dealRepository = $dealRepository;
        $this->dealService = $dealService;
    }

    /**
     * 团购列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $deals = $this->dealRepository->getNormalDeals();
        return view('bis.deal.index',compact('deals'));
    }

    /**
     * 添加团购商品
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        $bisId = session('bisuser')->bis_id;
        $citys = $this->cityRepository->findCitysByParentId();
        $categorys = $this->categoryRepository->findFirstCategories();
        $bisLocations = $this->locationRepository->getBisByBisIds($bisId);
        return view('bis.deal.add', compact('citys', 'categorys', 'bisLocations'));
    }

    /**
     * 添加团购商品
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request) {
        $this->dealService->create(Request::class);
        return back();
    }
}
