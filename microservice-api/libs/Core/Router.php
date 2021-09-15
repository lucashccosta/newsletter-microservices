<?php

namespace Libs\Core;

use Libs\Core\Exceptions\NotFoundException;

class Router
{
    /**
     * @var Libs\Core\Request
     */
    public Request $request;

    /**
     * @var Libs\Core\Response
     */
    public Response $response;

    /**
     * @var array
     */
    private array $routeMap = [];

    public function __construct(
        Request $request,
        Response $response
    ) {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @param string $url
     * @param array $callback
     * @return void
     */
    public function get(
        string $url, 
        array $callback
    ): void {
        $this->routeMap['get'][$url] = $callback;
    }

    /**
     * @param string $url
     * @param array $callback
     * @return void
     */
    public function post(
        string $url, 
        array $callback
    ): void {
        $this->routeMap['post'][$url] = $callback;
    }

    public function resolve()   
    {
        $method = $this->request->method();
        $url = $this->request->url();
        $callback = $this->routeMap[$method][$url] ?? false;
        if (!$callback) throw new NotFoundException();
        if (is_array($callback)) {
            $controller = Application::$app->container->make($callback[0]);
            $middlewares = $controller->middlewares();
            foreach ($middlewares as $middleware) $middleware->execute();
            $callback[0] = $controller;
        }

        return call_user_func(
            $callback, 
            $this->request, 
            $this->response
        );
    }
}   
