<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class products extends Model
{
    use SoftDeletes;

     public function category(){
         return $this->belongsTo(products_categories::class,'category_id','id');
     }

     public function  image(){
         return $this->hasMany(products_images::class, 'product_id', 'id');
     }
}
