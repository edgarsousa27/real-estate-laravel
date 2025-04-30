<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    protected $table = 'properties_transaction';

    protected $fillable = [
        'type'
    ];

    public function property(): HasOne
    {
        return $this->hasOne(Property::class);
    }
}
