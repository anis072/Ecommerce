<?php

namespace App;
use App\ProductAttribute;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function attribute(){
       return $this->hasMany('App\ProductAttribute','product_id');
    }
}
