<?php
use \SP\Container;

if(!function_exists('app'))
{
    function app(string $abstract = null, array $params = []){
        if(!isset($abstract)){
            return Container::getInstance();
        }
        return Container::getInstance()->make($abstract, $params);
    }
}

if(!function_exists('starts_with')) {
    function starts_with($string, $needle)
    {
        return substr($string, 0, strlen($needle)) === $needle;
    }
}

if(!function_exists('ends_with')) {
    function ends_with($string, $needle)
    {
        return substr($string, 0 - strlen($needle)) === $needle;
    }
}

if(!function_exists('ltrim_str')) {
    function ltrim_str($string, $toTrim)
    {
        if (!starts_with($string, $toTrim)) {
            return $string;
        }
        return substr($string, strlen($toTrim));
    }
}


define('__ROOT__', dirname(__DIR__));
define('__CONFIG_DIR__', __ROOT__ . DIRECTORY_SEPARATOR . 'config');

if(!function_exists('config'))
{
    function config($key){
        if(empty($key)){
            return null;
        }
        $pieces = explode('.', $key);

        $nowRoot = config_path();
        $filepath = null;
        $configure = null;
        foreach ($pieces as $piece){
            $tmp = $nowRoot . DIRECTORY_SEPARATOR . $piece;
            if(is_dir($tmp)){
                $nowRoot = $tmp;
                continue;
            }
            if(file_exists($tmp . '.php')){
                $filepath = $tmp . '.php';
                $configure = include $filepath;
                continue;
            }
            if(isset($filepath) && isset($configure)){
                if(isset($configure[$piece])){
                    $configure = $configure[$piece];
                    continue;
                } else {
                    return null;
                }
            }
            return null;
        }
        return $configure;
    }
}

if(!function_exists('config_path'))
{
    function config_path(){
        return __CONFIG_DIR__;
    }
}