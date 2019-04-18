<?php
/**
 * User: mayunyun1@100tal.com
 * Date: 2019-04-17
 * Time: 20:05
 */

namespace SP;
use \SP\Contract\Request as BaseReq;

class Request implements BaseReq
{
    public $query;
    public $post;
    public $json;
    public $header;

    static function buildFromGlobals()
    {
        $req = new Request();
        foreach ($_GET as $key => $value){
            $req->query[$key] = $value;
        }
        foreach ($_POST as $key => $value){
            $req->post[$key] = $value;
        }
        foreach ($_SERVER as $key => $value){
            if(starts_with($key, "HTTP_")){
                $req->header[strtolower(ltrim_str($key, "HTTP_"))] = $value;
            }
        }
        return $req;
    }

    public function get($key, $default = null)
    {
        return $this->query($key, $this->post($key, $this->json($key, $default)));
    }

    public function query($key, $default = null)
    {
        return isset($this->query[$key]) ? $this->query[$key] : $default;
    }

    public function setQuery($key, $value)
    {
        $this->query[$key] = $value;
    }

    public function post($key, $default = null)
    {
        return isset($this->post[$key]) ? $this->post[$key] : $default;
    }

    public function json($key, $default = null)
    {
        return isset($this->json[$key]) ? $this->json[$key] : $default;
    }

    public function header($key, $default = null)
    {
        return isset($this->header[$key]) ? $this->header[$key] : $default;
    }

    public function cookie($key, $default = null)
    {
        return isset($this->header['cookie'][$key]) ? $this->header['cookie'][$key] : $default;
    }


}