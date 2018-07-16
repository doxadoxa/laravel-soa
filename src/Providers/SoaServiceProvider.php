<?php declare(strict_types=1);

namespace Doxadoxa\Soa\Providers;

use Doxadoxa\Soa\Commands\SoaWorker;
use Doxadoxa\Soa\Services\Handler;
use Illuminate\Support\ServiceProvider;

class SoaServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                SoaWorker::class,
            ]);
        }

        $this->mergeConfigFrom(
            __DIR__.'/config/soa.php', 'soa'
        );

        $this->app->bind('soaHandler', Handler::class);

        if (!class_exists('SOAHandler')) {
            class_alias(Handler::class, 'SOAHandler');
        }
    }

    public function register()
    {
        //
    }

    public function provides()
    {
        return ['SOAHandler'];
    }
}
