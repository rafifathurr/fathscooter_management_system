<?php

namespace App\Models\supplier;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $primaryKey = 'id';

      protected $table = "supplier";

      protected $guarded = [];

      public $timestamps = false;
  }
