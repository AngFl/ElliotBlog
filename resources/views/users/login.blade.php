@extends('archives.tag')


@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">登录</div>
                <div class="panel-body">
                    <!--   自定义错误消息提示 -->
                    @if($errors->any())
                        <ul class="list-group">
                            @foreach($errors->all() as $error)
                                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <!-- 用户登录session 中包含错误-->
                    @if(Session::has('user_login_failed'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('user_login_failed') }}
                        </div>
                    @endif

                <!-- 用户邮箱 session 中包含错误-->
                    @if(Session::has('user_email_not_active'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('user_email_not_active') }}
                        </div>
                    @endif


                    <form action="/user/login" method="post" class="form-horizontal" role="form"
                          accept-charset="utf-8">

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">邮箱</label>
                            <div class="col-md-6">
                                <input id="" name="email" type="email"
                                       class="form-control" placeholder="邮箱"
                                       value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">密码</label>
                            <div class="col-md-6">
                                <input id="" name="password" type="password"
                                       class="form-control" placeholder="密码" required>
                            </div>
                        </div>

                        @include('captcha.geetest')

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> &nbsp; 登录&nbsp;
                                    <span class="glyphicon glyphicon-log-in"></span>
                                </button>
                            </div>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>

            <div class="row" style="margin-top:20px;">
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <a href="/user/oauth/github">
                        <i class="fa fa-github">
                            
                        </i>
                        使用 github 登录
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div style="height: 100px;"></div>
@stop