<?php

namespace App\Http\Controllers\Bis;

use App\Models\Admin\Category;
use App\Models\Admin\Citys;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{


    public $city;
    public $category;

    /**
     * ApiController constructor.
     * @param City $city
     * @param Category $category
     */
    public function __construct(Citys $city, Category $category)
    {
        $this->city = $city;
        $this->category = $category;
    }

    /**
     * 异步获取二级城市接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCityByParentId(Request $request)
    {
        $citys = $this->city->getCitysByParentId($request->id);
        if ($citys && $request->id != 0){
            return \Response::json([
                    'status' => 1,
                    'data' => ($citys->toArray()),
            ]);
        }
        return \Response::json([
                'status' => 0,
                'data' => [],
        ]);
    }

    /**
     * 异步获取二级分类接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategoryByParentId(Request $request)
    {
        $categorys = $this->category->getSonsCategoryes($request->cid);
        if ($categorys->toArray() && $request->cid){
            return \Response::json([
                    'status' => 1,
                    'data' => $categorys->toArray(),
            ]);
        }
        return \Response::json([
                'status' => 0,
                'data' => [],
        ]);

    }
    /**
     * 图片上传
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        $file = $request->file('file');
        $filePath = 'uploads/';
        $fileName = time() . '-' . $file->getClientOriginalName();
        $fileinfo = $file->move($filePath,  $fileName);

        if ($fileinfo && $fileinfo->getPathname()){
            return \Response::json([
                    'status' => 1,
                    'data' => '/' . $fileinfo->getPathname(),
            ]);
        }
        return \Response::json([
                'status' => 0 ,
                'data' => []
        ]);
    }
}
