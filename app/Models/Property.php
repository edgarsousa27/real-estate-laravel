<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Property extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Searchable, HasSlug;

    protected $table = 'properties';

    protected $fillable = [
        'category_id',
        'transaction_id',
        'description',
        'price',
        'square_meters',
        'address',
        'city',
        'district',
        'country',
        'bathrooms',
        'bedrooms',
        'kitchen',
        'garage',
        'parking_spaces',
        'postal_code',
        'title',

        'heating',
        'cooling',
        'kitchen_equipped',
        'double_glazing',
        'security_alarm_system',
        'fire_alarm_system',
        'garden',
        'balcony',
        'terrace',
        'solar_panels',
        'thermal_insulation',
        'fireplace',
        'elevator',
        'storage',
        'swimming_pool',
        'sea_view',
        'mountain_view',
        'open_plan_kitchen',
        'smart_home',
        'furnished',
        'building_pool',
        'building_gym',
        'wheelchair_access',
        'well_water',
        'electricity',
        'status',
        'reason_for_refusal',
        'energy_consumption',
        'gas_emission',
        'buyer_id',
        'final_price',
        'sold_at'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title', 'city', 'postal_code'])
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50)
            ->preventOverwrite();
    }
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

        $array['images'] = $this->getMedia('images')->map(function ($media) {
            return [
                'url' => $media->getUrl(),
                'name' => $media->name
            ];
        })->toArray();

        $search = [
            'district' => $this->district,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'transaction_id' => (int)$this->transaction_id,
            'price' => (float)$this->price,
            'created_at' => $this->created_at->toISOString(),
            'square_meters' => (int)$this->square_meters,
        ];

        return array_merge($array, $search);
    }



    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('images', 'documents')
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

    public function contact()
    {
        return $this->hasMany(Contact::class);
    }
}
