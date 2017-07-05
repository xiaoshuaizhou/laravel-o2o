<?php

namespace App\Service\Admin;


use App\Repositories\Bis\FeaturedRepository;

class FeaturedService {
    /**
     * @var FeaturedRepository
     */
    public $featuredRepository;

    /**
     * FeaturedController constructor.
     * @param FeaturedRepository $featuredRepository
     */
    public function __construct(FeaturedRepository $featuredRepository)
    {
        $this->featuredRepository = $featuredRepository;
    }

    /**
     * 根据type查询推荐位
     * @param $type
     * @return mixed
     */
    public function indexService($type) {
        if (empty($type)){
            $type = 0;
        }
        return $this->featuredRepository->getNorMalFeaturedByType($type);
    }

    /**
     * 添加推荐位
     * @param $data
     * @return mixed
     */
    public function createService($data) {
        return $this->featuredRepository->create($data);
    }

    /**
     * 推荐位删除
     * @param $id
     */
    public function destoryService($id) {
        return $this->featuredRepository->destory($id);

    }
}