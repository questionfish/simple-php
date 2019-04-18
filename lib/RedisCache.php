<?php
/**
 * User: mayunyun1@100tal.com
 * Date: 2019-04-18
 * Time: 09:22
 */

namespace SP;


use SP\Contract\Cache;

class RedisCache implements Cache
{
    /**
     * @var \Redis
     */
    protected $redis;

    public function __construct($host, $port)
    {
        $this->redis = new \Redis();
        $this->redis->connect($host, $port);
    }

    public function get(string $key): string
    {
        return $this->redis->get($key);
    }

    public function set(string $key, string $val, int $ttlInSec = null)
    {
        return $this->redis->set($key, $val, $ttlInSec);
    }

    public function incr(string $key, int $ttlInSec = null): int
    {
        $res = $this->redis->incr($key);
        if(isset($ttlInSec)) {
            $this->redis->expire($key, $ttlInSec);
        }
        return $res;
    }

    public function close()
    {
        if(isset($this->redis)) {
            $this->redis->close();
            $this->redis = null;
        }
    }
}