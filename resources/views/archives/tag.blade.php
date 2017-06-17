<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="Slim 开发，Slim组件，Slim3,laravel，PHP组件">
    <meta name="description" content=" Slim 定制化开发， 聚合出符合业务的框架体系，PHP组件解决业务员的烦恼">

    @yield('ajaxMeta')

    <title>王扶林博客</title>
    <link rel="shortcut icon" href="/wfl.ico">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          crossorigin="anonymous">
    <!--  有待优化 -->
    <link rel="stylesheet" href="/css/app.css" type="text/css">

    <link href="http://cdn.bootcss.com/highlight.js/8.0/styles/monokai_sublime.min.css" rel="stylesheet">

    @yield('cpStyle')
</head>
<body>

<div class="container">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <!-- The element will be interpreted by Browser : navigation -->
        <div class="container-fluid">
            <!-- menu button was hidden  -->
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#bs-1">
                    <!-- collapse navbar-collaspe div ingredient -->
                    <span class="sr-only">高级导航</span>
                    <!--  Every line in content of the Button-->
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="/" class="navbar-brand">
                    <span class="glyphicon glyphicon-globe"></span>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="bs-1">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="/archives/lists">
                            归档
                            <span class="glyphicon glyphicon-book"></span>
                        </a>
                    </li>
                    <li><a href="/archives/create">发表新博文(话题）</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle"
                           data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">
                            分类 <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/archives/tag/create">添加分类</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/archives/"> 标记 </a></li>
                        </ul>
                    </li>
                </ul>
                <!-- location form-->
                <form class="navbar-form navbar-right" role="search" >
                    <div class="form-group">
                        <input type="text" class="form-control" name="q" required="required" placeholder="Keywords"/>
                    </div>
                    <button class="btn btn-primary" type="button" id="trigger-search">搜索</button>
                </form>
                <!--<button class="btn btn-info navbar-btn">Sign in</button> -->
                <ul class="nav navbar-nav navbar-right">
                    <!--  用户视图页面展示-->
                    @if(Auth::check())
                    <li><img src="{{ Auth::user()->avatar }}" class="img-circle" width="35" alt="" style="margin-top: 6px"></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" role="button">
                            {{ Auth::user()->nickname }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="">个人中心</a></li>
                            <li><a href="/user/avatar">更换头像</a></li>
                            <li class="divider"></li>
                            <li>
                                <a href="/user/logout">注销
                                    <span class="glyphicon glyphicon-log-out">
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @else
                        <li><a href="/user/login">登录</a></li>
                        <li><a href="/user/register">注册</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="bench-footer" style="height: 20px; margin-top: 60px;">
    </div>
    {{-- Content --}}
    @yield('content')
</div>

<footer class="main-footer" style="margin-top: 160px;">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="title">最新动态</h4>
                <div class="content recent-post">
                    <a href="/post/laravel-5-4-is-now-released/"
                       class="post-title">
                        Elliot 博客正式上线</a>
                    <div class="date">2017年4月28日</div>
                </div>
            </div>

            <div class="col-sm-4">
                <h4 class="title">友情赞助</h4>
            </div>
        </div>
    </div>
</footer>
<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <span>© 2017 Stardustio. All rights reserved </span> |
                <span>陕ICP备16019537号-1</span>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/js/jquery.min.js"></script>
<!-- Markdown 高连语法JS组件  -->
<script src="http://cdn.bootcss.com/highlight.js/8.0/highlight.min.js"></script>
<script type="text/javascript">
    hljs.initHighlightingOnLoad();
</script>
<!-- Flash Message JS 组件  -->
@include('flashy::message')

<script type="text/javascript">
    $(document).ready(function(){
        $("#trigger-search").click(function(e){
            var keywords = $("input[name=q]").val();
            if(0 == keywords.length){
                e.preventDefault();
                // 此时应该有个VueJs 的组件？-_-
            }else{
                window.location.href = '/search?q='+ keywords;
            }
        })

        $('#commentPost').click(function(e){
            if(-1 !== $('#guardUser').html().indexOf('Guest')){
                 window.location.href = '/user/login';
            }

            var comment = $("textarea[name='body']").val();
            var detail_id  = $("input[name='detail_id']").val();

            if(0 !== comment.length){
                $("textarea[name='body']").css('border-color','#ccc');
                $.ajax({
                    type: 'POST',
                    url : '/archives/comment',
                    data : {
                        'body'     : comment,
                        'detail_id': detail_id
                    },
                    dataType : 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success: function(data){
                        // 复制一份元素的节点到评论列表
                        //$($('.media')[0]).clone().appendTo('#commentsList');
                        if(0 == $('.media').length){
                             $("<div class='media'><div class='media-left'>" +
                                 "<a href='#'>" +
                                 "<img class='media-object img-circle'src='"+data.avatar+"' alt='64x64' style='width:64px; height:64px;'>" +
                                 "</a>" +
                                 "</div>" +
                                 "<div class='media-body'>" +
                                 "<h5 class='media-heading'>"+data.nickname+" &nbsp; " +
                                 "<span class='glyphicon glyphicon-comment'>"+data.created_at+"</span></h5>"+data.body+"</div>" +
                                 "</div>").appendTo('#commentsList');
                        }else{
                            // 找出最后节点的索引
                            var lastNodeIndex = $('.media').length - 1;
                            // 添加用户的评论
                            $($('.media')[lastNodeIndex]).after("<div class='media'><div class='media-left'>" +
                                "<a href='#'>" +
                                "<img class='media-object img-circle'src='"+data.avatar+"' alt='64x64' style='width:64px; height:64px;'>" +
                                "</a></div>" +
                                "<div class='media-body'>" +
                                "<h5 class='media-heading'>"+data.nickname+" &nbsp; " +
                                "<span class='glyphicon glyphicon-comment'>"+data.created_at+"</span>" +
                                "</h5>"+data.body+"</div></div>");
                        }
                        $("textarea[name='body']").val('');
                    },
                    error: function(data){
                        $("<div class='alert alert-danger' role='alert'>服务器繁忙请稍受重试~</div>").appendTo('#commentList');
                    }
                });
            }else{
                $("textarea[name='body']").css('border-color','red');
            }
        })
    })
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
</script>
<script type="text/javascript" src="http://tajs.qq.com/stats?sId=62014825" charset="UTF-8"></script>
</body>
</html>