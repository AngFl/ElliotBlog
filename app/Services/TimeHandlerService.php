<?php
/**
 *
 */

namespace App\Services;

use Carbon\Carbon;

class TimeHandlerService
{
    /**
     * @param $diffObject
     * 返回一种时间间隔描述语句
     * @return string
     */
    protected static function timeStatement($diffObject)
    {
        //时间间隔描述， 由低等级向高
        if($diffObject instanceof \DateInterval){
            if($diffObject->y > 0){
                return $diffObject->y . " 年前";
            }

            if($diffObject->m > 0){
               return $diffObject->m . " 个月前";
            }

            if($diffObject->d >= 7 && $diffObject->d <= 30){
                $index = floor($diffObject->d / 7);
                return $index . " 周前";
            }

            if($diffObject->d > 0 && $diffObject->d < 7){

                return $diffObject->d . " 天前";
            }


            if($diffObject->h > 0 && $diffObject->h < 24){
                return $diffObject->h ." 小时前";
            }

            if($diffObject->i > 0 && $diffObject->i < 60){
                return $diffObject->i . "分钟前";
            }

            return "刚刚";
        }
    }
    //首先获取事件字符 datetime ， 作为 时间操作类构造初始化的部分。
     // 使用当前时间对象， 可将要操作的时间对象对比成为时间操作单元。

    /**
     * @param $opTime
     * @return string
     */
    public static function timeInterval($opTime)
    {
        $currentTime = Carbon::now();
        $timeItem = new Carbon($opTime);

        $diffObject = $timeItem->diff($currentTime);
        $description = self::timeStatement($diffObject);

        return $description;
    }
}

