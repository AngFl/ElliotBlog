@extends('archives.tag')

@section('content')
    <div class="row">
        <main class="col-md-8 main-content">
        <div class="page-header">
            <h2>Archives</h2>
                <p>在 Web应用开发的某些场景中，我们会频繁开发一些特定的功能，但开发这些功能又与团队的技术栈完全背离，所以我们推荐使用PHP依赖管理工具
                <a href="http://getcomposer.org">
                   Composer</a>，以最快速度的完成这些耗时的开发。
                </p>
            </h5>
        </div>
        <!--  使用 panel 样式加载博客内容 -->
        @foreach($details as $detail)
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <h4>{{ $detail->title }}</h4>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-pills" role="tablist">
                        <li role="presentation">
                            <a>
                                 <span class="glyphicon glyphicon-pushpin">
                                </span>
                            </a>
                        </li>
                        <li role="presentation">
                            <a style="font-size: 13px;">
                                最近由
                                <span style="color: #ff5c2d">{{ $detail->author }}</span>
                                更新于
                                {{ App\Services\TimeHandlerService::timeInterval($detail->created_at) }}
                            </a>
                        </li>

                        <li role="presentation">
                            <a>
                                <span class="glyphicon glyphicon-comment">
                                    评论
                                </span>
                                <span class="badge">{{ $detail->comment_int }}</span>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="/archives/{{ $detail->id }}/thumbs-up">
                                <span class="glyphicon glyphicon-thumbs-up">
                                    支持
                                </span>
                                <span class="badge"> {{ $detail->thumbs_up }}</span>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="/archives/show/{{ $detail->id }}"> 查看更多</a>
                        </li>
                    </ul>
                </div>
            </div>
        @endforeach
            {{--  分页样式 --}}
             {!! $details->appends(['visit'=>'scanned'])->links() !!}
        </main>

        <aside class="col-md-4 sidebar">
            <!-- start widget -->
            <!-- end widget -->
            <!-- start tag cloud widget -->
            <div class="widget">
                <h4 class="title">相关链接</h4>
                <div class="content community">
                    <p>
                        <a href="http://www.slimframework.com"
                           title="Slim Official Site" target="_blank">
                            Slim Framework
                        </a>
                    </p>
                    <p>
                        <a href="http://www.slimphp.net"
                           title="Slim 框架中文网" target="_blank">
                            Slim 框架中文网
                        </a>
                    </p>
                </div>
            </div>
            <!-- end tag cloud widget -->
            <!-- start tag cloud widget -->
            <div class="widget">
                <h4 class="title">标签</h4>
                <div class="content tag-cloud">
                    @foreach($tags as $tag)
                    <a href="/archives/category/{{ $tag->describe }}">{{ $tag->describe }}</a>
                    @endforeach
                </div>
            </div>
            <!-- end tag cloud widget -->
        </aside>
    </div>
@stop
