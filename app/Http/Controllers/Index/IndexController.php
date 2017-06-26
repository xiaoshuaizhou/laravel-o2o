<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;

/**
 * Class IndexController
 * @package App\Http\Controllers\Index
 */
class IndexController extends CommonController
{
    /**
     * @var
     */
    public $citys;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request) {
        $cityName = $request->city;
        $citys = $this->city->getNormalCity();
        $this->getCity($citys, $cityName);
        $cats = $this->getCats();
        $city = $this->citys;
        session()->put('city', $city);
        session()->put('citys', $citys);
        session()->put('cats', $cats);
        $indexfeatured = $this->featured->getNorMalFeaturedByType(0);
        $right = $this->featured->getNorMalFeaturedByType(1);
        $indexfeatured = $indexfeatured->toArray()['data'];
        $right = $right->toArray()['data'];
        //同时满足分类和城市的条件
        $datas = $this->deal->getDealByCategoryIdAndCityId(5, $this->citys->id);
        if (empty($datas->toArray())){
            abort(404, '当前城市没有数据');
        }
        //获取四个子分类
        $controller = 'index';
        $title = '首页';
        $meishiCategory = $this->category->getIndexCategoryByCategoryId($datas[0]->category_id,4);
        return view('index.index', compact('citys', 'title', 'city', 'cats', 'indexfeatured', 'right', 'datas','meishiCategory', 'controller'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcome() {
        return view('welcomepage');
    }

    /**
     * @param $citys
     * @param $cityName
     */
    public function getCity($citys, $cityName)
    {
        $defaultName = '';
        foreach ($citys as $city) {
            if ($city->is_default == 1) {
                $defaultName = $city->uname;
                break;
            }
        }
            $defaultName = $defaultName ? $defaultName : 'haidianqu';
            if (session('cityuname') && empty(request('city'))){
                $cityuname = session('cityuname');
            }else {
                $cityuname = $cityName ? $cityName : trim($defaultName);
                session('cityuname', $cityuname);
            }
            $this->citys = $this->city->where('uname', $cityuname)->first();
    }

    /**
     * 获取首页的分类的数据
     * $recomCat 数组包括所有一级和二级分类的数据，参数一，是一级分类的name，参数二是该分类下所有的二级分类
     * @return array
     */
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
