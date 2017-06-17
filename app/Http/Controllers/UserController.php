<?php

namespace App\Http\Controllers;


use App\Services\CaptchaService;
use App\Services\MailDirector;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use Image;
use MercurySeries\Flashy\Flashy;
use Overtrue\Socialite\SocialiteManager;

class UserController extends Controller
{
    /**
     * @var CaptchaService
     */
    protected $captchaService;

    /**
     * 导入 GeeTest 验证码服务
     * UserController constructor.
     * @param $captchaService
     */
    public function __construct(CaptchaService $captchaService)
    {
        $this->captchaService = $captchaService;
    }


    /**
     * 用户登录页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function signIn()
    {
        return view('users.login');
    }

    /**
     * 用户注册存储信息
     * @param Requests\UserRegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Requests\UserRegisterRequest $request)
    {
         // 验证码服务
        if($this->captchaService->captchaVerify()){
            // 获取表单数据
            $data = [
                'nickname' => $request->input('nickname'),
                'email'    => $request->input('email'),
                'password' => $request->input('password'),
                'avatar'   => '/img/avatar/default.jpeg',
                'confirm_code' => str_random(35)
            ];
            // 存储数据，触发其他用户事件，发送邮件等服务
            $user = User::register($data);
            // 验证数据
            if($user){
                // 只有在控制器中的 redirect 函数会生效
                return redirect('/user/stricken/'.$user->id);
            }
            // 用户注册失败？ 需要显示页面
            return redirect('/user/register');

        }else{
            \Session::flash('user_register_failed','验证码不正确');
            return redirect('/user/register')->withInput();
        }
    }

    /**
     * 用户确认邮箱~
     * @param string $confirm_code
     * @return string
     */
    public function emailConfirm($confirm_code)
    {
        if(strlen($confirm_code) != 35){
            // 请求参数有误
            \Session::flash('confirm_arguments','请求参数异常:(');
        }

        $user = User::where('confirm_code',$confirm_code)->first();

        // 邮箱未激活
        if($user && 0 == $user->is_active){
            //模型更新
            $user->is_active = 1;
            $user->confirm_code = str_random(35);
            // 邮箱已经激活
            $user->save();
            \Session::flash('email_confirmed',
                '尊敬的'.$user->nickname.'您的邮箱已经验证，请登录');
        }else{
            \Session::flash('confirm_arguments','请求参数异常:(');
        }

        return view('users.confirm');
    }
    /**
     * 用户注册登录
     * @param Requests\UserLoginRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function verify(Requests\UserLoginRequest $request)
    {
        /**
         * 调用 Geetest 验证码服务
         */
        if($this->captchaService->captchaVerify()){
            /**
             * 表单数据条件验证
             * 尝试条件登录， 登录条件可随后改变
             */
            $verifyInfo = [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ];

            if(\Auth::attempt($verifyInfo)){

                $verifyInfo['is_active'] = 1;

                if(\Auth::attempt($verifyInfo)){
                    // 设置用户的Session 邮箱
                    \Session::set('user_email', $request->input('email'));
                    // 登录提示 Flash !~
                    Flashy::info(\Auth::user()->nickname.' 欢迎回来!', 'http://stardustio.me');

                    return redirect('/archives/lists');
                }
                \Session::flash('user_email_not_active','用户邮箱未验证');
            }else {
                \Session::flash('user_login_failed', '邮箱或密码不正确');
            }
        }else{
            \Session::flash('user_login_failed','验证码不正确');
        }
        // Session flash 后的数据渲染至 blade？
        return redirect('/user/login')->withInput();
    }

    /**
     * 用户注册页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function register()
    {
        return view('users.register');
    }

    /**
     * 用户注销页面， 销毁Session
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        \Auth::logout();
        \Session::forget('user_email');
        return redirect('/user/login');
    }

    /**
     * 验证码加载数据， 特效渲染
     * @return mixed
     */
    public function captcha()
    {
        $captcha = $this->captchaService->getCaptchaInstance();

        return $captcha->GTServerIsNormal();
    }

    /**
     * 返回注册邮箱地址链接
     * @param $id
     * @param MailDirector $director
     * @return $this
     */
    public function stricken($id, MailDirector $director)
    {
        $user = User::find($id);

        $mapper =  $director->getDomainName($user->email);
        $linker = $director->matchEmail($mapper);

        if(!is_array($linker)){
            return view('users.stricken')->with('linker',$linker);
        }
    }


    public function avatar()
    {
        return view('users.avatar');
    }


    /**
     * @param Requests\ProfileHeadRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function avatarChmod(Requests\ProfileHeadRequest $request)
    {
        $file = $request->file('avatar');

        // 登录用户ID， 加 时间戳， 文件原始名字~
        $filename = \Auth::user()->id.'_'.time().$file->getClientOriginalName();
        // 目标文件路径
        $destinationPath = 'user_avatar/';
        // 路径
        $file->move($destinationPath, $filename);

        // 用户上传头像对非法文件处理
        try{
            // 头像裁剪~  宽高裁剪
            Image::make($destinationPath. $filename)->fit(200)->save();
            // 更新用户头像数据库字段
            $user = User::find(\Auth::user()->id);

            $user->avatar = DIRECTORY_SEPARATOR. $destinationPath.$filename;
            $user->save();
        }catch (\Exception $e){
            $flashInfo = $e->getMessage();
            \Log::alert('upload-profile-user-email:'.\Auth::user()->email. 'username:'.
                \Auth::user()->nickname.':Exception:'.$flashInfo);

            \Session::flash('profile_photo_not_supported','上传文件不符');
        }

        return redirect('/user/avatar');
    }

    /**
     *
     */
    public function githubLogin()
    {
        $socialite = new SocialiteManager(config('services'));
        return $socialite->driver('github')->redirect();
    }

    /**
     * GitHub 授权登录回调信息，获取个人信息
     * nickname,
     */
    public function githubLoginCallBack()
    {
        $socialite = new SocialiteManager(config('services'));

        $githubUser = $socialite->driver('github')->user();

        // 检查用户授权信息是否存在于用户表中，如果存在则不存储，授权后立即登录
        $searchEmail = $githubUser->getEmail();

        $userResult = User::where('email',$searchEmail)->first();

        if(!isset($userResult)){
            $storage = [
                'nickname' => $githubUser->getNickname(),
                'email'    => $searchEmail,
                'password' => $githubUser->getId(),
                'avatar'   => $githubUser->getAvatar(),

                'confirm_code' => str_random(35),
                // Github OAuth 认证登录信息
                'oauth_name' => 'github',
                'oauth_id'   => $githubUser->getId(),
                'is_active'  => 1
            ];

            $OAuthUser = User::create($storage);
        }

        if( \Auth::attempt(['email' => $searchEmail, 'password'=> $githubUser->getId()])){
            // 设置用户的Session 邮箱
            \Session::set('user_email', $searchEmail);
            // 登录提示 Flash !~
            Flashy::info(\Auth::user()->nickname.' GitHub 登录成功!', 'http://stardustio.me');
            return redirect('/archives/lists');
        }
    }
}
