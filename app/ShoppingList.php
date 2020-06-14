<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShoppingList extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'user_id', 'products'
    ];

    protected $casts = [
        'products' => 'array',
      ];

    public function getProductsAttribute()
    {
        return json_decode($this->attributes['products']);
    }
}
