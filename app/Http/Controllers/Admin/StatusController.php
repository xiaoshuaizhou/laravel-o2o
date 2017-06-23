<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserChangeStatus;
use App\Events\UserRegister;
use App\Models\Admin\Category;
use App\Models\Admin\Citys;
use App\Models\Bis\Bis;
use App\Models\Bis\Deal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    public $Category;
    public $City;
    public $bis;
    public $deal;
    /**
     * StatusController constructor.
     * @param $Category
     */
    public function __construct(
            Category $Category,
            Citys $citys,
            Deal $deal,
            Bis $bis
    ) {
        $this->Category = $Category;
        $this->City = $citys;
        $this->bis = $bis;
        $this->deal = $deal;
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
        $this->Category->changStatus($id, $status);
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
        $this->City->changStatus($id, $status);
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
        $this->bis->changStatus($id, $status);
        //邮件通知商户
        $this->bis->where('id', $id)->first();
            event(new UserChangeStatus($this->bis->latest()->first()));
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
        $this->bis->changStatusDel($id, $status);
        event(new UserChangeStatus($this->bis->latest()->first()));

        return back();
    }
}
