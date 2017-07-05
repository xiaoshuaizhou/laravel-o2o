<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\CommonController;

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
        $locations = $this->locationRepository->getNormalLocationByIds($deal->location_ids);
        $controller =  'detail';
        $title = '详情页';
        $overplus = $deal->total_count - $deal->buy_count;
        //记录商品抢购时间
        $data = $this->detailService->buyTime($deal);
        $flag = $data[0];
        $timedate = $data[1];
        $mapStr = $locations[0]->xpoint . ',' . $locations[0]['ypoint'];
        return  view('index.detail', compact('shanghuinfo', 'mapStr', 'timedate', 'overplus', 'locations', 'citys', 'city', 'category', 'cats', 'indexfeatured', 'right', 'controller', 'title', 'deal', 'flag'));
    }
    /**
     * 获取分类
     * @return array
     */
    private function getCats()
    {
        return $this->detailService->getCategories();
    }
}
