@extends('archives.tag')

@section('content')
    <div class="row">
        <main class="col-md-12 main-content">
            <div class="panel">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <h3> 搜索结果</h3>
                </div>
                <div class="panel-body" id="search-content">
                    @if(count($detailSearchRes))
                        @foreach($detailSearchRes as $item)
                            <h4> {{ $item->title }}</h4>
                            <p> {!!  substr($item->content,0,60).'...' !!}  </p>
                        @endforeach
                    @else
                        <h4> 文章结果不存在 </h4>
                    @endif

                    @if(count($userSearchRes))
                        @foreach($userSearchRes as $item)
                            <h4> {{ $item->nickname }}</h4>
                        @endforeach
                    @else
                         <h4>用户结果不存在</h4>
                    @endif
                </div>
            </div>
        </main>
    </div>
@endsection