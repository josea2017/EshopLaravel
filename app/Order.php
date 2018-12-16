<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id_car', 'id_user', 'id_product', 'price_product', 'quantity', 'price_total'
    ];
}