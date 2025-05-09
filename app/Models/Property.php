<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Property extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Searchable;

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
        'district',
        'country',
        'bathrooms',
        'bedrooms',
        'kitchens',
        'garages',
        'parking_spaces',
        'floors',
        'postal_code'
    ];

        /**
     * Get the name of the index associated with the model.
     */
    public function searchableAs(): string
    {
        return 'properties_index';
    }

        /**
     * Get the indexable data array for the model.
     *
     */
    public function toSearchableArray(): array
    {
        
        $array['images'] = $this->getMedia('images')->map(function($media) {
            return [
                'url' => $media->getUrl(),
                'name' => $media->name
            ];
        })->toArray();

        $search = [
            'district' => $this->district,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'transaction_id' => (int)$this->transaction_id
        ];
 
        return array_merge($array, $search);
    }

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
