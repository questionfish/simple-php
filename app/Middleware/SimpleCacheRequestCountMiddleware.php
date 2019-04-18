<?php
/**
 * User: mayunyun1@100tal.com
 * Date: 2019-04-18
 * Time: 09:07
 */

namespace App\Middleware;

use SP\Contract\Cache;
use SP\Contract\Request;
use SP\Contract\Response;

class SimpleCacheRequestCountMiddleware
{
    public function handler(Request $request)
    {
        $key = 'sp-request-count';
        $count = $this->cache()->incr($key);
        echo 'Request count: ', $count, '<br>';
    }

    public function terminate()
    {
        $this->cache()->close();
    }

    protected function cache(): Cache
    {
        $cache = app(Cache::class);
        return $cache;
    }
}