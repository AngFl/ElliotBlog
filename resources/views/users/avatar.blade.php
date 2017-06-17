@extends('archives.tag')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="text-center">
                    <img src="{{ Auth::user()->avatar }}" width="100" class="img-circle" alt="">

                    <!--   自定义错误消息提示 -->
                    @if($errors->any())
                        <ul class="list-group">
                            @foreach($errors->all() as $error)
                                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <!-- 用户上传图片出现问题 session 中包含错误-->
                    @if(Session::has('profile_photo_not_supported'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('profile_photo_not_supported') }}
                        </div>
                    @endif

                    <form action="/user/changeAvatar" method="post"
                          class="form-horizontal" role="form"
                          accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="mergeTop" style="height:20px; margin-top: 20px;"></div>
                            {{--<label for="email" class="col-md-4 control-label">文件</label>--}}
                        <input name="avatar" type="file" class="form-control" placeholder="头像" value="" required>
                        <div class="mergeTop" style="height:20px; margin-top: 20px;"></div>
                        <button class="btn btn-primary" type="submit">修改
                        </button>
                        {{ csrf_field() }}
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div style="height: 100px; margin-top: 20px;"></div>
@endsection