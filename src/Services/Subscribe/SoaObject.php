<?php
declare(strict_types=1);

namespace Doxadoxa\Soa\Services\Subscribe;

use Doxadoxa\Soa\App\Daemon;

class SoaObject
{
    private $object;

    /**
     * RouteGroup constructor.
     * @param string $object
     */
    public function __construct(string $object)
    {
        $this->object = $object;
    }

    public function object()
    {
        return $this->object;
    }

    public function on(string $event, $callable)
    {
        if ( is_callable($callable) ) {
            $router = Daemon::i()->container()->make(SubscribeManager::class);
            $router->register($this->object, $event, $callable);
        }
    }
}
