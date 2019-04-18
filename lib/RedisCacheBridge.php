<?php
/**
 * User: mayunyun1@100tal.com
 * Date: 2019-04-18
 * Time: 09:28
 */

namespace SP;

use SP\Contract\Cache;

class RedisCacheBridge implements Cache
{
    private $cache;

    public function __construct()
    {
        $this->cache = new RedisCache('127.0.0.1', 6379);
    }

    public function get(string $key): string
    {
        return $this->cache->get($key);
    }

    public function set(string $key, string $val, int $ttlInSec = null)
    {
        return $this->cache->set($key, $val, $ttlInSec);
    }

    public function incr(string $key, int $ttlInSec = null): int
    {
        $res = $this->cache->incr($key, $ttlInSec);
        return $res;
    }

    public function close()
    {
        $this->cache->close();
    }

    public function __destruct()
    {
        $this->close();
    }
}