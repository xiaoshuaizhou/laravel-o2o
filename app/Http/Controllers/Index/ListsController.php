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
        $firstCatIds = [];
        foreach ($categroys as $categroy){
            $firstCatIds[] = $categroy['id'];
        }
        //一级分类
        $data = [];
        if (in_array($id, $firstCatIds)){
            $categoryParentId = $id;
            $data['category_id'] = $id;
        }elseif ($id && !in_array($id, $firstCatIds)){ //二级分类
            $category = $this->categoryRepository->find($id);
            if (!$category || $category->status != 1){
                abort(404, '分类不存在');
            }
            $categoryParentId = $category->parent_id;
            $data['se_category_id'] = $id;
        }else{ //ID = 0
            $categoryParentId = 0;
        }
        $secondCategorys = [];
        if ($categoryParentId){
            $secondCategorys = $this->categoryRepository->findFirstCategories($categoryParentId);
        }
        $orderflag = '';
        if ($request->order && $request->order == 'order_sales'){
            $orderflag = 'order_sales';
        }
        if ($request->order && $request->order == 'order_price'){
            $orderflag = 'order_price';
        }
        if ($request->order && $request->order == 'order_time'){
            $orderflag = 'order_time';
        }
        $data['city_id'] = $city->id;
        $deals = $this->dealRepository->getDealByConditions($data, $orderflag);

        return view('index.lists', compact('deals', 'orderflag', 'title', 'controller', 'city', 'citys', 'cats', 'categroys', 'secondCategorys', 'id', 'categoryParentId'));
    }
}
