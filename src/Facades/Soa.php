<?php
declare(strict_types=1);

namespace Doxadoxa\Soa\Facades;

use Illuminate\Support\Facades\Facade;
use Doxadoxa\Soa\Services\Message;

/**
 * Class Soa
 * @package Doxadoxa\Soa\Facades
 *
 * @method static consume() Use for handling new message from AMQP
 * @method static send(Message $message) Use for send new message to AMQP
 */
class Soa extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'soaHandler';
    }
}
