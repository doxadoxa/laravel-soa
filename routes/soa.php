<?php

use Doxadoxa\Soa\Services\Soa;
use Doxadoxa\Soa\Services\SoaObject;
use Doxadoxa\Soa\Handlers\ExampleHandler;

Soa::object('example', function(SoaObject $object) {
    $object->on('updated', [ExampleHandler::class, 'updated']);
});