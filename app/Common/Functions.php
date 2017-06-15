<?php
/**
 * Created by PhpStorm.
 * User: bob-chou
 * Date: 17/4/30
 * Time: 00:35
 */

namespace App\Common;


class Functions
{
    public static function getIp()
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
    /*
    * curl 爬虫
    * @param $url
    * @param int $type 0 是get  1 是post
    * @param array $data
    */
    public static function doCurl($url , $type = 0 , $data = [])
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