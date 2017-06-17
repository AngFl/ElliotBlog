<?php

namespace App\Listeners;

use App\Event\UserThumbsUp;
use App\Services\ThumbsUpService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ThumbUpVerification
{
    protected $verifier;
    /**
     * Create the event listener.
     * @param ThumbsUpService $verifier
     */
    public function __construct(ThumbsUpService $verifier)
    {
        $this->verifier = $verifier;
    }

    /**
     * Handle the event.
     *
     * @param  UserThumbsUp  $event
     * @return void
     */
    public function handle(UserThumbsUp $event)
    {
        //  事件触发传递点赞记录模型
        // 如果id 传递的文章存在， 则检查点赞的用户，获取点赞的用户ID
        //$this->verifier->thumbsBehavior($event->user->id, $event->detail->id);
        \Log::info('handel - user_id: '.$event->user->id." , detail:".$event->detail->id);
        // 如果点赞记录中存在该次点赞用户ID, 则该次点赞失效，否则点赞记录插入，更新当文章点赞字段加1
        // （如果点赞记录中存在点赞用户的ID, 可以将此id 删除，减少1 文章点赞字段 ）
        $this->verifier->thumbsBehavior($event->user, $event->detail);
    }
}
