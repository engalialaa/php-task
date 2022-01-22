<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $guarded =[];

    protected $table = 'sales';

    public function SaleDetails(){
        return $this->hasMany(SaleDetails::class,'sale_id');
    }
}
