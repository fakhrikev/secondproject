<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class products extends Model
{
    use SoftDeletes;

     public function category(){
         return $this->belongsTo(ProductsCategories::class,'category_id','id');
     }

     public function  image(){
         return $this->hasMany(ProductsImages::class, 'product_id', 'id');
     }
}
