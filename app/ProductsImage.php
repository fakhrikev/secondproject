<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class productsImage extends Model
{
    use SoftDeletes;

    public function products(){
        return $this->belongsTo(Products::class, 'products_id', 'id');
    }
}
