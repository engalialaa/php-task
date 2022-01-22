<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetails extends Model
{
    protected $guarded =[];

    protected $table = 'sale_details';

    public function Product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
