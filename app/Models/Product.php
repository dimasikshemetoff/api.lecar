<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $fillable = [
        'title', 
        'category', 
        'image',
        'manufactured',
        'description',
        'newprice',
        'isfavorite',
        'prescription_required',
        'oldprice'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $nextId = Product::max('id') + 1;
            $product->articul = str_pad($nextId, 6, '0', STR_PAD_LEFT);
        });
    }
}