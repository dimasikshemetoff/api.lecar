<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $fillable = ['title', 'category', 'image','manufactured','description','newprice','isfavorite','oldprice'];

    protected static function boot()
{
    parent::boot();

    static::creating(function ($product) {
        $product->articul = str_pad(Product::max('id') + 1, 6, '1', STR_PAD_LEFT);
    });
}

}
