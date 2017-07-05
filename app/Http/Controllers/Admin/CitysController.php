<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Admin\CityRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class CitysController
 * @package App\Http\Controllers\Admin
 */
class CitysController extends Controller
{
    /**
     * @var CityRepository
     */
    public $cityRepository;

    /**
     * CitysController constructor.
     * @param CityRepository $cityRepository
     */
    public function __construct(CityRepository $cityRepository) {
        $this->cityRepository = $cityRepository;
    }

    /**
     * 城市管理首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $citys = $this->cityRepository->getCitysByParentId();
        return view('admin.city.index',compact('citys'));
    }

    /**
     * 添加城市
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add() {
        $citys = $this->cityRepository->getCitysByParentId();
        return view('admin.city.add',compact('citys'));
    }

    /**
     * 添加城市逻辑
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $this->cityRepository->created($request->all());
        return back();
    }

    /**
     * 编辑城市
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) {
        $city = $this->cityRepository->getCityById($id);
        $citys = $this->cityRepository->getCitysByParentId();
        return view('admin.city.edit',compact(['city','citys']));
    }

    /**
     * 编辑城市
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {
        $this->cityRepository->updateCityById($request->all());
        return back();
    }
    /**
     * 获取二级城市
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSonsCitys($id) {
        $citys = $this->cityRepository->getCitysByParentId($id);
        return view('admin.city.index',compact('citys'));
    }

    /**
     * 删除城市（状态改成-1）
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id) {
        $this->cityRepository->deleteCityStatusById($id);
        return back();
    }
    /**
     * 根据listorder排序   ajax异步
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listorder(Request $request)
    {
        $state = $this->cityRepository->listorder($request->get('id'), $request->get('listorder'));
        return  $state ?  response()->json(['msg' => 'success']) :  response()->json(['msg' => 'error']);
    }
}
