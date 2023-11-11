<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BundleItem extends Model
{
    use HasFactory;

    protected $table = "bundle_item";

    public function bundle()
    {
        return $this->hasMany('App\Models\product\Bundle', 'bundle_id', 'id');
    }
    public function product()
    {
        return $this->hasMany('App\Models\product\Product', 'product_id', 'id');
    }
}
