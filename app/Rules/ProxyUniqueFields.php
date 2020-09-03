<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ProxyUniqueFields implements Rule
{
    private string $port;

    public function __construct(string $port)
    {
        $this->port = $port;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $count = \DB::table('proxies')
            ->where('ip', $value)
            ->where('port', $this->port)
            ->count();

        return 0 === $count;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ip and port combination already exists.';
    }
}
