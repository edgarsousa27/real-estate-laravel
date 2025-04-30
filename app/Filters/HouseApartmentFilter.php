<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class HouseApartmentFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property): void
    {
     $query->whereIn('category_id', [1,2]);   
    }
}