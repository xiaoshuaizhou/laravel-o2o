<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;

class ListsController extends CommonController
{
    /**
     * 商品分类
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $id) {
        $title = '团购网';
        $city = session('city');
        $citys = session('citys');
        $cats = session('cats');
        $controller = 'lists';
        $categroys = $this->categoryRepository->findFirstCategories()->toArray();
        $data = $this->listService->indexService($id, $categroys, Request::class, $city);
        $orderflag = $data[0];
        $secondCategorys = $data[2];
        $categoryParentId = $data[3];
        $data = $data[1];
        $deals = $this->dealRepository->getDealByConditions($data, $orderflag);

        return view('index.lists', compact('deals', 'orderflag', 'title', 'controller', 'city', 'citys', 'cats', 'categroys', 'secondCategorys', 'id', 'categoryParentId'));
    }
}
