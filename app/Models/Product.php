<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [

        'category_id',
        'brand_id',
        'name',
        'codebar',
        'slug',
        'description',
        'price',
        'price2',
        'cost',
        'utility_percentage',
        'profit',
        'stock',
        'main_image',
        'cover_image',
       /*  'status', */
        'interchangeable',
        'refundable',
        'video_provider',
        'video_link',
        'unit'
    ];

    const UNITS = [
        
        'UND' => 'UND',
        'CAJA' => 'CAJA',
        'PAR' => 'PAR', 
        'PIEZA' => 'PIEZA',
        'KIT' => 'Caja',
        'SET' => 'SET',
        'JUEGO' => 'JUEGO'
    ];

    protected $casts = [
        'interchangeable' => 'boolean',
        'refundable' => 'boolean',
        'price' => 'decimal:2',
        'price2' => 'decimal:2',
        'cost' => 'decimal:2',
        'profit' => 'decimal:2',
        'utility_percentage' => 'decimal:2',
    ];

    /**
     * Relación con las imágenes adicionales
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Relación con la categoría
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relación con la marca
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Accesor para la imagen principal
     */
    public function getMainImageUrlAttribute()
    {
        return $this->main_image ? asset('storage/' . $this->main_image) : asset('assets/images/default-product.png');
    }

    /**
     * Accesor para la imagen de portada
     */
    public function getCoverImageUrlAttribute()
    {
        return $this->cover_image ? asset('storage/' . $this->cover_image) : $this->main_image_url;
    }

    /**
     * Calcular utilidad automáticamente
     */
    public function calculateProfit(){

        if ($this->cost && $this->utility_percentage) {
            $this->profit = ($this->cost * $this->utility_percentage) / 100;
            $this->price = $this->cost + $this->profit;
        }
    }


    public function orderItems(){

        return $this->hasMany(OrderItem::class);
    }

    public function reviews(){

        return $this->hasMany(Review::class);
    }

    /** Boot del modelo*/
    protected static function boot(){

        parent::boot();

        static::saving(function ($product) {
            $product->calculateProfit();
            
            // Generar slug automáticamente si no existe
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }
}