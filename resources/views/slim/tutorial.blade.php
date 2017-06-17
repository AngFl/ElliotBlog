<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Slim: The Future of PHP Component</title>

    <meta name="description" content="PSR-7 and Middleware: The Future of PHP">
    <meta name="author" content="Matthew Weier O'Phinney">

    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="theme-color" content="#018401">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">


    <link rel="stylesheet" href="sheets/reveal.min.css">
    <link rel="stylesheet" href="sheets/sky.css" id="theme">
    <link rel="stylesheet" href="sheets/custom.css" id="custom">

    <!-- For syntax highlighting -->
    <link rel="stylesheet" href="sheets/solarized_light.css">

    <!-- If the query includes 'print-pdf', include the PDF print sheet -->
    <script>
        if( window.location.search.match( /print-pdf/gi ) ) {
            var link = document.createElement( 'link' );
            link.rel = 'stylesheet';
            link.type = 'text/css';
            link.href = 'css/print/pdf.css';
            document.getElementsByTagName( 'head' )[0].appendChild( link );
        }
    </script>

    <!--[if lt IE 9]>
    <script src="lib/js/html5shiv.js"></script>
    <![endif]-->
</head>
<body>
    <div class="reveal">
        <div class="slides">
            <section>
                <h2>Slim 3.7 - Tutorial</h2>
                <h3>PHP组件化开发</h3>

                <p>
                    <small><a href="https://outlook.com">linframe@outlook.com</a> /
                        <a href="https://www.slimframework.com">Official Site</a></small>
                </p>
            </section>

            <section>
                <h3>目录</h3>

                <ul>
                    <li class="fragment"><b>Composer</b>: PHP开发依赖管理工具</li>
                    <li class="fragment"><b>Router</b>:  HTTP 自定义路由</li>
                    <li class="fragment"><b>Dependency Injection</b>: 依赖注入</li>
                    <li class="fragment"><b>PSR-7 Support</b>: PSR-7 接口使用规范</li>
                    <li class="fragment"><b>Middleware</b>: PHP 中间件</li>
                    <li class="fragment"><b>PHP SOP</b>: PHP 面向服务编程 </li>
                    <li class="fragment"><b>PHPUnit</b>: PHP单元测试</li>
                </ul>
            </section>

            <section>
                <h3>PHP 依赖管理工具 </h3>

                <img src="/img/logo-composer-transparent.png" style="border: 1px #e3e3e3; box-shadow: 0 0 0" alt="">

            </section>

            <section>

                <h4>Composer 是 PHP 的一个依赖管理工具。 </h4>

                <h4>它允许你申明项目<strong>所依赖的代码库</strong>，并在项目中为你安装他们</h4>

                <p><a href="http://docs.phpcomposer.com/00-intro.html">参见文档说明 </a></p>

                <aside class="notes">
                    <ul>
                        <li>Composer 是 PHP 的一个依赖管理工具。
                            它允许你申明 项目所依赖的代码库，并在项目中为你安装他们</li>
                    </ul>
                </aside>
            </section>

            <section>
                <h2>依赖管理？(项目构建工具？)</h2>

                <ul>
                    <li class="fragment">C Library?  C++/STL</li>
                    <li class="fragment">Java Maven?</li>
                    <li class="fragment"> Python Pip?</li>
                </ul>
            </section>

            <section>
                <h4>这种想法并不新鲜。</h4>
                <p></p>
                    <h4> Composer 受到了 <strong> <a href="http://npmjs.com">node's npm </a></strong>和 <strong><a
                                    href="http://bundler.io">ruby's bundler</a> </strong>
                    的强烈启发。<p></p><br>而当时 PHP 并没有类似的工具。</h4>
            </section>

            <section>
                <h3>Composer 将会这样为你解决问题</h3>

                <ul>
                    <li class="fragment">
                        A有一个项目依赖于若干个库。
                    </li>
                    <li class="fragment">
                        其中一些库依赖于其他库
                    </li>
                    <li class="fragment">
                        如果已经声明好所依赖的库
                    </li>
                    <li class="fragment"> Composer 会找出哪个版本的包需要安装，<br>
                        并安装它们（将它们下载到你的项目中）。</li>
                </ul>

                {{--<ul>--}}
                    {{--<li>Works for <code>application/x-www-form-urlencoded</code> and--}}
                        {{--<code>form/multipart</code> <b>only</b>…</li>--}}
                    {{--<li class="fragment">and only when submitted via POST.</li>--}}
                {{--</ul>--}}

                <aside class="notes">
                    <ul>
                        <li>What about PUT and PATCH and DELETE?</li>
                        <li>What about JSON or XML?</li>
                    </ul>
                </aside>
            </section>

            <section>
                <h2>等等~ 本人是做PHP的！ 嗯哼~</h2>

                <ul><li class="fragment">
                        (ㅍ_ㅍ) 依赖什么 ...
                    </li></ul>
            </section>
            
            <section>
                <h4>对 PHP 命名空间 <br>
                    <p></p>
                    及面向对象开发有一定基础的童鞋 <br>
                    <p></p>
                    请直接跳过以下链接</h4>
                <img src="/img/WX20170503-225019.png" alt="" style="border: 1px #e3e3e3; box-shadow: 0 0 0">
                <p>
                </p>
                <ul>
                    <li class="fragment"><a href="http://php.net/manual/zh/migration53.new-features.php">PHP 5.3 新特性 -_-</a></li>
                    <li class="fragment">
                        <a href="http://php.net/manual/zh/language.namespaces.php">
                            PHP 命名空间
                        </a>
                    </li>

                    <li class="fragment">
                         <a href="http://php.net/manual/zh/language.oop5.autoload.php">
                             PHP类的自动加载
                         </a>
                    </li>
                </ul>
            </section>

            <section>
                <h2>Composer 的安装与使用 </h2>
                    <h4>（严肃点， 要进入正题了）</h4>
            </section>

            <section>
                <h3>推荐官网下载</h3>
                <p><a href="http://getcomposer.org">链接</a>
                </p>

                <ul>
                    <li class="fragment"> Linux/Mac 依照官网教程普通下载即可
                        <br>
                        注意<b>文件权限</b>的问题，试用时查看文件当前所属用户的权限
                        <br> 使用<code>ls -l composer.phar </code>查看权限
                        <br>
                        使用 <code>chown </code> 修改文件权限
                    </li>

                    <li class="fragment">Windows 下安装依照步骤即可</li>

                    <li class="fragment">
                        每个平台下注意所使用的PHP版本号和开启的扩展 (openssl)
                        <br>这里作者推荐使用 <b>PHP7.0</b>及以上
                    </li>
                    <li class="fragment">
                        最后在命令行输入 composer
                    </li>
                </ul>
            </section>
                
            <section>
                <img src="/img/composer.png" alt="" style="border: 1px #e3e3e3; box-shadow: 0 0 0">
            </section>

            <section>
                <h2>声明依赖关系</h2>
                <p></p>

                <p>
                    比如创建一个项目，通常需要一个库来做日志记录。如果决定使用 monolog 这个组件。为了将它添加到你的项目中，你所需要做的就是创建一个 composer.json 文件，其中描述了项目的依赖关系。
                </p>
            </section>

            <section>
                <p>eg： composer.json</p>
                    <p>
                        <pre><code class="lang-php" data-trim>{
    "require": {
        "monolog/monolog": "1.2.*"
    }
}                       </code></pre>   
                    </p>

                <ul>
                    <li class="fragment">
                         将composer.json 文件放置在项目的根目录中
                    </li>
                    <li class="fragment">
                        执行 composer install 
                    </li>
                    <li class="fragment">
                        会在根目录下产生一个 <b>vendor</b> 目录<br>
                        （用来存放安装的库及其依赖库）
                    </li>
                </ul>
            </section>
                    

            <section>
                <p>使用composer 安装</p>
                    <img src="/img/install.png" alt="composer install " style="border: 1px #e3e3e3; box-shadow: 0 0 0">

                    <p>会产生以下的目录结构</p>
                    <img src="/img/lock.png" alt="lock" style="border: 1px #e3e3e3; box-shadow: 0 0 0">
            </section>


            <section>
                    <h3>composer.json 与 composer.lock 的区别</h3>
                    <ul>
                        <li class="fragment">composer.lock 文件是执行了 安装（或创建项目）之后产生的管理文件</li>
                        <li class="fragment">composer install 会读取lock文件中的库依赖和版本</li>
                        <li class="fragment">每个开发人员在拿到项目时由lock文件确定了库版本的一致性</li>
                        <li class="fragment">每次修改 <strong>composer.json </strong> 中的库版本或库依赖，在更新之后均会产生一份新的lock 文件</li>
                    </ul>
            </section>

            <section>
                
                 <h3>composer 的常用命令</h3>
                 <ul>
                     <li class="fragment"> <b>composer install</b> (依照composer.lock 文件安装库依赖)</li>
                     <li class="fragment">  <b>composer update</b>  （如果修改了composer.json 中的库依赖，则会生成新的lock 文件,并更新库）</li>
                     <li class="fragment"> <b>composer require [包名]</b> （引入库依赖文件至当前库）</li>
                 </ul>
            </section>

            <section>
                 <h2>Notice</h2>

                 <ul>
                     <li class="fragment">
                         composer.lock 文件很重要， 团队开发项目都依赖于同一库的版本
                     </li>
                     <li class="fragment">
                         composer.lock 文件发布表明了开源项目依赖库的一致性
                     </li>
                 </ul>
            </section>

            <section>
                <h3> HTTP 自定义路由 （Slim 使用范例）</h3>
                <ul>
                    <li class="fragment">创建路由( Router )</li>
                    <li class="fragment">路由回调 （Callable）</li>
                    <li class="fragment">路由组 (Group)</li>
                    <li class="fragment">容器识别 (Container Resolution)</li>
                </ul>
            </section>


            <section>
                <h3> 创建路由( 敬请期待)</h3>
            </section>
            
            <!--
            <section>
                <h2>Request URI</h2>

                <ul>
                    <li>Canonical source varies based on SAPI…</li>
                    <li class="fragment">and full URI requires investigating up to 9
                        CGI/SAPI variables!</li>
                </ul>

                <aside class="notes">
                    <ul>
                        <li>SCHEME, HTTP_X_FORWARDED_PROTO, HOST, SERVER_NAME, SERVER_ADDR,
                            REQUEST_URI, UNENCODED URL, HTTP_X_ORIGINAL_URL, and ORIG_PATH_INFO</li>
                        <li>This is, again, CGI's fault</li>
                    </ul>
                </aside>
            </section>

            <section>
                <h2>File Uploads</h2>

                <ul>
                    <li>PHP only automatically handles them on POST requests.</li>
                    <li class="fragment">And has a few funky issues with arrays of file
                        uploads…
                    </li>
                </ul>
            </section>

            <section>
                <h2>File uploads (continued)</h2>

                <p>Given <code>$files[0]</code> and <code>$files[1]</code>, you would
                    expect:</p>

                <pre><code class="lang-php" data-trim>
    [
        'files' => [
            0 => [
                'name' => 'file0.txt',
                'type' => 'text/plain',
                /* etc. */
            ],
            1 => [
                'name' => 'file1.html',
                'type' => 'text/html',
                /* etc. */
            ],
        ],
    ];
            </code></pre>
            </section>

            <section>
                <h2>File uploads (still)</h2>

                <p>But PHP gives you:</p>

                <pre><code class="lang-php" data-trim>
    [
        'files' => [
            'name' => [
                0 => 'file0.txt',
                1 => 'file1.html',
            ],
            'type' => [
                0 => 'text/plain,
                1 => 'text/html',
            ],
            /* etc. */
        ],
    ];
            </code></pre>

                <aside class="notes">
                    <ul>
                        <li>Which is completely unintuitive</li>
                        <li>People don't know about this until they encounter it; the manual
                            doesn't make the difference clear.</li>
                    </ul>
                </aside>
            </section>

            <section>
                <h2>Streams</h2>

                <ul>
                    <li>PHP abstracts both input and output as streams</li>
                    <li class="fragment">but actively makes dealing with those streams
                        difficult.</li>
                </ul>

                <aside class="notes">
                    <ul>
                        <li>Before PHP 5.6, <code>php://input</code> was read-<b>ONCE</b>,
                            which could lead to unexpected issues if you tried reading more
                            than once.</li>
                        <li>Understanding output buffering is a black art, and requires
                            understanding a lot about how PHP works under the hood to get
                            right.</li>
                    </ul>
                </aside>
            </section>

            <section>
                <h1>Abstractions</h1>

                <aside class="notes">
                    <ul>
                        <li>The upshot is that while PHP offers easily useful and consumed
                            abstractions via the superglobals, there's enough difficulty and
                            confusion that people feel the need to provide additional
                            abstractions.</li>
                        <li>Enter the frameworks!</li>
                    </ul>
                </aside>
            </section>

            <section>
                <h2>Every framework creates their own</h2>

                <ul>
                    <li>Zend Framework</li>
                    <li>Symfony</li>
                    <li>Aura</li>
                </ul>
            </section>

            <section>
                <h2>Even client applications!</h2>

                <ul>
                    <li>Guzzle</li>
                    <li>Buzz</li>
                    <li>Requests</li>
                    <li>Zend\Http\Client</li>
                </ul>
            </section>

            <section>
                <h2>Too many abstractions<br />==<br />Babel</h2>

                <aside class="notes">
                    <ul>
                        <li>Too many abstractions means nobody speaks the same, and users
                            have to learn new abstractions anytime they pick up a new
                            framework or HTTP client library.</li>
                    </ul>
                </aside>
            </section>

            <section>
                <h2>HTTP Message abstractions should be a commodity</h2>

                <aside class="notes">
                    <ul>
                        <li>You cannot currently switch from ZF to Symfony or Aura easily due
                            to the differences in abstractions, and the learning curve required to
                            pick up new abstractions.</li>
                        <li>The same is true for any HTTP client library.</li>
                        <li>Considering <b>the web</b> is the <em>lingua franca</em> of PHP,
                            shouldn't these be something we all share?</li>
                    </ul>
                </aside>
            </section>

            <section>
                <h2>Requests have a specification</h2>

                <pre><code class="lang-http" data-trim>
    POST /path HTTP/1.1
    Host: example.com
    Accept: text/html

    Message body
            </code></pre>

                <aside class="notes">
                    <ul>
                        <li>Request line is the METHOD, a request target, which is usually
                            the path, and the HTTP protocol used </li>
                        <li>Then you have headers.</li>
                        <li>Then you have the message body, which can be empty.</li>
                </aside>
                </ul>
            </section>

            <section>
                <h2>Responses have a specification</h2>

                <pre><code class="lang-http" data-trim>
    HTTP/1.1 200 OK
    Content-Type: text/html

    <b>Success!</b>
            </code></pre>

                <aside class="notes">
                    <ul>
                        <li>Status line is the HTTP protocol, status code, and optionally a
                            reason phrase (which HTTP/2 omits)</li>
                        <li>Then you have headers.</li>
                        <li>Then you have the message body, which can be empty.</li>
                        <li><em>The point is that the message formats are well-known and
                                well-specified; they should have built-in support in the language!</em></li>
                    </ul>
                </aside>
            </section>

            <section>
                <h1>PSR-7: A history</h1>
            </section>

            <section>
                <h2>Benjamin Eberlei</h2>
                <h3>HTTP Client interfaces</h3>
                <h4>March 2012</h4>

                <aside class="notes">
                    <ul>
                        <li>Essentially, Benjamin noticed that there was a lot of
                            commonality in how HTTP clients did their work, and felt that
                            could be abstracted, making it simpler to swap out clients based
                            on capabilities (such as ability to work with certain adapters,
                            use TLS vs SSL, etc.)</li>
                    </ul>
                </aside>
            </section>

            <section>
                <h2>Chris Wilkinson</h2>
                <h3>HTTP Message Interfaces</h3>
                <h4>December 2012</h4>

                <aside class="notes">
                    <ul>
                        <li>Chris noted that discussion around the HTTP client interfaces
                            had reached the conclusion that they were reliant on having robust
                            HTTP Message interface specifications in place first, and proposed
                            a set of interfaces around that.</li>
                        <li>One other item noted was that these could be useful for
                            server-side applications as well.</li>
                    </ul>
                </aside>
            </section>

            <section>
                <h2>Michael Dowling</h2>
                <h3>HTTP Mesage Interfaces: Draft</h3>
                <h4>January 2014</h4>

                <aside class="notes">
                    <ul>
                        <li>Over a year later, Michael Dowling, of Guzzle fame, published
                            the first draft of HTTP Message Interfaces, acting ast the Editor
                            for the PSR.</li>
                        <li>Due to his background with Guzzle, these were primarily
                            targeting client-side applications.</li>
                        <li>Headers were treated as a part of a message, not as a separate
                            object; the argument was that the spec indicates headers define
                            the value of a message.</li>
                        <li>Message bodies were treated as <em>streams</em>; this was
                            revolutionary, as it ensures that usage between implementations
                            must be the same, and using streams is no longer an optional
                            optimization.</li>
                    </ul>
                </aside>
            </section>

            <section>
                <h2>Michael Dowling</h2>
                <h3>HTTP Mesage Interfaces: Redacted</h3>
                <h4>August 2014</h4>

                <aside class="notes">
                    <ul>
                        <li>The tyranny of the masses got to Michael, and he felt the
                            constant argumentation was preventing forward momentum.</li>
                        <li>Regardless, he planned to continue modeling Guzzle on the latest
                            version of the draft.</li>
                    </ul>
                </aside>
            </section>

            <section>
                <h2>Matthew Weier O'Phinney</h2>
                <h3>HTTP Mesage Interfaces: Draft</h3>
                <h4>September 2014</h4>

                <aside class="notes">
                    <ul>
                        <li>My team had just finished a prototype of Apigility in Node.js</li>
                        <li>I had ported Sencha Connect to PHP, and, in doing so, chosen to
                            target PSR-7 — which had required creating a PSR-7 implementation.</li>
                        <li>I was interested in the server-side ramifications.</li>
                    </ul>
                </aside>
            </section>

            <section>
                <h2>Additions to interfaces</h2>

                <ul>
                    <li><code>ServerRequestInterface</code> to handle:
                        <ul>
                            <li>PHP superglobal-type request parameters</li>
                            <li>common concerns such as routing parameters</li>
                            <li>message body parameter abstraction</li>
                        </ul>
                    </li>
                    <li class="fragment"><code>UriInterface</code> to model the URI.</li>
                    <li class="fragment"><code>UploadedFileInterface</code> to model file
                        uploads.</li>
                    <li class="fragment">Immutable <em>value objects</em></li>
                </ul>

                <aside class="notes">
                    <ul>
                        <li>Thank Larry Garfield for his assistance with the UriInterface</li>
                        <li>Thank Bernard Shussek for his contribution of the
                            UploadedFileInterface</li>
                        <li>We'd been modeling them as value objects, but decided to take
                            this to the logic conclusion of immutability.</li>
                    </ul>
                </aside>
            </section>

            <section>
                <h2>Relationships</h2>

                <p><img src="img/interface-relationships.png" alt="PSR-7 Interface relationships" /></p>
            </section>

            <section>
                <h2>Acceptance: 18 May 2015</h2>
            </section>

            <section>
                <h1>Examples</h1>
            </section>

            <section>
                <h2>All Messages</h2>

                <pre><code class="lang-php" data-trim>
    $headerValues = $message->getHeader('Cookie');     // array!
    $headerLine   = $message->getHeaderLine('Accept'); // string!
    $headers      = $message->getHeaders(); // string => array pairs
    $body         = $message->getBody();    // StreamInterface
    $message      = $message->withHeader('Foo', 'Bar');
    $message      = $message->withBody($stream);
            </code></pre>
            </section>

            <section>
                <h2>RequestInterface — Clients</h2>

                <pre><code class="lang-php" data-trim>
    $body = new Stream();
    $stream->write('{"foo":"bar"}');
    $request = (new Request())
        ->withMethod('GET')
        ->withUri(new Uri('https://api.example.com/'))
        ->withHeader('Accept', 'application/json')
        ->withBody($stream);
            </code></pre>

                <aside class="notes">
                    <p>
                        This is how you'd create a request — which will be primarily useful
                        for clients.
                    </p>
                </aside>
            </section>

            <section>
                <h2>UriInterface</h2>

                <pre><code class="lang-php" data-trim>
    $scheme   = $uri->getScheme();
    $userInfo = $uri->getUserInfo();
    $host     = $uri->getHost();
    $port     = $uri->getPort();
    $path     = $uri->getPath();
    $query    = $uri->getQuery();
    $fragment = $uri->getFragment();
    $uri      = $uri->withHost('example.com');
            </code></pre>
            </section>

            <section>
                <h2>ResponseInterface — Clients</h2>

                <pre><code class="lang-php" data-trim>
    $status      = $response->getStatusCode();
    $reason      = $response->getReasonPhrase();
    $contentType = $response->getHeader('Content-Type');
    $data        = json_decode((string) $response->getBody());
            </code></pre>

                <aside class="notes">
                    <p>
                        And on the flip side, if I want to consume a response, I have a
                        similar OOP interface -- in fact, it mirrors that of requests for
                        items like headers and the body.
                    </p>
                </aside>
            </section>

            <section>
                <h2>ServerRequestInterface</h2>

                <pre><code class="lang-php" data-trim>
    $request = ServerRequestFactory::fromGlobals();
    $method  = $request->getMethod();
    $path    = $request->getUri()->getPath();
    $accept  = $request->getHeaderLine('Accept');
    $data    = json_decode((string) $request->getBody());
    // $request = $request->withParsedBody($data);
    // $params  = $request->getParsedBody();
    $query   = $request->getQueryParams();
    $cookies = $request->getCookieParams();
    $files   = $request->getUploadedFiles();
            </code></pre>

                <aside class="notes">
                    <p>
                        Consuming a request is similar to creating it - you have access to
                        every request member. For server-side requests, you also get access
                        to values usually in superglobals, such as $_GET, $_COOKIE, etc.
                    </p>

                    <p>
                        Note that URI abstraction is also included - you don't need to
                        parse the URI to get at the various segments.
                    </p>
                </aside>
            </section>

            <section>
                <h2>ServerRequestInterface — Attributes</h2>

                <p>Problem: how do we represent parameters matched by routing?</p>

                <pre><code class="lang-php" data-trim>
    foreach ($matchedParams as $key => $value) {
        $request = $request->withAttribute($key, $value);
    }
    // Later:
    $id = $request->getAttribute('id', 1);
            </code></pre>

                <aside class="notes">
                    <ul>
                        <li>This was one place where we invented something, because every
                            framework routes, but they vary in how those matches are
                            propagated through the application.</li>
                    </ul>
                </aside>
            </section>

            <section>
                <h2>Uploaded Files</h2>

                <pre><code class="lang-php" data-trim>
    $size   = $file->getSize();
    $error  = $file->getError(); // PHP file upload error constant
    $name   = $file->getClientFilename();
    $type   = $file->getClientMediaType();
    $stream = $file->getStream(); // StreamInterface!
    $file->moveTo($targetPath);
            </code></pre>

                <aside class="notes">
                    <ul>
                        <li>moveTo() abstracts the operation of moving the file, which
                            allows the abstraction to be used in non-SAPI environments such as
                            ReactPHP!</li>
                        <li>Retrieving as a stream allows streaming a file upload somewhere,
                            such as S3, in a performant way that reduces memory usage.</li>
                    </ul>
                </aside>
            </section>

            <section>
                <h2>ResponseInterface</h2>

                <pre><code class="lang-php" data-trim>
    $body = new Stream();
    $stream->write(json_encode(['foo' => 'bar']));
    $response = (new Response())
        ->withStatus(200, 'OK!')
        ->withHeader('Accept', 'application/json')
        ->withBody($stream);
            </code></pre>

                <aside class="notes">
                    <p>
                        Creating a response allows you to set all aspects of the response,
                        from status to headers to the body.
                    </p>
                </aside>
            </section>

            <section>
                <h2>PSR-7 in a nutshell</h2>

                <h4>Uniform access to HTTP messages</h4>

                <aside class="notes">
                    Who cares? Why not just use one of the existing request/response
                    abstractions from an existing framework? Perfectly valid. It's what
                    having a uniform interface enables that's interesting.
                </aside>
            </section>

            <section>
                <h1>Middleware</h1>
            </section>

            <section>
                <h2>Middle what?</h2>

                <p class="fragment"><img src="img/lambda.png" alt="StackPHP Kernel" /></p>

                <aside class="notes">
                    <ul>
                        <li>Middleware transforms a request into a response.</li>
                        <li>Typically used in server-side applications, but has been used
                            successfully in client-side as well; recent Guzzle versions make
                            extensive use of it.</li>
                        <li>Popularized by WSGI, Rack, and Node.</li>
                    </ul>
                </aside>
            </section>

            <section>
                <h2>Common Styles</h2>
                <h4>Lambda</h4>

                <pre><code class="lang-php" data-trim>
    function (ServerRequestInterface $request) : Response
            </code></pre>

                <aside class="notes">
                    <ul>
                        <li>This is a literal interpretation of the pattern.</li>
                        <li>Laravel 5 and Lumen use this pattern; StackPHP kind of does.</li>
                    </ul>
                </aside>
            </section>

            <section>
                <h2>Common Styles</h2>
                <h4>Injected Response</h4>

                <pre><code class="lang-php" data-trim>
    function (
        ServerRequestInterface $request,
        ResponseInterface $response
    ) : ResponseInterface
            </code></pre>

                <aside class="notes">
                    <ul>
                        <li>Passing the response means that <em>the consumer does not need to
                                depend on a concrete response</em>, but can depend on the abstraction.</li>
                        <li>This is what ZF2 uses via the DispatchableInterface.</li>
                    </ul>
                </aside>
            </section>

            <section>
                <h2>Q: How do you accomplish complex behavior?</h2>

                <p class="fragment">A: By composing middleware.</p>

                <pre class="fragment"><code class="lang-php" data-trim>
    class ClacksOverhead
    {
        public function __construct(callable $app) {
            $this->app = $app;
        }
        public function __invoke($request, $response) {
            $response = $this->app->__invoke($request, $response);
            return $response->withHeader(
                'X-Clacks-Overhead',
                'GNU Terry Pratchett'
            );
        }
    }
            </code></pre>

                <aside class="notes">
                    <ul>
                        <li>Essentially, you can create complex behaviors by nesting
                            middleware. This requires that the middleware have a standard way
                            of injecting middleware, however…</li>
                    </ul>
                </aside>
            </section>

            <section>
                <h2>Common Styles</h2>
                <h4>Injected "Next" Middleware</h4>

                <pre><code class="lang-php" data-trim>
    function (
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next
    ) : ResponseInterface
            </code></pre>
            </section>

            <section>
                <h2>Invoking the "Next" middleware</h2>

                <pre><code class="lang-php" data-trim>
    // route the request
    // and now inject it:
    foreach ($matches as $key => $value) {
        $request = $request->withAttribute($key, $value);
    }
    return $next(
        $request,
        $response->withHeader(
            'X-Clacks-Overhead',
            'GNU Terry Pratchett'
        )
    );
            </code></pre>

                <aside class="notes">
                    <ul>
                        <li>Instead of convention-based injection of middleware to nest,
                            it's now explicit; you call <code>$next()</code> if there's more
                            processing to do.</li>
                        <li><code>$next</code> is given the request and response to pass to
                            the next middleware. This is where immutability becomes very
                            interesting!</li>
                        <li>Used by Relay, Slim v3, Stratigility/Expressive.</li>
                    </ul>
                </aside>
            </section>

            <section>
                <h1>Why is middleware important?</h1>
            </section>

            <section>
                <h1>An end to framework silos</h1>

                <aside class="notes">
                    We've all seen it: Symfony-specific bundles, ZF2-specific modules,
                    Laravel-specific packages. These mean that people are solving the
                    same problems over and over again, but wrapping them up as
                    framework-specific solutions. We need to stop that.
                </aside>
            </section>

            <section>
                <h3>Make frameworks consume middleware</h3>

                <pre><code class="lang-php" data-trim>
    class ContactController
    {
        private $contact;
        public function __construct(Contact $contact)
        {
            $this->contact = $contact;
        }

        public function dispatch(Request $req, Response $res)
        {
            return call_user_func($this->contact, $req, $res);
        }
    }
            </code></pre>

                <aside class="notes">
                    Hypothetical at this point, but demonstrates the idea: the framework
                    now consumes generic middleware. Theoretically, the framework could
                    simply route to generic middleware!
                </aside>
            </section>

            <section>
                <h3>Wrap frameworks in middleware</h3>

                <pre><code class="lang-php" data-trim>
    $app->pipe(function ($req, $res, $next) {
        $framework = bootstrap_framework();
        $response  = $framework->run(
            convertRequestToFramework($req),
            convertResponseToFramework($res),
        );
        return convertFrameworkResponse($response);
    });
            </code></pre>

                <aside class="notes">
                    <ul>
                        <li>Once you get here, you can mix and match code from frameworks,
                            letting each do what it does best, or…</li>
                        <li>migrate from frameworks to <em>middleware</em></li>
                    </ul>
                </aside>
            </section>

            <section>
                <h1 class="nocaps">The future of HTTP in PHP is <em>collaborative</em></h1>
            </section>

            <section>
                <h1 class="nocaps">The future of HTTP in PHP is <em>now!</em></h1>
            </section>

            <section>
                <h2>Resources</h2>

                <ul>
                    <li><a href="https://mwop.net/blog/tag/http">https://mwop.net/blog/tag/http</a> (PSR-7 articles)</li>
                    <li><a href="http://www.php-fig.org/psr/psr-7/">http://www.php-fig.org/psr/psr-7/</a></li>
                    <li><a href="http://www.php-fig.org/psr/psr-7/meta/">http://www.php-fig.org/psr/psr-7/meta/</a></li>
                    <li><a href="https://github.com/zendframework/zend-diacotoros">https://github.com/zendframework/zend-diactoros</a> for an implementation</li>
                    <li><a href="https://github.com/zendframework/zend-expressive">https://github.com/zendframework/zend-expressive</a>, a framework-agnostic PSR-7 middleware microframework</li>
                    <li><a href="http://www.slimframework.com">Slim v3 </a> is built on PSR-7</li>
                    <li><em>and the latest versions of Symfony support it too!</em></li>
                </ul>
            </section>

            <section>
                <h2>Thank You</h2>

                <h4>Matthew Weier O'Phinney</h4>

                <h4 class="nocaps"><a href="http://joind.in/15537">http://joind.in/15537</a></h4>

                <h4 class="nocaps">
                    <a href="https://mwop.net/">https://mwop.net/</a><br>
                    <a href="https://apigility.org">https://apigility.org</a><br>
                    <a href="http://framework.zend.com">http://framework.zend.com</a><br>
                    <a href="https://twitter.com/mwop">@mwop</a>
                </h4>
            </section>

            -->
        </div>
    </div>

    <script src="js/head.min.js"></script>
    <script src="js/reveal.min.js"></script>

    <script>
        // Full list of configuration options available here:
        // https://github.com/hakimel/reveal.js#configuration
        Reveal.initialize({
            controls: true,
            progress: true,
            history: true,
            center: true,

            theme: Reveal.getQueryHash().theme, // available themes are in /css/theme
            transition: Reveal.getQueryHash().transition || 'concave', // default/cube/page/concave/zoom/linear/fade/none

            // Parallax scrolling
            // parallaxBackgroundImage: 'https://s3.amazonaws.com/hakim-static/reveal-js/reveal-parallax-1.jpg',
            // parallaxBackgroundSize: '2100px 900px',

            // Optional libraries used to extend on reveal.js
            dependencies: [
                { src: 'lib/js/classList.js', condition: function() { return !document.body.classList; } },
                { src: 'plugin/highlight/highlight.js', async: true, callback: function() { hljs.initHighlightingOnLoad(); } },
                { src: 'plugin/zoom-js/zoom.js', async: true, condition: function() { return !!document.body.classList; } },
                { src: 'plugin/notes/notes.js', async: true, condition: function() { return !!document.body.classList; } }
            ]
        });
    </script>
</body>
</html>
