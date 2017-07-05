<?php

namespace App\Service\Index;


use App\Repositories\Admin\CategoryRepository;

class ListService {
    public $categoryRepository;

    /**
     * ListService constructor.
     * @param $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     *
     * @param $categroys
     * @return array
     */
    public function indexService($id, $categroys, $request, $city) {
        $request = app($request);
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
        return [$orderflag, $data, $secondCategorys, $categoryParentId];
    }

}