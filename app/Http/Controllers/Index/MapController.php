<?php

namespace App\Http\Controllers\Index;

use App\Api\Map;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MapController extends Controller
{
    /**
     * 获取地图
     * @param $data
     * @return mixed|string
     */
    public function getMapImage($data) {
       return  Map::staticimage($data);
    }
}
