<?php
/**
 * User: mayunyun1@100tal.com
 * Date: 2019-04-18
 * Time: 01:42
 */

namespace SP;
use \App\Http\HelloController;
use SP\Contract\Request;
use SP\Contract\Route as BaseRoute;

class Route implements BaseRoute
{
    public function dispatch(Request $request)
    {
        return $this->mapping($request);
    }
    
    /**
     *
     * @param Request $request
     * @return void
     */
    private function mapping(Request $request)
    {
        $route = config("route.".$request->url());

        if (!$route) {
            $resp = app(Response::class);
            $resp->setStatus(404);
            $resp->setContent("404");
            return $resp;
        }

        if ($route["method"] != strtolower($request->method())){
            //403
            $resp = app(Response::class);
            $resp->setStatus(403);
            $resp->setContent("403");
            return $resp;
        }
        return [$route["controller"],$route["action"]];
    }
}