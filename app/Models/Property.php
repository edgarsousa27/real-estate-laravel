<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'properties';

    protected $fillable = [
        'type',
        'sub_type',
        'title',
        'description',
        'status',
        'price',
        'square_meters',
        'year',
        'address',
        'city',
        'country',
        'bathrooms',
        'bedrooms',
        'kitchens',
        'garages',
        'parking_spaces',
        'floors',
        'image_path'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
