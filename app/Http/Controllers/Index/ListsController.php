<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $categroys = $this->category->findFirstCategories()->toArray();
        $firstCatIds = [];
        foreach ($categroys as $categroy){
            $firstCatIds[] = $categroy['id'];
        }
        //一级分类
        if (in_array($id, $firstCatIds)){
            $categoryParentId = $id;
        }elseif ($id && !in_array($id, $firstCatIds)){ //二级分类
            $category = $this->category->find($id);
            if (!$category || $category->status != 1){
                abort(404, '分类不存在');
            }
            $categoryParentId = $category->parent_id;
        }else{ //ID = 0
            $categoryParentId = 0;
        }
        $secondCategorys = [];
        if ($categoryParentId){
            $secondCategorys = $this->category->findFirstCategories($categoryParentId);
        }
        $orderflag = '';
        if ($request->order && $request->order == 1){
            $orderflag = 'order_sales';
        }
        if ($request->order && $request->order == 2){
            $orderflag = 'order_price';
        }
        if ($request->order && $request->order == 3){
            $orderflag = 'order_time';
        }
        //销量排序
//        if ($order == 1){
//
//        }


        return view('index.lists', compact('orderflag', 'title', 'controller', 'city', 'citys', 'cats', 'categroys', 'secondCategorys', 'id', 'categoryParentId'));
    }
}
