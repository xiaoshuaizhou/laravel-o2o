<?php
/**
 * Created by PhpStorm.
 * User: bob-chou
 * Date: 17/4/30
 * Time: 11:47
 */

namespace App\Api;


/**
 * 百度地图封装
 * Class Map
 * @package App\Api
 */
class Map
{
    /**
     * 根据地址获取经纬度
     * @param $address
     * @return array|mixed|string
     */
    public static  function getLngLat($address)
    {
        if (!$address){
            return '';
        }
        $data = [
            'address' => $address,
            'ak' => env('MAP_AK'),
            'output' => 'json',
        ];
        $url = env('BAIDU_MAP_URL') . env('GEOCODER') . '?' . http_build_query($data);
        if (doCurl($url)){
            return json_decode(doCurl($url), true);
        }else{
            return [];
        }
    }

    /**
     * 根据经纬度或地址获取地图
     * @param $center
     * @return mixed|string
     */
    public static function staticimage($center)
    {
        if (!$center){
            return '';
        }
        $data = [
            'ak' => env('MAP_AK'),
            'width' => env('WIDTH'),
            'height' => env('HEIGHT'),
            'center' => $center,
            'markers' =>$center,
        ];
        $url = env('BAIDU_MAP_URL') . env('STATICIMAGE') . '?' . http_build_query($data);
        return doCurl($url);
    }
}