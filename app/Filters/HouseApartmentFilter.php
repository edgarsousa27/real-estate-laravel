<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class HouseApartmentFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property): void
    {
        $query->where(function($q){
            $q->where('category_id', 1)->orWhere('category_id', 2);
        })->where('transaction_id', 1);
    }
}
