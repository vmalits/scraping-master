<?php

namespace App\Jobs;

use App\Models\Proxy;
use App\Services\CheckProxyAccessibilityService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckProxy implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Proxy
     */
    private Proxy $proxy;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Proxy $proxy)
    {
        $this->proxy = $proxy;
    }

    /**
     * Execute the job.
     *
     * @param CheckProxyAccessibilityService $proxyAccessibilityService
     * @return void
     */
    public function handle(CheckProxyAccessibilityService $proxyAccessibilityService): void
    {
        $this->proxy->active = $proxyAccessibilityService->isAccessible($this->proxy);
        $this->proxy->save();
    }
}
