<?php
/**
 *
 */

namespace App\Mailer;


class MailSender
{
    protected $url = "http://api.sendcloud.net/apiv2/mail/sendtemplate";

    /**
     * 使用 Send-Cloud 集成邮件发送服务
     * @param $user       用户信息集合
     * @param $subject    邮件主题
     * @param $view       邮件模板
     * @param array $data 用户数据
     * @return bool|string
     */
    public function sendTo($user, $subject, $view, $data = [])
    {
        $vars = json_encode(['to' => [$user->email], 'sub' => $data]);

        //邮件发送参数
        $params = [
            'apiUser'  => env('SENDCLOUD_API_USER'),
            'apiKey'   => env('SENDCLOUD_API_KEY'),
            'from'     => config('mail')['from']['address'],
            'subject'  =>  $subject,
            'fromName'           => config('mail')['from']['name'],
            'xsmtpapi'           => $vars,
            'templateInvokeName' => $view,
            'respEmailId'        => 'true'

        ];

        \Log::info('params:'.json_encode($params));
        // HTTP 请求提参数拼接
        $options = http_build_query($params);

        // HTTP请求头设置
        $sendData = [
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $options
            ]
        ];
        // 发送邮件上下文
        $context = stream_context_create($sendData);

        return file_get_contents($this->url, FILE_TEXT, $context);
    }
}