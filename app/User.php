<?php

namespace App;

use App\Event\UserRegistered;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Comment;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nickname',
        'email',
        'password',
        'description',
        'avatar',
        'confirm_code',
        'oauth_name',
        'oauth_id',
        'oauth_access_token',
        'oauth_expires',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 加密密码的方式
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = \Hash::make($password);
    }

    /**
     * @param string $size
     * @return string
     */
    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));

        return "http://www.gravatar.com/avatar/{$hash}?s={$size}";
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detail()
    {
        return $this->hasMany('App\Detail');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function thumbs()
    {
        return $this->hasMany('App\ThumbRecord');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id','id');
    }

    /**
     *  用户注册服务
     * @param array $data
     * @return static
     */
    public static function register(array $data)
    {
        $user = static::create($data);

        if($user->id){
            // 触发用户注册事件
            event(new UserRegistered($user));

            \Session::set('user_email',$data['email']);
            return $user;
        }else{
            \Log::error('user-email:'.$data['email'].'register failed');
        }
    }
}
