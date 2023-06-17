<?php

namespace App\Models\order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    protected $primaryKey = 'id';

      protected $table = "details_order";

      protected $guarded = [];

      public $timestamps = false;

      public function product()
      {
        return $this->belongsTo('App\Models\product\Product', 'id_product', 'id');
      }

  }
