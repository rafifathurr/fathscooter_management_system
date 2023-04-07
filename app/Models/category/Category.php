<?php

namespace App\Models\category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'id';
  
      protected $table = "category_prod";
  
      protected $guarded = [];

      public $timestamps = false;
  }
