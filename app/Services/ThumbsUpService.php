<?php
/**
 *
 */

namespace App\Services;

use App\Detail;
use App\ThumbRecord;

class ThumbsUpService
{
    protected $thumbsRecord;

    protected $detail;

    /**
     * ThumbsUpService constructor.
     * @param ThumbRecord $thumbsRecord
     * @param Detail $detail
     */
    public function __construct(ThumbRecord $thumbsRecord, Detail $detail)
    {
        $this->thumbsRecord = $thumbsRecord;
        $this->detail = $detail;
    }

    /**
     * 获取条件筛选的点赞记录
     * @param $user_id
     * @param $detail_id
     * @return mixed
     */
    protected function thumbsCorrelation($user_id, $detail_id)
    {
        return $this->thumbsRecord
            ->where('user_id',$user_id)
            ->where('detail_id',$detail_id)
            ->get(['id','user_id'])->count();
    }

    /**
     *  点赞行为驱动，点赞总点赞总记录，和文章点赞记录 发生变化
     * @param $user
     * @param $detail
     * @return mixed
     */
    public function thumbsBehavior($user, $detail)
    {
        // 条件筛选
        if(0 == $this->thumbsCorrelation($user->id, $detail->id)){
            return $this->thumbsIncrease($user->id, $detail->id);
        }
        // 条件筛选空，重复点赞
        return $this->thumbsDecrease($user->id, $detail->id);
    }

    /**
     *  增加点赞次数
     * @param $user_id
     * @param $detail_id
     * @return mixed
     */
    protected function thumbsIncrease($user_id, $detail_id)
    {
        $data = [
            'user_id'  => $user_id,
            'detail_id'=> $detail_id,
        ];

        \Log::info('create -data .'.json_encode($data));

        $this->thumbsRecord->create($data);

        // 文章点赞记录加 1
        $detail = $this->detail->find($detail_id);
        $detail->thumbs_up = $detail->thumbs_up + 1;

        \Log::info('thumbs_up up:'.$detail->thumbs_up.'| detail:id'.$detail_id);

        $detail->save();
    }

    /**
     *  减少点赞次数
     * @param $user_id
     * @param $detail_id
     * @return mixed
     */
    protected function thumbsDecrease($user_id, $detail_id)
    {
        // 重复点赞记录删除
        $deleteRow = $this->thumbsRecord
            ->where('user_id',$user_id)->where('detail_id',$detail_id)->delete();

        // 文章点赞记录减 1
        $detail = $this->detail->find($detail_id);
        $detail->thumbs_up = $detail->thumbs_up -1 ;

        \Log::info('thumbs_up down:'.$detail->thumbs_up.'| detail:id'.$detail_id);

        $detail->save();
    }

}