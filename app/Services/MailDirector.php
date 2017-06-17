<?php
/**
 *
 */

namespace App\Services;

/**
 * 邮箱地址辅助服务
 * Class MailDirector
 * @package App\Services
 */
class MailDirector
{
    protected $mail_Domain_List = [];

    /**
     * 获取邮件域名地址
     * @param $email
     * @return bool|string
     */
    public function getDomainName($email)
    {
        if(strpos($email,'@') !=  false){
            return substr($email,stripos($email,'@')+1,
                ((strrpos($email,'.')-1) - stripos($email, '@')));
        }
    }

    /**
     * 获取匹配邮箱的链接地址
     * @param $key
     * @return array|mixed
     */
    public function matchEmail($key)
    {
        if(array_key_exists($key, $this->mail_Domain_List)){
            return $this->mail_Domain_List[$key];
        }
        return $this->mail_Domain_List;
    }


    /**
     * MailDirector constructor.
     *
     *  常规邮箱初始化
     */
    public function __construct()
    {
        $regular = [
            'qq'      =>  'http://mail.qq.com',
            '163'     =>  'http://mail.163.com',
            'outlook' =>  'http://outlook.com',
            'gmail'   =>  'http://gmail.com',
            'edu2act' =>  'https://email.edu2act.org',
            'hotmail' =>  'http://hotmail.com',
            'yahoo'   =>  'http://mail.yahoo.com'
        ];
        $this->mail_Domain_List = $regular;
    }
}