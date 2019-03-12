<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class productsCategory extends Model
{
    use SoftDeletes;

   public function products(){
       return $this->hasMany(Products::class, 'category_id', 'id');
   }
}
