<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class products_image extends Model
{
    use SoftDeletes;

    public function products(){
        return $this->belongsTo(products::class, 'products_id', 'id');
    }
}
