<?php

namespace Libs\Core;

use DI\Container;
use Exception;
use Libs\Core\Database\Orm\Doctrine\Builder as Doctrine;

final class Application
{
    /**
     * @var \Libs\Core\Application
     */
    public static Application $app;

    /**
     * @var \Libs\Core\Router
     */
    public Router $router;

    /**
     * @var \Libs\Core\Contracts\IDatabase
     */
    public $database;

    public Container $container;

    public function __construct(array $config)
    {
        self::$app = $this;
        $this->container = new Container();
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router(new Request(), new Response());
        $this->database = (new Doctrine($config));
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (Exception $e) {
            echo $this->router->response->json($e->getTrace());
        }
    }   

    public function bind(string $class, string $dependency)
    {
        $this->container->set($class, \DI\create($dependency));
    }
}
