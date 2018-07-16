<?php declare(strict_types=1);

namespace Doxadoxa\Soa\Services\Sender;

use Bschmitt\Amqp\Facades\Amqp;
use Doxadoxa\Soa\Services\Message;


class Sender
{
    public function send(Message $message)
    {
        Amqp::publish('', $message->toJson(), ['queue' => config('amqp.base_queue')]);
    }
}