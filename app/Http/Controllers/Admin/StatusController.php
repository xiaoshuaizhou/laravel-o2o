<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserChangeStatus;
use App\Events\UserRegister;
use App\Models\Bis\Bis;
use App\Models\Bis\Deal;
use App\Models\Bis\Featured;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CityRepository;
use App\Repositories\Bis\BisRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    public $categoryRepository;
    public $cityRepository;
    public $bisRepository;
    public $deal;
    public $featured;
    /**
     * StatusController constructor.
     * @param $Category
     */
    public function __construct(
            CategoryRepository $categoryRepository,
            CityRepository $cityRepository,
            Deal $deal,
            BisRepository $bisRepository,
            Featured $featured
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->cityRepository = $cityRepository;
        $this->bisRepository = $bisRepository;
        $this->deal = $deal;
        $this->featured = $featured;
    }
    /**
     * 修改分类状态
     * @param Request $request
     * @param $id
     * @param $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request, $id, $status) {
        $this->validate($request, [
                $id => 'numeric',
                $status => 'in:0,1,-1',
        ]);
        $this->categoryRepository->changStatus($id, $status);
        return back();
    }
    /**
     * 修改分类状态
     * @param Request $request
     * @param $id
     * @param $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function dealIndex(Request $request, $id, $status) {
        $this->validate($request, [
                $id => 'numeric',
                $status => 'in:0,1,-1',
        ]);
        $this->deal->changStatus($id, $status);
        return back();
    }
    /**
     * 修改城市状态
     * @param Request $request
     * @param $id
     * @param $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function city(Request $request, $id, $status) {
        $this->validate($request, [
                $id => 'numeric',
                $status => 'in:0,1,-1',
        ]);
        $this->cityRepository->changStatus($id, $status);
        return back();
    }

    /**
     * 商户申请修改状态
     * @param Request $request
     * @param $id
     * @param $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bis(Request $request, $id, $status)
    {
        $this->validate($request, [
            $id => 'numeric',
            $status => 'in:0,1,-1',
        ]);
        $this->bisRepository->changStatus($id, $status);
        //邮件通知商户
        $this->bisRepository->whereForm($id);
            event(new UserChangeStatus($this->bisRepository->latestFirst()));
        return back();
    }

    /**
     * 商户删除的状态
     * @param Request $request
     * @param $id
     * @param $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destory(Request $request , $id, $status)
    {
        $this->validate($request, [
            $id => 'numeric',
            $status => 'in:0,1,-1,2',
        ]);
        $this->bisRepository->changStatusDel($id, $status);
        event(new UserChangeStatus($this->bisRepository->latestFirst()));

        return back();
    }

    /**
     * 推荐位修改状态
     * @param $id
     * @param $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function featuredstatus(Request $request, $id, $status)
    {
        $this->validate($request, [
            $id => 'numeric',
            $status => 'in:0,1,-1',
        ]);
        $this->featured->changStatus($id, $status);
        return back();
    }
}
