<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id_product', 'name', 'description', 'image', 'stock', 'price', 'id_category',
    ];
}
