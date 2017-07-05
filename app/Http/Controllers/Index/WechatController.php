<?php

namespace App\Http\Controllers\Index;

use App\Repositories\Bis\DealRepository;
use App\Repositories\Index\OrderRepository;
use App\Service\Index\WechatService;
use App\Http\Controllers\Controller;


/**
 * Class WechatController
 * @package App\Http\Controllers\Index
 */
class WechatController extends Controller
{
    /**
     * @var WechatService
     */
    public $wechatService;
    /**
     * WechatController constructor.
     * @param OrderRepository $orderRepository
     * @param DealRepository $dealRepository
     */
    public function __construct(WechatService $wechatService) {
        $this->wechatService = $wechatService;
    }

    /**
     * 微信回调
     */
    public function notify() {
        $this->wechatService->notifyService();
    }

    /**
     * 微信二维码
     * @param $id
     * @return string
     */
    public function payQrcode($id) {
        $url2 = $this->wechatService->payQrcodeService($id);
        return '<img alt="模式二扫码支付" src="'.url('/wechat/example').'/qrcode.php?data='.urlencode($url2).'" style="width:300px;height:300px;"/>';
    }
}
