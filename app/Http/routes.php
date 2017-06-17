<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// 官方的首页
Route::get('/', 'ArchivesController@home');

// Slim3 的向导文件
Route::get('/slim3', 'ArchivesController@slimTutorial');
// 归档文件标记，
Route::group(['prefix' => 'archives' ], function(){
    // fork 当前的blog 标记
    Route::get('tag/{index}/fork', 'ArchivesController@fork');
    // 文档种类创建
    Route::get('tag/create', 'ArchivesController@tagCreate')->middleware('signIn');
    // 点赞功能
    Route::get('{id}/thumbs-up', 'ArchivesController@thumbUp')->middleware('signIn');
    // 归档种类存储
    Route::post('tag/store', 'ArchivesController@tagStore');
    // 编辑发表文件
    Route::get('edit/{id}','ArchivesController@edit')->middleware('signIn');
    // 修改发表文件
    Route::post('update/{id}','ArchivesController@updateArticle')->middleware('signIn');

    // 归档信息首页
    Route::get('lists', 'ArchivesController@lists');
    // 归档文件存储路由
    Route::get('create','ArchivesController@create')->middleware('signIn');
    Route::post('store','ArchivesController@store');
    // 显示单个Show 路由页面
    Route::get('show/{id}','ArchivesController@show');
    // 博客评论提交
    Route::post('comment','CommentsController@store')->middleware('signIn');
    // 文章分类显示
    Route::get('category/{describe}', 'ArchivesController@category');
});

// 路由重可以有参数 ？不确定, 对搜索功能做出 请求次数限制
Route::any('search', 'ArchivesController@search')->middleware('throttle:15');

// 用户登录注册功能模块
Route::group(['prefix' => 'user'], function(){
    //用户登录
    Route::get('login','UserController@signIn');
    //使用 throttle 限制URL访问
    Route::post('login','UserController@verify')->middleware('throttle:40');
    // Geetest 集成服务 验证码
    Route::get('/captcha', 'UserController@captcha');
    //用户注册
    Route::get('register','UserController@register');
    ////使用 throttle 限制URL访问
    Route::post('register','UserController@store')->middleware('throttle:30');
    // 用户邮件注册确认
    Route::get('/confirm/{confirm_code}','UserController@emailConfirm');

    // 用户完成提交注册之后跳转等待页面(如果用户有眼验证， 跳转登录)
    Route::get('/stricken/{id}', 'UserController@stricken');

    // 更换用户头像
    Route::get('/avatar', 'UserController@avatar');
    Route::post('/changeAvatar', 'UserController@avatarChmod');
    //用户注销
    Route::get('logout','UserController@logout');

    // GitHub 授权登录
    Route::get('oauth/github','UserController@githubLogin');
    Route::get('oauth/github/callback','UserController@githubLoginCallBack');
});

/**
 * 关于个人页面展示内容信息的问题
 */
Route::group(['prefix' => 'about'], function(){
    Route::get('/profile', 'AboutController@about');
    Route::get('/search', 'AboutController@locate');
});
