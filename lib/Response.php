<?php
/**
 * User: mayunyun1@100tal.com
 * Date: 2019-04-17
 * Time: 20:06
 */

namespace SP;
use \SP\Contract\Response as BaseResp;

class Response implements BaseResp
{
    protected $status = 200;
    protected $headers = [];
    protected $content = "";

    function getHeaders(): array
    {
        return $this->headers;
    }

    function getContent(): string
    {
        return $this->content;
    }

    function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    function setHeader(string $key, $value)
    {
        $this->headers[$key] = $value;
    }

    function setContent(string $content)
    {
        $this->content = $content;
    }

    function setStatus(int $status)
    {
        $this->status = $status;
    }

    function getStatus(): int
    {
        return $this->status;
    }
}