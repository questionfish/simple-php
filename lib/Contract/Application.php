<?php
/**
 * User: mayunyun1@100tal.com
 * Date: 2019-04-17
 * Time: 11:34
 */

namespace SP\Contract;

interface Application
{
    public function run();

    public function request(): Request;

    public function route(): Route;

    public function send(Response $response);
}