@extends('archives.tag')


@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="alert alert-info alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                 <strong>验证邮件已成功发送</strong> &nbsp; 您可以立即去邮箱验证.
                <p><a href="{{ $linker }}">去邮箱验证</a>  </p>
            </div>

            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h5>如果您还没有收到邮件，请您稍等片刻</h5>
                <p>您可以尝试以下解决方案,来获取邮箱验证链接（我们为您提供两种联系方式）</p>
                <p>
                    <button type="button" class="btn btn-primary">
                        向我发送站内信
                        <span class="glyphicon glyphicon-envelope"></span>
                    </button>
                    <button type="button" class="btn btn-info">
                        获取我的联系方式
                        <span class="glyphicon glyphicon-hand-up"></span>
                    </button>
                </p>
            </div>
        </div>
    </div>

    <div style="height: 100px;"></div>
@endsection