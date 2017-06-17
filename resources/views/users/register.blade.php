@extends('archives.tag')


@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">注册</div>
                <div class="panel-body">
                    <!--   自定义错误消息提示 -->
                    @if($errors->any())
                        <ul class="list-group">
                            @foreach($errors->all() as $error)
                                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <!-- 用户注册session 中包含错误-->
                    @if(Session::has('user_register_failed'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('user_register_failed') }}
                        </div>
                    @endif

                    <!--  表单提示 -->
                    <form action="/user/register" class="form-horizontal" role="form"
                          method="post" accept-charset="utf-8">
                        {{  csrf_field()  }}
                        <div class="form-group">
                            <label for="nickname" class="col-md-4 control-label">
                                用户名
                            </label>
                            <div class="col-md-6">
                                <input id="" name="nickname" type="text"
                                       class="form-control" placeholder="用户名"
                                       value="{{ old('username') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">
                                邮箱
                            </label>
                            <div class="col-md-6">
                                <input id="" name="email" type="email"
                                       class="form-control" placeholder="邮箱"
                                       value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">
                                密码
                            </label>
                            <div class="col-md-6">
                                <input id="" name="password" type="password"
                                       class="form-control" placeholder="密码" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="col-md-4 control-label">
                                确认密码
                            </label>
                            <div class="col-md-6">
                                    <input id="" name="password_confirmation" type="password"
                                           class="form-control" placeholder="确认密码">
                            </div>
                        </div>

                        @include('captcha.geetest')

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> &nbsp; 注 册&nbsp;
                                    <span class="glyphicon glyphicon-envelope"></span>
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@stop