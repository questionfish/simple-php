<?php
/**
 * User: mayunyun1@100tal.com
 * Date: 2019-04-17
 * Time: 11:38
 */

namespace SP\Contract;

interface Cache
{
    public function get(string $key): string;
    public function set(string $key, string $val, int $ttlInSec = null);
    public function incr(string $key, int $ttlInSec = null): int;
    public function close();
}