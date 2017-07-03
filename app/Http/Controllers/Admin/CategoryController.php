<?php

namespace App\Http\Controllers\Admin;

use App\Mailer\UserMailer;
use App\Repositories\Admin\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Admin
 */
class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    public $categoryRepository;

    /**
     * CategoryController constructor.
     * @param $category
     */
    public function __construct( CategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * 分类首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $categorys = $this->categoryRepository->getSonsCategoryes();
        return view('admin.category.index', compact('categorys'));
    }

    /**
     * 添加分类
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add() {
        $firstCategories = $this->categoryRepository->getFistCategories();
        return view('admin.category/add', compact('firstCategories'));
    }

    /**
     * 添加分类
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $this->categoryRepository->create($request->all());
        return back();
    }
    /**
     * 获取子分类
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSonsCategorys($id) {
        $categorys = $this->categoryRepository->getSonsCategoryes($id);
        return view('admin.category.index', compact('categorys'));
    }
    /**
     * 编辑分类
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) {
        $category = $this->categoryRepository->getCategoryById($id);
        $categorys = $this->categoryRepository->getFistCategories();
        return view('admin.category.edit', compact(['category','categorys']));
    }
    /**
     * 编辑分类逻辑
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {
        $category = $this->categoryRepository->getCategoryById(request('id'));
        $category->update($request->all());

        return back();
    }
    /**
     * 删除分类（将状态修改成-1）
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id) {
        $category = $this->categoryRepository->getCategoryById($id);
        $data = ['status' => -1];
        $category->update($data);

        return back();
    }

    /**
     * 根据listorder排序（ajax）
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listorder(Request $request)
    {
        $id = $request->get('id');
        $listorder = $request->get('listorder');
        $state = $this->categoryRepository->listorder($id, $listorder);
        return $state ? response()->json(['msg'=>'success']) : response()->json(['msg'=>'error']);
    }

    /**
     * 测试方法
     * @return bool
     */
    public function test() {
        return UserMailer::send('zhouxiaoshuai3@gmail.com', 'title', 'content');
    }
}
