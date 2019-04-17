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

function starts_with($string, $needle){
    return substr($string, 0, strlen($needle)) === $needle;
}

function ends_with($string, $needle){
    return substr($string, 0 - strlen($needle)) === $needle;
}

function trim_str($string, $toTrim){
    if(!starts_with($string, $toTrim)){
        return $string;
    }
    return substr($string, strlen($toTrim));
}