<?php
/**
 * User: mayunyun1@100tal.com
 * Date: 2019-04-18
 * Time: 01:42
 */

namespace SP;
use App\HelloController;
use SP\Contract\Request;
use SP\Contract\Route as BaseRoute;

class Route implements BaseRoute
{
    public function any($url, $function)
    {
        // TODO: Implement any() method.
    }

    public function dispatch(Request $request)
    {
        return [HelloController::class, 'hello'];
    }
}