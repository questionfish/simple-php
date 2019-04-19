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
        $sql = "select * from xes_opc_growth_reg_infos limit 1";
        // $sql = "update xes_opc_growth_reg_infos set source_type=2 where id = 5106";
        $ret = DataBase::GetInstance()->execute($sql);
        var_dump($ret);exit;
        return "hello";
    }
}