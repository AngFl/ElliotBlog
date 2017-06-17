<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Markdown\Markdown;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class CommentsController extends Controller
{
    /**
     * 使用MarkDown Parser 格式文本数据
     * @var Markdown
     */
    protected $markdownParser;

    /**
     * CommentsController constructor.
     * @param Markdown $markdownParser
     */
    public function __construct(Markdown $markdownParser)
    {
        $this->markdownParser = $markdownParser;
    }


    /**
     * 接受用户评论的方法
     * @param Requests\CommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Requests\CommentRequest $request)
    {
        $commentMarkdown = $this->markdownParser->markdown($request->input('body'));

        $data = [
            'body'      => htmlspecialchars($request->input('body')),
            //'body'      => $commentMarkdown,
            'user_id'   => \Auth::user()->id,
            'detail_id' => $request->input('detail_id')
        ];

        $newComment = $this->CollaborateData($data);

        // 存储评论信息返回JSON
        $nickname  = \Auth::user()->nickname;

        $dateTime = Carbon::now();

        return \Response::json([
            'avatar'     => $newComment->user->avatar,
            'nickname'   => $nickname,
            'body'       => $commentMarkdown,
            'created_at' => $dateTime->format('Y-m-d H:i:s')
        ]);
    }

    /**
     *  关联的用户的数据
     * @param $data
     * @return mixed
     */
    protected function CollaborateData($data)
    {
        // 接受用户的评论信息
        $newComment = Comment::create($data);

        // 修改对应文章的评论数
        $detail = $newComment->detail;
        $detail->comment_int = $detail->comment_int + 1;

        $flag = $detail->save();
        if (!$flag) {
            \Log::alert('Comment Model Save Failed:' . $detail->id .
                ":comment: " . $data['body'] . " |user: " . $data['user_id']);
        }
        return $newComment;
    }
}
