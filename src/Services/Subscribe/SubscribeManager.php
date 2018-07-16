<?php
declare(strict_types=1);

namespace Doxadoxa\Soa\Services\Subscribe;

use Doxadoxa\Soa\Exceptions\NotCallableHandleException;

class SubscribeManager
{
    /** @var array */
    protected $routes;

    public function __construct()
    {
        //
    }

    /**
     * @param string $object
     * @param string $event
     * @param \Closure $callable
     */
    public function register(string $object, string $event, \Closure $callable): void
    {
        $this->routes[$object . '.' . $event] = $callable;
    }

    /**
     * @param string $object
     * @param string $event
     * @return mixed
     * @throws NotCallableHandleException
     */
    public function resolve(string $object, string $event): void
    {
        $args = func_get_args();

        $routeHandler = $this->routes[$object . '.' . $event];
        $dataArgs = array_slice($args, 2);

        if( !isset($routeHandler) ) {
            return;
        }

        if( is_callable($routeHandler)) {
            call_user_func_array($routeHandler, $dataArgs);
        } else {
            throw new NotCallableHandleException();
        }
    }

    /**
     * @param string $path
     */
    public function loadMessages(string $path): void
    {
        require __DIR__ . $path;
    }
}
