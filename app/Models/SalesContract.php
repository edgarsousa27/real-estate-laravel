<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SalesContract extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'sales_contract';

    protected $fillable = [
        'property_id',
        'owner_id',
        'buyer_id',
        'offer_date',
        'payment_method',
        'final_price',
        'final_price_for_seller',
        'commission',
        'total_revenue'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
}
