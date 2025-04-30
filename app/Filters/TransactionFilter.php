<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class TransactionFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property): void
    {
        if($value === 'buy'){
            $query->where('transaction_id', 1);
        }

        if($value === 'rent'){
            $query->where('transaction_id', 2);
        }
    }
}
