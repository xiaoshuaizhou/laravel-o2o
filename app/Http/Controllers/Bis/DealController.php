<?php

namespace App\Http\Controllers\Bis;

use App\Models\Bis\Location;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CityRepository;
use App\Repositories\Bis\AccountRepository;
use App\Repositories\Bis\DealRepository;
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
     * @var Location
     */
    public $location;
    /**
     * @var DealRepository
     */
    public $dealRepository;

    /**
     * DealController constructor.
     * @param AccountRepository $accountRepository
     * @param CityRepository $cityRepository
     * @param CategoryRepository $categoryRepository
     * @param Location $location
     * @param DealRepository $dealRepository
     */
    public function __construct(
            AccountRepository $accountRepository,
            CityRepository $cityRepository,
            CategoryRepository $categoryRepository,
            Location $location,
            DealRepository $dealRepository
    ) {
        $this->cityRepository = $cityRepository;
        $this->categoryRepository = $categoryRepository;
        $this->accountRepository = $accountRepository;
        $this->location = $location;
        $this->dealRepository = $dealRepository;
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
        if (empty($location)){
            abort(404, '分店不存在，请联系主管理员');
        }
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
            'notes' => htmlentities($request->notes),
            'description' => htmlentities($request->description),
            'account_id' => $this->accountRepository->whereFormBisId($bisId)->id,
            'xpoint' => $location->xpoint,
            'ypoint' => $location->ypoint,
        ];
        $this->dealRepository->create($data);
        return back();
    }
}
