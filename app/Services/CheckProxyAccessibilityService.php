<?php

namespace App\Services;

use App\Models\Proxy;
use Graze\TelnetClient\Exception\TelnetException;
use Graze\TelnetClient\TelnetClient;
use Graze\TelnetClient\TelnetClientInterface;
use Illuminate\Support\Facades\Log;

class CheckProxyAccessibilityService
{
    private TelnetClientInterface $telnetClient;

    public function __construct()
    {
        $this->telnetClient = TelnetClient::factory();
    }

    public function isAccessible(Proxy $proxy): bool
    {
        try {
            $this->telnetClient->connect($proxy->address);
            return true;
        } catch (TelnetException $exception) {
            Log::debug($exception->getMessage());
            return false;
        }
    }
}
