<?php
declare(strict_types=1);

namespace Doxadoxa\Soa\Services;

use Doxadoxa\Soa\Services\Sender\Sender;
use Doxadoxa\Soa\Services\Consumer\Consumer;

class Handler
{
    private $sender;
    private $consumer;

    public function __construct()
    {
        $this->sender = new Sender();
        $this->consumer = new Consumer();
    }

    public function send(Message $message): void
    {
        $this->sender->send($message);
    }

    public function consume(): void
    {
        $this->consumer->consume();
    }
}
