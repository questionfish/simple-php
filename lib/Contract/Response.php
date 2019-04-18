<?php
/**
 * User: mayunyun1@100tal.com
 * Date: 2019-04-17
 * Time: 11:45
 */

namespace SP\Contract;


interface Response
{
    function getHeaders(): array;

    function getContent(): string;

    function setHeaders(array $headers);

    function setHeader(string $key, $value);

    function setContent(string $content);

    function setStatus(int $status);

    function getStatus(): int;
}