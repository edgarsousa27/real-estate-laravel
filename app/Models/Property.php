<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Property extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'properties';

    protected $fillable = [
        'category_id',
        'transaction_id',
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
    ];

    public function registerMediaCollections(): void
    {
        $this
        ->addMediaCollection('images')
        ->useDisk('public');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
