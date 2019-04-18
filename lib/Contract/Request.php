<?php
/**
 * User: mayunyun1@100tal.com
 * Date: 2019-04-17
 * Time: 11:45
 */

namespace SP\Contract;


interface Request
{
    static function buildFromGlobals();

    public function get($key, $default = null);

    public function query($key, $default = null);
    
    public function post($key, $default = null);

    public function json($key, $default = null);

    public function header($key, $default = null);

    public function cookie($key, $default = null);
}