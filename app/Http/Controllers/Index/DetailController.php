<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\CommonController;
use App\Models\Admin\Category;
use App\Models\Admin\Citys;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailController extends CommonController
{
    public function index(Request $request, $id, $city_id, $cat_id)
    {
        $indexfeatured = $this->featured->getNorMalFeaturedByType(0);
        $right = $this->featured->getNorMalFeaturedByType(1);
        $city = Citys::find($city_id);
        $category = Category::find($cat_id);
        $citys = $this->city->getNormalCity();
        $cats = $this->getCats();
        $controller =  'detail';
        $title = '详情页';
        return  view('index.detail', compact('citys', 'city', 'category', 'cats', 'indexfeatured', 'right', 'controller', 'title'));
    }
    private function getCats()
    {
        $categorys = $this->category->getIndexCategoryByParentId(0,5);
        $ids = $sedArr = $recomCat = [];
        foreach ($categorys as $category) {
            $ids[] = $category->id;
        }
        $sedCats = $this->category->getSecondCategoryByParentId($ids);
        foreach ($sedCats as $sedcat) {
            $sedArr[$sedcat->parent_id][] = ['id' => $sedcat->id, 'name' => $sedcat->name];
        }
        foreach ($categorys as $cat) {
            $recomCat[$cat->id] = [$cat->name, empty($sedArr[$cat->id]) ? [] : $sedArr[$cat->id]];
        }

        return $recomCat;
    }
}
