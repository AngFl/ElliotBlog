<?php
/**
 *
 */

namespace App\Repositories;


use App\User;

class UserRepository
{
    public $user;

    /**
     * UserRepository constructor.
     * @param $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     *  根绝用户的昵称模糊查询
     * @param $keyword
     * @return mixed
     */
    public function withKeywordsInUserNickName($keyword)
    {
        return $this->user
            ->select(['nickname'])
            ->where('nickname','like','%'.$keyword.'%')
            ->paginate(6);
    }

    /**
     * @param $email
     * @return mixed
     */
    public function withUserEmailFetchID($email)
    {
        return $this->user->where('email',$email)->first(['id']);
    }
}