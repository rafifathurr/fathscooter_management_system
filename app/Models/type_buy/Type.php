<?php

namespace App\Models\type_buy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $primaryKey = 'id';

    protected $table = "type_buy";

    protected $guarded = [];

    public $timestamps = false;
}
