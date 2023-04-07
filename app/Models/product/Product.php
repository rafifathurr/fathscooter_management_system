<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'id';

      protected $table = "product";

      protected $guarded = [];

      public $timestamps = false;

      public function category()
      {
        return $this->belongsTo('App\Models\category\Category', 'category_id', 'id');
      }

      public function supplier()
      {
        return $this->belongsTo('App\Models\supplier\Supplier', 'supplier_id', 'id');
      }

      public function createdby()
      {
        return $this->belongsTo('App\Models\users\User', 'created_by', 'username');
      }

      public function updatedby()
      {
        return $this->belongsTo('App\Models\users\User', 'updated_by', 'username');
      }
  }
