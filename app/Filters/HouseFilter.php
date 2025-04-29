<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class HouseFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property): void
    {
        $query->where('type', 'Casa');
    }
}
