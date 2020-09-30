<?php

namespace App\Console\Commands;

use App\Models\Proxy;
use App\Services\CheckProxyAccessibilityService;
use Illuminate\Console\Command;

class CheckActiveProxyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'proxy:check-accessibility';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check proxy on accessibility!';

    /**
     * @var CheckProxyAccessibilityService
     */
    private CheckProxyAccessibilityService $proxyAccessibilityService;

    /**
     * Create a new command instance.
     *
     * @param CheckProxyAccessibilityService $proxyAccessibilityService
     */
    public function __construct(CheckProxyAccessibilityService $proxyAccessibilityService)
    {
        parent::__construct();
        $this->proxyAccessibilityService = $proxyAccessibilityService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Checking proxy accessibility started!');
        $proxies = Proxy::all();
        $bar = $this->output->createProgressBar(count($proxies));

        $bar->start();

        foreach ($proxies as $proxy) {
            $proxy->active = $this->proxyAccessibilityService->isAccessible($proxy);
            $proxy->save();
            $bar->advance();
        }

        $bar->finish();
        $this->info('Checking proxy accessibility finished!');
        return 0;
    }
}
