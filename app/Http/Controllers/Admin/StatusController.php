<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    public $Category;
    /**
     * StatusController constructor.
     * @param $Category
     */
    public function __construct(Category $Category) {
        $this->Category = $Category;
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
}
