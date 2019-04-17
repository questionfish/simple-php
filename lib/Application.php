<?php
/**
 * User: mayunyun1@100tal.com
 * Date: 2019-04-17
 * Time: 11:52
 */

namespace SP;
use \SP\Contract\Application as BaseApp;
use \SP\Contract\Request;
use \SP\Contract\Response;
use SP\Contract\Route;
use SP\Contract\Middleware;

class Application implements BaseApp
{
    /**
     * @var string
     */
    protected $basePath;

    protected $middleware = [];


    public function __construct($basePath = null)
    {
        if($basePath){
            $this->setBasePath($basePath);
        }
    }

    /**
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * @param string $basePath
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
    }

    public function request(): Request
    {
        return app(Request::class)->buildFromGlobals();
    }

    public function response(): Response
    {
        return app(Response::class);
    }

    public function route(): Route
    {
        return app(Route::class);
    }

    public function send(Response $response)
    {
        http_response_code($response->getStatus());
        foreach ($response->getHeaders() as $key => $header){
            if($key === 'cookie'){
                header($key, http_build_cookie($header));
            }
            header($key, $header);
        }
        echo $response->getContent();
    }


    public function pushMiddleware($middlewareName){
        assert((is_string($middlewareName) && (class_exists($middlewareName) || interface_exists($middlewareName))) || is_callable($middlewareName));

        if(array_search($middlewareName, $this->middleware) === false) {
            $this->middleware[] = $middlewareName;
        }
        return $this;
    }

    public function terminateMiddleware(Request $request, Response &$response)
    {
        foreach ($this->middleware as $middlewareName){
            if(!is_string($middlewareName)){
                continue;
            }
            $middleware = $this->make($middlewareName);
            if(method_exists($middleware, 'terminate')){
                $middleware->terminate($request, $response);
            }
        }
    }

    public function run()
    {
        $req = $this->request();
        $call = $this->route()->dispatch($req);
        $this->pushMiddleware(new class($call){
            public function __construct($call)
            {
                $this->call = $call;
            }
            public function __invoke(Request $request)
            {
                $method = $this->call[1];
                return app($this->call[0])->$method($request);
            }
        });
        $resp = null;
        foreach ($this->middleware as $middlewareName){
            if(is_callable($middlewareName)){
                $middleware = $middlewareName;
            } else {
                $middleware = [$this->make($middlewareName), 'handler'];
            }
            $res = call_user_func($middleware, $req);
            if($res instanceof Response){
                $resp = $res;
                break;
            } elseif(is_string($res)){
                $resp = new \SP\Response();
                $resp->setContent($res);
            }
        };

        if(!isset($resp)){
            $resp = new \SP\Response();
            $resp->setContent('Hello world!');
        }
        $this->terminateMiddleware($req, $resp);
        $this->send($resp);
        return true;
    }
}