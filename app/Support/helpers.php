<?php

/**
 * 自定义help函数，使用时需要 命令行执行  composer  dump-autoload  才可以加载自定义函数
 */
if (!function_exists('changeStatus')){
    /**
     * 修改状态
     * @param int $status
     * @return string
     */
    function changeStatus($status = 0) {

        if ($status == 1){
            return '正常';
        }elseif ($status == 0){
            return '待审核';
        }else{
            return '已删除';
        }
    }
}
if (! function_exists('doCurl')){
    /*
   * curl 爬虫
   * @param $url
   * @param int $type 0 是get  1 是post
   * @param array $data
   */
    function doCurl($url , $type = 0 , $data = [])
    {
        //初始化curl
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        if ($type == 1){
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        //执行并获取内容
        $output = curl_exec($ch);
        //释放句柄
        curl_close($ch);
        return $output;
    }
}
if (! function_exists('getIp')){
    /**
     * 获取用户IP
     * @return array|false|string
     */
    function getIp()
    {
        static $realip;
        if (isset($_SERVER)){
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
                $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                $realip = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $realip = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR")){
                $realip = getenv("HTTP_X_FORWARDED_FOR");
            } else if (getenv("HTTP_CLIENT_IP")) {
                $realip = getenv("HTTP_CLIENT_IP");
            } else {
                $realip = getenv("REMOTE_ADDR");
            }
        }
        return $realip;
    }

    /**
     * 根据（city_path）获取二级城市名称
     * @param $path
     * @return string
     */
    function getSeCityName($path){
        if (empty($path)){
            return '';
        }
        if (preg_match('/,/', $path)){
            $cityPath = explode(',', $path);
            $cityId = $cityPath[1];
        }else{
            $cityId = $path;
        }
        $city = \App\Models\Admin\Citys::find($cityId);
        return $city->name;
    }
}

/**
 * 判断是否是主店
 * @param $isMain
 * @return string
 */
function isMain($isMain)
{
    return $isMain == 1 ? '主店' : '分店';
}

/**
 * 根据category_path 查询二级分类
 * @param $path
 * @return string
 */
function getCategoryNameBySeCategoryId($path)
{
    if (empty($path)){
        return '';
    }
    if (preg_match('/,/', $path)){
        $category = explode(',', $path);
        $categoryId = $category[1];
    }else{
        $categoryId = $path;
    }
    $category = \App\Models\Admin\Category::find($categoryId);
    return $category->name;
}

/**
 * 判断category_path 是否有二级分类
 * @param $path
 * @return bool|string
 */
function getCategoryByCategoryPath($path)
{
    if (empty($path)){
        return '';
    }
    if (preg_match('/,/', $path)){
        $category = explode(',', $path);
        if ($category[1]){
            return true;
        }
        return false;
    }
}

/**
 * 根据商家ID获取商家名称
 * @param $bisId
 * @return string
 */
function getBisNameByBisId($bisId)
{
    if (empty($bisId)){
        return '';
    }
    $bis = \App\Models\Bis\Bis::find($bisId);
    return $bis->name;
}

function countLocation($ids)
{
    if (empty($ids)){
        return 1;
    }
    if (preg_match('/,/', $ids)){
        $arr = explode(',', $ids);
        return count($arr);
    }else{
        return 1;
    }
}