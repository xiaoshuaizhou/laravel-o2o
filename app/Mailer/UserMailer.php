<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2017/5/3
 * Time: 15:16
 */

namespace App\Mailer;


use App\Mailer\Phpmailer\Email;

class UserMailer extends Email {
    /**
     * 商户注册发送邮件
     * @param $bis
     */
    public function registerSend($bis) {
        $url = url('bis/register/waiting' , ['id'=>$bis->id]);
        $title = "O2O入驻申请通知\n";
        $content = "您提交的入驻申请需要平台方进行审核 \n， 您可以通过点击<a href='".$url."' target='_blank'>点击链接</a>查看进度";
        $this->send($bis->email , $title , $content);
    }

    /**
     * 商户修改状态发送邮件
     * @param $bis
     */
    public function changeStatusSend($bis) {
        if ($bis->status == 1){
            $title = "O2O入驻审核通知\n";
            $content = "您提交的入驻申请经过平台方审核 \n， 您的资料符合平台要求，恭喜您，审核成功！";
        }elseif($bis->status == 0){
            $title = "O2O入驻审核通知\n";
            $content = "您提交的入驻申请需要平台方进行审核 \n， 您的资料不符合平台要求，很遗憾，审核失败，请重新填写资料！";
        }else{
            $title = "O2O入驻审核通知\n";
            $content = "您提交的入驻申请有误 \n 请重新填写资料并提交！";
        }
        $this->send($bis->email , $title , $content);
    }
}