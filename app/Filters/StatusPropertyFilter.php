<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class StatusPropertyFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property): void
    {
        if($value === 'active'){
            $query->where('status', '=', 'active');
        } elseif($value === 'pending'){
            $query->where('status', '=', 'pending');
        } elseif($value === 'sold'){
            $query->where('status', '=', 'sold');
        } elseif($value === 'rented'){
            $query->where('status', '=', 'rented');
        }
    }
}
