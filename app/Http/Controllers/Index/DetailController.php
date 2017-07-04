<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;

class DetailController extends CommonController
{

    /**
     * 商品详情页
     * @param Request $request
     * @param $id
     * @param $city_id
     * @param $cat_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $id, $city_id, $cat_id)
    {
        $indexfeatured = $this->featuredRepository->getNorMalFeaturedByType(0);
        $right = $this->featuredRepository->getNorMalFeaturedByType(1);
        $city = $this->cityRepository->find($city_id);
        $category = $this->categoryRepository->find($cat_id);
        $citys = $this->cityRepository->getNormalCity();
        $cats = $this->getCats();
        $deal = $this->dealRepository->find($id);
        $bisId = $deal->bis_id;
        $shanghuinfo = $this->bisRepository->find($bisId);

        $locations = $this->location->getNormalLocationByIds($deal->location_ids);
        $controller =  'detail';
        $title = '详情页';
        $overplus = $deal->total_count - $deal->buy_count;
        //记录商品抢购时间
        $flag = 0;
        if ($deal->start_time > date('Y-m-d H:i:s')){
            $flag = 1;
            $dtime = strtotime($deal->start_time)-strtotime(date('Y-m-d H:i:s'));
            $timedate = '';
            $d = floor($dtime/(24*3600));
            if ($d){
                $timedate .= $d . "天";
            }
            $h = floor($dtime%(24*3600)/3600);
            if ($h){
                $timedate .= $d . "小时";
            }
            $m = floor($dtime%(24*3600)%3600/60);
            if ($m){
                $timedate .= $m . "分钟";
            }
        }
        $mapStr = $locations[0]->xpoint . ',' . $locations[0]['ypoint'];
        return  view('index.detail', compact('shanghuinfo', 'mapStr', 'timedate', 'overplus', 'locations', 'citys', 'city', 'category', 'cats', 'indexfeatured', 'right', 'controller', 'title', 'deal', 'flag'));
    }

    /**
     * @return array
     */
    private function getCats()
    {
        $categorys = $this->categoryRepository->getIndexCategoryByParentId(0,5);
        $ids = $sedArr = $recomCat = [];
        foreach ($categorys as $category) {
            $ids[] = $category->id;
        }
        $sedCats = $this->categoryRepository->getSecondCategoryByParentId($ids);
        foreach ($sedCats as $sedcat) {
            $sedArr[$sedcat->parent_id][] = ['id' => $sedcat->id, 'name' => $sedcat->name];
        }
        foreach ($categorys as $cat) {
            $recomCat[$cat->id] = [$cat->name, empty($sedArr[$cat->id]) ? [] : $sedArr[$cat->id]];
        }

        return $recomCat;
    }
}
