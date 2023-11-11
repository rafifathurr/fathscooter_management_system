<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    use HasFactory;

    protected $table = "bundle";

    public function category()
    {
        return $this->hasMany('App\Models\product\Product', 'product_id', 'id');
    }
}
