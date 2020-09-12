<?php

namespace App\QueryFilters;

class ProxyFilter extends BaseQueryFilter
{
    public function type(string $value): void
    {
        $this->builder->where('type', $value);
    }

    public function ip(string $value): void
    {
        $this->builder->where('ip', $value);
    }

    public function port(string $value): void
    {
        $this->builder->where('port', $value);
    }
}
