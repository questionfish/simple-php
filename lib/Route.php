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

    private function mapping(Request $request)
    {
        $route = config("route")[$request->url()] ?? null;

        if (!$route) {
            $resp = $this->resp();
            $resp->setStatus(404);
            $resp->setContent("404 Not Found");
            return $resp;
        }

        if ($route["method"] != strtolower($request->method())){
            $resp = $this->resp();
            $resp->setStatus(405);
            $resp->setContent("405 Method Not Allowed");
            return $resp;
        }
        return [$route["controller"],$route["action"]];
    }

    public function resp(): \SP\Contract\Response
    {
        return app(Response::class);
    }
}