@extends('archives.tag')

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


            <form action="/archives/tag/store" method="post" accept-charset="utf-8">
                <div class="form-group">
                    <label for="title" class="control-label">种类:</label>
                    <input id="" name="describe" type="text" class="form-control" placeholder="title">
                </div>
                <div class="form-group">
                    <label for="note" class="control-label">备注:</label>
                    <input id="" name="notes" type="text" class="form-control" placeholder="note"
                           value="note this article">
                </div>

                <button type="submit" class="btn btn-success form-control">添加种类</button>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                {{ csrf_field() }}
            </form>
        </div>
    </div>

    <div style="height: 100px; margin-top: 100px;"></div>
@stop