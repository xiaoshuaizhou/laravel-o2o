<?php

namespace App\Http\Controllers\Bis;

use App\Http\Requests\LocationRequest;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CityRepository;
use App\Repositories\Bis\LocationRepository;
use App\Service\Bis\LocationService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class LocaltionController
 * @package App\Http\Controllers\Bis
 */
class LocaltionController extends Controller
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
     * @var LocationRepository
     */
    public $locationRepository;
    /**
     * @var
     */
    public $locationService;
    /**
     * LocaltionController constructor.
     * @param CityRepository $cityRepository
     * @param CategoryRepository $categoryRepository
     * @param LocationRepository $locationRepository
     */
    public function __construct(
            CityRepository $cityRepository,
            CategoryRepository $categoryRepository,
            LocationRepository $locationRepository,
            LocationService $locationService
    ) {
        $this->cityRepository = $cityRepository;
        $this->categoryRepository = $categoryRepository;
        $this->locationRepository = $locationRepository;
        $this->locationService = $locationService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $locations = $this->locationRepository->getBisByIsMain();
        return view('bis.location.index', compact('locations'));
    }
    /**
     * 添加分店
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        $citys = $this->cityRepository->findCitysByParentId();
        $categorys = $this->categoryRepository->findFirstCategories();
        return view('bis.location.add', compact('citys', 'categorys'));
    }
    /**
     * 实现添加分店
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LocationRequest $request) {
        //校验数据 request

        $this->locationService->store(Request::class);
        return back();
    }

    /**
     * 查看
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) {
        $citys = $this->cityRepository->findCitysByParentId();
        $categorys = $this->categoryRepository->findFirstCategories();
        $location = $this->locationRepository->find($id);
        return view('bis.location.edit', compact('citys', 'categorys', 'location'));
    }

    /**
     * 分店下架
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destory($id) {
        $this->locationRepository->destory($id);
        return back();
    }
}
