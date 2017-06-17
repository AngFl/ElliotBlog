<?php
/**
 *
 */

namespace App\Services;


use Laravist\GeeCaptcha\GeeCaptcha;


/**
 * Class CaptchaService
 * @package App\Services
 */
class CaptchaService
{
    /**
     * 返回服务调用的实例
     * @return \Laravist\GeeCaptcha\GeeCaptcha
     */
    public function getCaptchaInstance()
    {
        return new GeeCaptcha(env('CAPTCHA_ID'), env('PRIVATE_KEY'));
    }


    /**
     * 调用 Geetest 服务验证函数验证码
     * @return \Illuminate\Http\JsonResponse
     */
    public function captchaVerify()
    {
        $captchaInstance = $this->getCaptchaInstance();
        if($captchaInstance->isFromGTServer()){
            if($captchaInstance->success()){
                return true;
            }
           return false;
        }
        // 等待验证码服务
        return \Response::json([ 'statusCode' => 405, 'msg'    => 'Geetest 服务异常']);
    }
}