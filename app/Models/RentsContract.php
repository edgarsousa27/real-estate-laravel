<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class RentsContract extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'rents_contract';

    protected $fillable = [
        'property_id',
        'tenant_id',
        'landlord_id',
        'price',
        'payment_method',
        'start_contract',
        'end_contract',
        'months_contract',
        'total_price_contract',
        'total_landlord_revenue',
        'total_revenue',
        'total_revenue_per_month',
        'commission'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }
    public function landlord()
    {
        return $this->belongsTo(User::class, 'landlord_id');
    }
}
