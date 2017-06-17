<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Citys;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Overtrue\Pinyin\Pinyin;
class CitysController extends Controller
{
    public $city;

    /**
     * CitysController constructor.
     * @param $city
     */
    public function __construct(Citys $city) {
        $this->city = $city;
    }

    /**
     * 城市管理首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $citys = $this->city->getCitysByParentId();
        return view('admin.city.index',compact('citys'));
    }

    /**
     * 添加城市
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add() {
        $citys = $this->city->getCitysByParentId();
        return view('admin.city.add',compact('citys'));
    }

    /**
     * 添加城市逻辑
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $pinyin = new Pinyin();
        $data = [
            'uname' => $pinyin->sentence(request('name')),
            'listorder' => 0,
            'status' => 1,
            'is_default' => 0
        ];
        $this->city->create(array_merge($request->all(), $data));
        return back();
    }

    /**
     * 编辑城市
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) {
        $city = $this->city->getCityById($id);
        $citys = $this->city->getCitysByParentId();
        return view('admin.city.edit',compact(['city','citys']));
    }

    /**
     * 编辑城市
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {
        $this->city->updateCityById($request->all());
        return back();
    }
    /**
     * 获取二级城市
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSonsCitys($id) {
        $citys = $this->city->getCitysByParentId($id);
        return view('admin.city.index',compact('citys'));
    }

    /**
     * 删除城市（状态改成-1）
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id) {
        $data = ['status' => -1];
        $city = $this->city->find($id);
        $city->update($data);

        return back();
    }

    /**
     * 根据listorder排序   ajax异步
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listorder(Request $request)
    {
        $id = $request->get('id');
        $listorder = $request->get('listorder');
        $state = $this->city->listorder($id, $listorder);
        return  $state ?  response()->json(['msg' => 'success']) :  response()->json(['msg' => 'error']);
    }
}
