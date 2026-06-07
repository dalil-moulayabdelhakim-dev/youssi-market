<?php

namespace App\Models;

use App\Models\Scopes\ActiveStoreScope;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'type',
        'description',
        'image',
        'category_id',
        'store_id',
        'quantity',
        'price',
        'weight',
        'discount_price',
        'old_price',
    ];

    protected static function booted(): void
    {
        // Apply scope globally for public frontend
        static::addGlobalScope(new ActiveStoreScope());
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImages::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
