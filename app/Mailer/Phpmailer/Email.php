<?php
/**
 * Created by PhpStorm.
 * User: bob-chou
 * Date: 17/4/30
 * Time: 21:27
 */

namespace App\Mailer\Phpmailer;


/**
 * 邮件发送类
 * Class Email
 * @package App\Mailer\Phpmailer
 */
class Email
{
    public static function send($to, $title, $content)
    {
        header("content-type:text/html;charset=utf-8");
        require 'Phpmailer.php';
        require 'Smtp.php';
        date_default_timezone_set('PRC');//set time
        if (empty($to)){
            return false;
        }
        try {
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Debugoutput = 'html';
            $mail->Host = env('EMAIL_HOST');
            $mail->Port = env('EMAIL_PORT');
            $mail->SMTPAuth = true;
            $mail->Username = env('EMAIL_USERNAME');
            $mail->Password = env('EMAIL_PASSWORD');
            $mail->setFrom(env('EMAIL_USERNAME'), 'Zhouxiaoshuai');
            $mail->addAddress($to);
            $mail->Subject = $title;
            $mail->msgHTML($content);
            if (!$mail->send()) {
                return false;
            } else {
                return true;
            }
        }catch (phpmailerException $e){
            return false;
        }

    }
}