<?php
declare(strict_types=1);

namespace Doxadoxa\Soa\Services\Consumer;

use Doxadoxa\Soa\App\Daemon;
use Doxadoxa\Soa\Services\Message;
use Doxadoxa\Soa\Services\Subscribe\SubscribeManager;
use Illuminate\Support\Facades\Config;
use Bschmitt\Amqp\Facades\Amqp;
use Bschmitt\Amqp\Consumer as AmqpConsumer;
use Illuminate\Support\Facades\Log;
use PhpAmqpLib\Message\AMQPMessage;

class Consumer
{
    public function consume(): void
    {
        try {
            Amqp::consume(Config::get('soa.base_queue_label'), function (AMQPMessage $message, AmqpConsumer $resolver) {
                $this->execute(Message::make($message->body));
                $resolver->acknowledge($message);
                $resolver->stopWhenProcessed();
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
        }
    }

    /**
     * @param Message $message
     * @throws \Doxadoxa\Soa\Exceptions\NotCallableHandleException
     */
    private function execute(Message $message) : void
    {
        /**
         * @var SubscribeManager $sm
         */
        $sm = Daemon::i()->container()->make(SubscribeManager::class);
        $sm->resolve($message->object(), $message->action(), $message->data());
    }
}
