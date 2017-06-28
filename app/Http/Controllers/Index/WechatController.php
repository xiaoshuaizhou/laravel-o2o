<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WechatController extends Controller
{
    public function notify(Request $request) {
        //微信发送的数据是 流的数据形式
        $wechatDate = file_get_contents("php://input");
        file_put_contents('/tmp/wechat.txt', $wechatDate , FILE_APPEND);
    }
}
