<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class ApartmentFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property): void
    {
        $query->where('category_id', 2);
    }
}
