<?php

namespace Libs\Core;

class Controller
{
    /**
     * @var Middleware[]
     */
    private array $middlewares = [];

    /**
     * @param Middleware $middleware
     * @return void
     */
    public function registerMiddleware(Middleware $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * @return Middleware[]
     */
    public function middlewares(): array
    {
        return $this->middlewares;
    }
}
