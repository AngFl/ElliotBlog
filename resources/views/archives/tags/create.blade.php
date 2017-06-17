@extends('archives.tag')

@section('cpStyle')
       {!! editor_css() !!}
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <!--   自定义错误消息提示 -->
            @if($errors->any())
                <ul class="list-group">
                    @foreach($errors->all() as $error)
                        <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form action="/archives/store" method="post" accept-charset="utf-8">
                <div class="form-group">
                    <label for="title" class="control-label">标题:</label>
                    <input id="" name="title" type="text" class="form-control" placeholder="title">
                </div>
                <div class="form-group">
                    <label for="author" class="control-label">作者:</label>
                    @if(Auth::check())

                    <input id="" name="author" type="text"
                           class="form-control" placeholder="author"
                           value="{{ Auth::user()->nickname }}">
                        @else
                        <input id="" name="author" type="text"
                               class="form-control" placeholder="author" value="">
                    @endif
                </div>

                <div class="form-group">
                    <label for="content" class="control-label">内容</label>
                    <div id="editormd_id">
                        <textarea name="content" id="" cols="30" rows="10" style="display:none;"
                         class="form-control">
                            
                        </textarea>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="note" class="control-label">类别:</label>

                    <select name="note" id="" class="form-control">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->describe }}">{{ $tag->describe }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success form-control">发表博文</button>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                {{ csrf_field() }}
            </form>
        </div>
    </div>

    <script src="//cdn.bootcss.com/jquery/2.1.0/jquery.min.js"></script>
    {!! editor_js() !!}
@stop