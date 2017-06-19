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
    public function registerSend($bis) {
        $url = url('bis/register/waiting' , ['id'=>$bis->id]);
        $title = "O2O入驻申请通知\n";
        $content = "您提交的入驻申请需要平台方进行审核 \n， 您可以通过点击<a href='".$url."' target='_blank'>点击链接</a>查看进度";
        $this->send($bis->email , $title , $content);
    }
}