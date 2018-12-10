<?php

namespace App;
//<p>{{Auth::user()->email}}</p>
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'id_user',
    ];
}
