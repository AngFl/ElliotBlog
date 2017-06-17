<?php
/**
 *
 */

namespace App\Mailer;


class UserMailer extends MailSender
{
    /**
     * 使用欢迎视图来发送模板邮件
     * @param $user
     */
    public function welcome($user)
    {
        $subject = '欢迎来到 Elliot 个人博客';
        $view = 'LaravelSend';

        $data = [
            '%name%'  => [$user->nickname],
            '%token%' => [$user->confirm_code]
        ];

        $sendResult = $this->sendTo($user, $subject, $view, $data);
        \Log::debug('send-Email-result'.$sendResult);
    }
}