<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class TypePropertyFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property): void
    {
        if($value == 'house'){
            $query->where('category_id', 1);
        } elseif($value == 'apartment'){
            $query->where('category_id', 2);
        } elseif($value == 'land'){
            $query->where('category_id', 3);
        } elseif($value == 'houses-apartments'){
            $query->whereIn('category_id', [1,2]);   
        }
    }
}
