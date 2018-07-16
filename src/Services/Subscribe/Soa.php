<?php
declare(strict_types=1);

namespace Doxadoxa\Soa\Services\Subscribe;

class Soa
{
    public static function object(string $objectLabel, \Closure $callable)
    {
        $object = new SoaObject($objectLabel);
        $callable($object);
    }
}
