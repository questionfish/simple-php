<?php
/**
 * User: mayunyun1@100tal.com
 * Date: 2019-04-18
 * Time: 01:36
 */
namespace App\Http;

use \SP\Contract\Request;
use SP\DataBase;

class HelloController
{
    public function hello(Request $request)
    {
        DataBase::GetInstance()->execute("");
        return "hello";
    }
}