<?php
declare(strict_types=1);

namespace Doxadoxa\Soa\Commands;

use Doxadoxa\Soa\App\Daemon;
use Illuminate\Console\Command;

class SoaWorker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'soa-daemon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starts a SOA worker for handling events.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info("SOA handle started..");

        Daemon::i()->run();

        $this->info("SOA handle ended..");
    }
}
