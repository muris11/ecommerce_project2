<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 
        'brand_id',
        'name',
        'slug',
        'image',
        'description',
        'price',
        'is_active',
        'is_featured',
        'in_stock',
        'on_sale',
    ];

    protected $casts = [
        'image' => 'array',
    ];
    
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function orders(){ 
        return $this->belongsToMany(Order::class);
    }

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }

    // Helper method to get first image
    public function getFirstImageAttribute()
    {
        if (is_array($this->image) && count($this->image) > 0) {
            return $this->image[0];
        }
        return $this->image;
    }
}
