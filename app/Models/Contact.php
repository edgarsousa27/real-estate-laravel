<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = [
        'property_id',
        'name',
        'lastname',
        'email',
        'phone_number',
        'message'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
