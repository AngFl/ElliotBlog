<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Extensions\RedisSessionHandler;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        //  使用 Redis 注册服务， 管理Session 数据
        Session::extend('redis',function($app){
            return new RedisSessionHandler();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
