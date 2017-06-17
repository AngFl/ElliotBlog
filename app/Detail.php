<?php

namespace App;

use App\Event\UserThumbsUp;
use Illuminate\Database\Eloquent\Model;
use App\Comment;

class Detail extends Model
{
    //
    protected $fillable = ['title', 'content','user_id','note','author'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public static function thumbsHandler($detail)
    {
        $user = User::where('email',\Session::get('user_email'))->first();

        \Log::info('thumbs_up:user:'.$user->id.':email:'.$user->email);
        \Log::info('thumbs_up:detail_id:'.$detail->id.':user_id:'.$user->id);
        // 由当前文章的点赞的ID， 获取点赞的用户ID, 传递点赞事件
        event(new UserThumbsUp($user, $detail));
        // 如果点赞记录中存在该次点赞用户ID, 则该次点赞失效，否则点赞记录插入，更新当文章点赞字段加1
        // （如果点赞记录中存在点赞用户的ID, 可以将此id 删除，减少1 文章点赞字段 ）
        return $user;
    }
}
