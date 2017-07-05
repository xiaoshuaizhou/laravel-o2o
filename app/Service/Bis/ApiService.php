<?php

namespace App\Service\Bis;


use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CityRepository;
use Response;
class ApiService {
    /**
     * @var CityRepository
     */
    public $cityRepository;
    /**
     * @var CategoryRepository
     */
    public $categoryRepository;

    /**
     * ApiController constructor.
     * @param CityRepository $cityRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CityRepository $cityRepository, CategoryRepository $categoryRepository)
    {
        $this->cityRepository = $cityRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * 异步获取二级城市接口
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCitiesByParentId($id) {
        $citys = $this->cityRepository->findCitysByParentId($id);
        if ($citys && $id != 0){
            return Response::json([
                    'status' => 1,
                    'data' => ($citys->toArray()),
            ]);
        }
        return Response::json([
                'status' => 0,
                'data' => [],
        ]);
    }
    /**
     * 异步获取二级分类接口
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategoriesByParentId($id) {
        $categorys = $this->categoryRepository->findFirstCategories($id);
        if ($categorys->toArray() && $id){
            return Response::json([
                    'status' => 1,
                    'data' => $categorys->toArray(),
            ]);
        }
        return Response::json([
                'status' => 0,
                'data' => [],
        ]);
    }
    /**
     * 异步上传图片
     * @param $file
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadService($file) {
        $filePath = 'uploads/';
        $fileName = time() . '-' . $file->getClientOriginalName();
        $fileinfo = $file->move($filePath,  $fileName);

        if ($fileinfo && $fileinfo->getPathname()){
            return Response::json([
                    'status' => 1,
                    'data' => '/' . $fileinfo->getPathname(),
            ]);
        }
        return Response::json([
                'status' => 0 ,
                'data' => []
        ]);
    }
}