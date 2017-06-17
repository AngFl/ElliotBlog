<?php
/**
 *
 */

namespace App\Extensions;

use Illuminate\Support\Facades\Redis;

/**
 * 使用 Redis 管理Session 数据
 * Class RedisSessionHandler
 * @package App\Extensions
 */
class RedisSessionHandler implements \SessionHandlerInterface
{
    protected $redis;

    /**
     * RedisSessionHandler constructor.
     * @param $redis
     */
    public function __construct()
    {
        $this->redis = Redis::connection('session');
        var_dump(__CLASS__);
    }

    public function close()
    {
        return $this->redis->close();
    }

    public function destroy($session_id)
    {
        return $this->redis->del($session_id);
    }

    public function gc($maxlifetime)
    {
        return $this->redis->flushAll();
    }

    /**
     * 默认情况下 Laravel 对Session 操作如果不是文件存储的话，
     * 不会调用该方法
     * @param string $save_path
     * @param string $name
     * @return null
     */
    public function open($save_path, $name)
    {
        // TODO: Implement open() method.
        return null;
    }

    public function read($session_id)
    {
        return $this->redis->get($session_id);
    }

    public function write($session_id, $session_data)
    {
        return $this->redis->set($session_id, $session_data);
    }
}