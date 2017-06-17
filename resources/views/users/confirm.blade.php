@extends('archives.tag')


@section('content')
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel">

                    <div class="panel-heading">
                        <h2>
                            用户邮箱验证
                        </h2>
                    </div>
                    <div class="panel-body">
                        <!-- 用户邮箱session 中包含错误-->
                        @if(Session::has('confirm_arguments'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('confirm_arguments') }}
                            </div>
                        @endif

                        @if(Session::has('email_confirmed'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('email_confirmed') }}
                                <p>
                                     <a href="/user/login">请登录</a>
                                </p>
                            </div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
        <div style="height: 100px;"></div>
@endsection    