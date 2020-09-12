<?php

namespace App\QueryFilters;

trait Filterable
{
    public function scopeFilter($builder, $filters)
    {
        return $filters->apply($builder);
    }
}
