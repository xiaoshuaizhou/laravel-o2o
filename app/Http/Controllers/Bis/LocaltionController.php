<?php

namespace App\Http\Controllers\Bis;

use App\Api\Map;
use App\Models\Bis\Location;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CityRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocaltionController extends Controller
{
    public $cityRepository;
    public $categoryRepository;
    public $location;

    /**
     * LocaltionController constructor.
     * @param CityRepository $cityRepository
     * @param CategoryRepository $categoryRepository
     * @param Location $location
     */
    public function __construct(
            CityRepository $cityRepository,
            CategoryRepository $categoryRepository,
            Location $location
    ) {
        $this->cityRepository = $cityRepository;
        $this->categoryRepository = $categoryRepository;
        $this->location = $location;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $locations = $this->location->getBisByIsMain();
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
    public function store(Request $request) {
                //校验数据 request
        //获取经纬度
        $lnglat = Map::getLngLat($request->address);
        if (empty($lnglat) || $lnglat['status'] != 0 || $lnglat['result']['precise'] != 1){
            abort(404,'获取位置失败');
        }
        $data['cat'] = '';
        if (!empty($request->se_category_id)) {
            $data['cat'] = implode('|', $request->se_category_id);
        }
        $bisId = session('bisuser')->bis_id;
        $locationData = [
                'bis_id' => $bisId,
                'tel' => $request->tel,
                'logo' => $request->logo,
                'name' => $request->name,
                'contact' => $request->contact,
                'category_id' => $request->category_id,
                'category_path' => $request->category_id . ',' . $data['cat'],
                'city_id' => $request->city_id,
                'city_path' => empty($request->se_city_id) ? $request->city_id : $request->city_id . ',' . $request->se_city_id,
                'address' => $request->address,
                'api_address' => $request->address,
                'open_time' => $request->open_time,
                'content' => empty($request->content) ? '' : $request->content,
                'is_main' => 0, //分店
                'xpoint' => empty($lnglat['result']['location']['lng']) ? '' : $lnglat['result']['location']['lng'],
                'ypoint' => empty($lnglat['result']['location']['lat']) ? '' : $lnglat['result']['location']['lat'],
                'bank_info' => $request->bank_info,
        ];
        $this->location->create($locationData);
        return back();
    }

    /**
     * 查看
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) {
        $citys = $this->cityRepository->findCitysByParentId();
        $categorys = $this->categoryRepository->findFirstCategories();
        $location = $this->location->find($id);
        return view('bis.location.edit', compact('citys', 'categorys', 'location'));
    }

    /**
     * 分店下架
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destory($id) {
        $this->location->destory($id);
        return back();
    }
}
