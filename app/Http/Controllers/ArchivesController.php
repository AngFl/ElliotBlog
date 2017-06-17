<?php

namespace App\Http\Controllers;


use App\Detail;
use App\Repositories\DetailRepository;
use App\Repositories\UserRepository;
use App\Tag;
use App\Markdown\Markdown;

use Illuminate\Http\Request;

use App\Http\Requests;

class ArchivesController extends Controller
{
    /**
     * 使用MarkDown Parser 格式文本数据
     * @var Markdown
     */
    protected $markdownParser;

    protected $userRepository;

    protected $detailRepository;

    /**
     * 依赖注入 Markdown Parser, 文章查询仓库， 用户查询仓库
     * ArchivesController constructor.
     * @param Markdown $markdownParser
     * @param UserRepository $userRepository
     * @param DetailRepository $detailRepository
     */
    public function __construct(Markdown $markdownParser,
                                UserRepository $userRepository,
                                DetailRepository $detailRepository)
    {
        $this->markdownParser = $markdownParser;

        $this->userRepository = $userRepository;

        $this->detailRepository = $detailRepository;
    }

    public function slimTutorial()
    {
        return view('slim.tutorial');
    }

    // Slim 3 引导主页面
    public function home()
    {
        return view('app');
    }

    /**
     * 博客内容主页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lists()
    {
        $tags = Tag::all(['describe']);

        //$details = Detail::all(['title','content','id','author'])->orderBy('create_at','desc');
        $details = Detail::select(['id','title','author','thumbs_up','comment_int', 'created_at'])->orderBy('created_at','desc')->paginate(7);

        return view('archives.tags.content', compact('tags','details'));
    }

    /**
     * 文章ID
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $detail = Detail::find($id);

        $editPermissionFlag = false;

        $userEmail = \Session::get('user_email');
        if(!empty($userEmail)){
            $editAuthor = $detail->user;
            $author = $this->userRepository->withUserEmailFetchID($userEmail);
            $author->id === $editAuthor->id && $editPermissionFlag = true;
        }

        // Markdown 格式文本数据
        $html = $this->markdownParser->markdown($detail->content);

        //同种类相关文章
        $relativeArticles = $this->detailRepository->withRelativeContent($detail->note, $id);

        foreach($detail->comments as $comment){
            $comment->body = $this->markdownParser->markdown($comment->body);
        }

        $comments = $detail->comments;
        // HTML Parser 视图渲染
        return view('archives.tags.show',
            compact('detail','html','relativeArticles','comments','editPermissionFlag'));
    }

    /**
     * 发表博客显示页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        // 发表博客时选择的类别
        $tags = Tag::all(['describe','notes']);

        return view('archives.tags.create', compact('tags'));
    }

    /**
     * 存储发表的博客
     * @param Requests\BlogPostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Requests\BlogPostRequest $request)
    {
        // 关联已经登陆的用户发表数据内容
        $data = [
            'user_id' => \Auth::user()->id,
            'author'  => \Auth::user()->nickname,
        ];


        $detail = Detail::create(array_merge($request->all(),$data));

        // 定向跳转视图， 带入数据文章的链接 ID
        return redirect()->action('ArchivesController@show',
            ['id'=> $detail->id ]);
    }

    /**
     * 
     * @return \Illuminate\Contracts\View\Factory|
     * \Illuminate\Http\RedirectResponse|
     * \Illuminate\Routing\Redirector|
     * \Illuminate\View\View
     */
    public function tagCreate()
    {
        return view('archives.tags.createTag');
    }

    /**
     * 文档种类存储
     * @param Requests\TagRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function tagStore(Requests\TagRequest $request)
    {
        $tag = Tag::create($request->all());

        return redirect('/archives/lists');
    }

    /**
     *  处理用户点赞模块
     * @param $id
     * @return
     */
    public function thumbUp($id)
    {
        $detail = Detail::find($id);
        // 传递当前的点赞文章ID,
        Detail::thumbsHandler($detail);

        return redirect('/archives/lists');
    }

    /**
     * 使用关键字搜索用户或者文章内容
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        // 获取HTTP 请求参数
        $keyword = $request->input('q');
        // 模糊的文章数据
        $detailSearchRes = $this->detailRepository->withKeywordsInContent($keyword);
        // 模糊的用户数据
        $userSearchRes = $this->userRepository->withKeywordsInUserNickName($keyword);

        if(empty($detailSearchRes->all()) && empty($userSearchRes->all())){
            return view('archives.tags.sorry');
        }

        return view('archives.tags.search', compact('detailSearchRes','userSearchRes'));
    }

    /**
     *  依照文章分类显示
     * @param $describe
     * @return \Illuminate\View\View
     */
    public function category($describe)
    {
        $tags = Tag::all(['describe']);

        //$details = Detail::all(['title','content','id','author'])->orderBy('create_at','desc');
        $details = Detail::select(['id','title','author','thumbs_up','comment_int', 'updated_at'])
            ->where('note', $describe)->orderBy('created_at','desc')->paginate(6);

        return view('archives.tags.content', compact('tags','details'));
    }


    /**
     * 本人的文章编辑权限页
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $editData = $this->detailRepository->withIdRelatedAuthor($id);

        $authId = \Auth::user()->id;

        if($editData->user_id == $authId){
            $tags = Tag::all(['describe','notes']);
            return view('archives.tags.edit',compact('editData','tags'));
        };

        return view('archives.tags.permission');
    }

    /**
     * 更新文章内容信息；
     * @param Requests\BlogPostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateArticle(Requests\BlogPostRequest $request, $id)
    {
        $userData = [
            'user_id' => \Auth::user()->id,
            'author'  => \Auth::user()->nickname,
        ];

        $detail = Detail::find($id);

        $detail->title = $request->get('title');
        $detail->content = $request->get('content');
        $detail->note = $request->get('note');

        $detail->save();

        return redirect()->action('ArchivesController@show',
            ['id'=> $detail->id ]);
    }
}
