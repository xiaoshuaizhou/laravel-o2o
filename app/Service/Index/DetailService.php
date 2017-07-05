<?php

namespace App\Service\Index;


use App\Repositories\Admin\CategoryRepository;

/**
 * Class DetailService
 * @package App\Service\Index
 */
class DetailService {
    /**
     * @var CategoryRepository
     */
    public $categoryRepository;

    /**
     * DetailService constructor.
     * @param $categoryRepository
     */
    public function __construct( CategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * 抢购时间
     * @return array
     */
    public function buyTime($deal) {
        $flag = 0;
        $timedate = '';

        if ($deal->start_time > date('Y-m-d H:i:s')){
            $flag = 1;
            $dtime = strtotime($deal->start_time)-strtotime(date('Y-m-d H:i:s'));
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
        return [$flag, $timedate];
    }

    /**
     * 获取分类数据
     * @return array
     */
    public function getCategories() {
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