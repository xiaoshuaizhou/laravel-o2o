<?php

namespace App\Http\Controllers\Bis;

use App\Service\Bis\ApiService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

/**
 * Class ApiController
 * @package App\Http\Controllers\Bis
 */
class ApiController extends Controller
{
    /**
     * @var ApiService
     */
    public $apiService;

    /**
     * ApiController constructor.
     * @param ApiService $apiService
     */
    public function __construct( ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * 异步获取二级城市接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCityByParentId()
    {
        return $this->apiService->getCitiesByParentId(request('id'));
    }

    /**
     * 异步获取二级分类接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategoryByParentId()
    {
        return $this->apiService->getCategoriesByParentId(request('cid'));
    }
    /**
     * 图片上传
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        return $this->apiService->uploadService($request->file('file'));
    }
}
