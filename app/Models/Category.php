<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function Products(){
        return $this->hasMany(Product::class,'category_id')->where('is_shown','yes');
    }
}
