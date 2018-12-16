<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    protected $fillable = [
        'id_car', 'id_user', 'id_product', 'quantity'
    ];
}