<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Relación: Una ciudad tiene muchas zonas
     */
    public function zones()
    {
        return $this->hasMany(Zone::class);
    }

    /**
     * Relación: Una ciudad tiene muchas direcciones de envío a través de zonas
     */
    public function shippingAddresses()
    {
        return $this->hasManyThrough(ShippingAddress::class, Zone::class);
    }

    /**
     * Accesor para obtener zonas ordenadas por precio
     */
    public function getZonesOrderedByPriceAttribute()
    {
        return $this->zones()->orderBy('price')->get();
    }
}