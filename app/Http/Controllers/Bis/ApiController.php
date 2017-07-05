<?php

namespace App\Http\Controllers\Bis;

use App\Service\Bis\ApiService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use App\Api\Map;
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

    public function mapApi(Request $request)
    {
        $lnglat = Map::getLngLat($request->address);
        if (empty($lnglat) || $lnglat['status'] != 0 || $lnglat['result']['precise'] != 1){
            return response()->json(['msg'=>'error']);
        }
        return response()->json(['msg'=>'success']);
    }
}
