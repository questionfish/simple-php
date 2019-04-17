<?php
/**
 * User: mayunyun1@100tal.com
 * Date: 2019-04-18
 * Time: 01:36
 */
namespace App;

use \SP\Contract\Request;

class HelloController
{
    public function hello(Request $request)
    {
        return "hello";
    }
}