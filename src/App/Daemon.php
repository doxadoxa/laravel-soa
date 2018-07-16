<?php
declare(strict_types=1);

namespace Doxadoxa\Soa\App;

use Doxadoxa\Soa\Facades\Soa;
use Doxadoxa\Soa\Services\Subscribe\SubscribeManager;
use Illuminate\Support\Facades\Config;

class Daemon
{
    private const SECONDS_TO_MICROSECONDS_MULTIPLIER = 1000000;

    private static $instance;
    private $container;

    private function __construct()
    {
        //
    }

    public static function i():Daemon
    {
        if (!isset(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function run():void
    {
        $this->container = new Container();
        $this->container->singleton(SubscribeManager::class);

        /** @var SubscribeManager $subscribeManager */
        $subscribeManager = $this->container->make(SubscribeManager::class);
        $subscribeManager->loadMessages(Config::get('soa.routes_path'));

        $this->start();
    }

    public function container():Container
    {
        return $this->container;
    }

    protected function start()
    {
        while( true ) {
            Soa::consume();
            usleep(Config::get('soa.worker_sleep') * self::SECONDS_TO_MICROSECONDS_MULTIPLIER);
        }
    }
}
