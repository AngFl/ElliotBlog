@extends('archives.tag')

@section('ajaxMeta')
    <meta name="_token" content="{{ csrf_token() }}"/>
@endsection

@section('content')
    
    <div class="row">
        <div class="col-md-8" role="main">
            <div class="blog-post">
                {!! $html !!}
            </div>
            @if($editPermissionFlag)
            <div class="row">
                <div class="col-md-12">
                        <a href="/archives/edit/{{ $detail->id }}">修改文章</a>
                </div>
            </div>
            @endif

            <div id="commentsList">
            @foreach($comments as $comment)
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object img-circle"
                                 src="{{ $comment->user->avatar }}" alt="64x64"
                            style="width:64px; height:64px;">
                        </a>
                    </div>
                    <div class="media-body">
                        <h5 class="media-heading">
                            {{ $comment->user->nickname }} &nbsp;
                            <span class="glyphicon glyphicon-comment">
                            {{ $comment->created_at }}
                            </span>
                        </h5>
                        {!! $comment->body !!}
                    </div>
                </div>
            @endforeach
            </div>

            {{-- 评论提交--}}
            <hr>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        @if(Auth::check())
                           <span id="guardUser"> {{ Auth::user()->nickname }} </span>
                        @else
                            <span id="guardUser">Guest 身份</span>
                        @endif
                    </h3>
                </div>

                <!--   自定义错误消息提示 -->
                @if($errors->any())
                    <ul class="list-group">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="panel-body">
                    <form  accept-charset="utf-8">
                    {{--<form method="post" action="/archives/comment/{{ $detail->id }}" accept-charset="utf-8">--}}
                        <div class="form-group">
                            <label for="" class="control-label">评论</label>
                            <textarea  placeholder="支持Markdown格式"
                                      name="body" id="" cols="25" rows="3" class="form-control"></textarea>
                            <input type="hidden" name="detail_id" value="{{ $detail->id }}">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary" id="commentPost">
                            {{--<button type="submit" class="btn btn-primary">--}}
                                <span class="glyphicon glyphicon-comment"></span>
                                提出问题
                            </button>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
        <!--  加载数据基础 -->
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                     <h5>您可能还对相关的文章感兴趣</h5>
                </div>

                <div class="panel-body">
                    @foreach($relativeArticles as $item)
                    <p>
                        <a href="/archives/show/{{ $item->id }}">
                            {{ $item->title }}
                        </a>
                    </p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop