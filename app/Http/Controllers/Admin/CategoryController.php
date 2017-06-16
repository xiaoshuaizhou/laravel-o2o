<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Admin
 */
class CategoryController extends Controller
{
    public $category;

    /**
     * CategoryController constructor.
     * @param $category
     */
    public function __construct( Category $category) {
        $this->category = $category;
    }

    /**
     * 分类首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $categorys = $this->category->getSonsCategoryes();
        return view('admin.category.index', compact('categorys'));
    }

    /**
     * 添加分类
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add() {
        $firstCategories = $this->category->getFistCategories();
        return view('admin.category/add', compact('firstCategories'));
    }

    /**
     * 添加分类
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $data = [
            'listorder' => 0,
            'status' => 1,
        ];
        $this->category->create(array_merge($request->all(), $data));
        return back();
    }
    /**
     * 获取子分类
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSonsCategorys($id) {
        $categorys = $this->category->getSonsCategoryes($id);
        return view('admin.category.index', compact('categorys'));
    }
    /**
     * 编辑分类
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) {
        $category = $this->category->getCategoryById($id);
        $categorys = $this->category->getFistCategories();
        return view('admin.category.edit', compact(['category','categorys']));
    }
    /**
     * 编辑分类逻辑
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {
        $category = $this->category->getCategoryById(request('id'));
        $category->update($request->all());

        return back();
    }

    public function delete($id) {
        $category = $this->category->getCategoryById($id);
        $data = ['status' => -1];
        $category->update($data);

        return back();
    }
}
