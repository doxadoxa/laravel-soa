<?php declare(strict_types=1);

namespace Doxadoxa\Soa\App;

class Container
{
    private $container;

    public function singleton(string $className):void
    {
        if ( !isset($this->container[$className]) ) {
            $this->container[$className] = $className;
        }
    }

    public function make(string $className):object {
        if ( is_string($this->container[$className]) ) {
            $this->container[$className] = new $className;
        }

        if ( is_object($this->container[$className])) {
            return $this->container[$className];
        } else {
            throw new \RuntimeException("Element of service container not object.");
        }
    }
}
