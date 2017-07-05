<?php

namespace App\Service\Admin;


use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CityRepository;
use App\Repositories\Bis\BisRepository;
use App\Repositories\Bis\DealRepository;
use App\Repositories\Bis\LocationRepository;

/**
 * Class DealsService
 * @package App\Service\Admin
 */
class DealsService {
    /**
     * @var CityRepository
     */
    public $cityRepository;
    /**
     * @var CategoryRepository
     */
    public $categoryRepository;
    /**
     * @var DealRepository
     */
    public $dealRepository;
    /**
     * @var BisRepository
     */
    public $bisRepository;
    /**
     * @var LocationRepository
     */
    public $locationRepository;

    /**
     * DealsService constructor.
     * @param CityRepository $cityRepository
     * @param CategoryRepository $categoryRepository
     * @param DealRepository $dealRepository
     * @param BisRepository $bisRepository
     * @param LocationRepository $locationRepository
     */
    public function __construct(
            CityRepository $cityRepository,
            CategoryRepository $categoryRepository,
            DealRepository $dealRepository,
            BisRepository $bisRepository,
            LocationRepository $locationRepository
    ) {
        $this->cityRepository = $cityRepository;
        $this->categoryRepository = $categoryRepository;
        $this->dealRepository = $dealRepository;
        $this->bisRepository = $bisRepository;
        $this->locationRepository = $locationRepository;
    }

    /**
     * 团购列表 多条件查询
     * @param $request
     * @return mixed
     */
    public function indexService($request) {
        $request = app($request);
        if ($request->isMethod('post')){
            $sdata = [];
            $sdataname = [];
            if (!empty($request->category_id)){
                $sdata['category_id'] = $request->category_id;
            }
            if (!empty($request->city_id)){
                $sdata['city_id'] = $request->city_id;
            }
            if (!empty($request->name)) {
                $sdataname['name'] = $request->name;
            }
            if (!empty($request->shangjianame)){
                $bis = $this->bisRepository->whereFormNameLike($request->shangjianame);
                if (empty($bis)) abort(404,'商户名不存在');
                $sdata['bis_id'] = $bis->id;
            }
            $time_data = [];
            if ($request->start_time && $request->end_time && strtotime($request->end_time) > strtotime($request->start_time )){
                $time_data['start_time'] = $request->start_time;
                $time_data['end_time'] = $request->end_time;
            }
            return  $deals = $this->dealRepository->getNormalDealsByWhere($sdata, $sdataname, $time_data);
        }else {
            return $deals = $this->dealRepository->getNormalDeals();
        }
    }

    /**
     * 待审核的团购商品
     * @param $request
     * @return mixed
     */
    public function reviewService($request) {
        $request = app($request);
        if ($request->isMethod('post')){
            $sdata = [];
            $sdataname = [];
            if (!empty($request->category_id)){
                $sdata['category_id'] = $request->category_id;
            }
            if (!empty($request->city_id)){
                $sdata['city_id'] = $request->city_id;
            }
            if (!empty($request->name)) {
                $sdataname['name'] = $request->name;
            }
            if (!empty($request->shangjianame)){
                $bis = $this->bisRepository->whereFormNameLike($request->shangjianame);
                if (empty($bis)) abort(404,'商户名不存在');
                $sdata['bis_id'] = $bis->id;
            }
            $time_data = [];
            if ($request->start_time && $request->end_time && strtotime($request->end_time) > strtotime($request->start_time )){
                $time_data['start_time'] = $request->start_time;
                $time_data['end_time'] = $request->end_time;
            }
            return $deals = $this->dealRepository->getNormalDealsByWhere($sdata, $sdataname, $time_data,0);
        }else {
            return $deals = $this->dealRepository->getNormalDealsReview();
        }
    }

    /**
     * 获取二级城市数据
     * @return mixed
     */
    public function getNormalCity() {
        return $this->cityRepository->getNormalCity();
    }

    /**
     * 获取一个分类
     * @return mixed
     */
    public function getNormalCategories() {
        return $this->categoryRepository->findFirstCategories();
    }

    /**
     * 根据ID查想数据
     * @param $id
     * @return mixed
     */
    public function getNormalDealById($id) {
        return $this->dealRepository->getNormalDealById($id);
    }

    /**
     * 根据bis_id查询数据
     * @param $bisId
     */
    public function getNormalLocationById($bisId) {
        return $this->locationRepository->whereFormBisId($bisId);
    }

    /**
     * 编辑数据
     * @param $data
     * @return mixed
     */
    public function updateDealById($data) {
        return $this->dealRepository->updateById($data);
    }

    /**
     * 删除团购商品 下架
     * @param $id
     */
    public function deleteDealById($id) {
        return $this->dealRepository->deleteDealById($id);

    }
}