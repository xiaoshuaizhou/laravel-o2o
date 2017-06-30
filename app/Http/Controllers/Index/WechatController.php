<?php

namespace App\Http\Controllers\Index;

use App\Wxpay\Database\WxPayResults;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Wxpay\Database\WxPayUnifiedOrder;
use \App\Wxpay\NativePay;
use \App\Wxpay\WxPayConfig;
use \App\Wxpay\WxPayApi;
use \App\Wxpay\WxPayNotify;
use \App\Wxpay\PayNotifyCallBack;
class WechatController extends Controller
{
    public function notify(Request $request) {
        //微信发送的数据是 流的数据形式
        $wechatDate = file_get_contents("php://input");
        file_put_contents('/tmp/wechat.txt', $wechatDate , FILE_APPEND);

        try {
            $resultObj = new WxPayResults();
            $wechatDate = $resultObj->Init($wechatDate);
        }catch (\Exception $e){
            //给微信返回失败 码  和失败信息
            $resultObj->setData('reture_code', 'FAIL');
            $resultObj->setData('reture_msg', $e->getMessage());
            $resultObj->toXml();
        }
        if ($wechatDate['return_code'] === 'FAIL' || $wechatDate['result_code'] !== 'SUCCESS'){
            //给微信返回失败 码  和失败信息
            $resultObj->setData('reture_code', 'FAIL');
            $resultObj->setData('reture_msg', $e->getMessage());
            $resultObj->toXml();
        }
        $resultObj->setData('reture_code', 'SUCCESS');
        $resultObj->setData('reture_msg', 'OK');
        $resultObj->toXml();
    }

    public function payQrcode($id) {
        //统一下单
        $notify = new \App\Wxpay\NativePay();
        $input = new WxPayUnifiedOrder();
        $input->setBody("test");
        $input->setAttach("test");
        $input->setOutTradeNo(\App\Wxpay\WxPayConfig::MCHID.date("YmdHis"));
        $input->setTotalFee("1");
        $input->setTimeStart(date("YmdHis"));
        $input->setTimeExpire(date("YmdHis", time() + 600));
        $input->setGoodsTag("test");
        $input->setNotifyUrl(url('weixinpay/notify')); //微信回调   支付成功后会触发这个url
        $input->setTradeType("NATIVE");
        $input->setProductId($id);
        $result = $notify->GetPayUrl($input);
        if (empty($result["code_url"])){
            $url2 = '';
        }else{
            $url2 = $result["code_url"];
        }
        return '<img alt="模式二扫码支付" src="'.url('/wechat/example').'/qrcode.php?data='.urlencode($url2).'" style="width:300px;height:300px;"/>';
    }
}
