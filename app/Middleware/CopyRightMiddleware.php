<?php
/**
 * User: mayunyun1@100tal.com
 * Date: 2019-04-18
 * Time: 09:07
 */

namespace App\Middleware;

use SP\Contract\Request;
use SP\Contract\Response;

class CopyRightMiddleware
{
    public function handler(Request $request){
        echo "get(a) => ", json_encode($request->get('a')), "<br>";
    }

    public function terminate(Request $request, Response &$response){
        $response->setContent($response->getContent() . "<br>Copyright &copy questionfish.");
    }
}