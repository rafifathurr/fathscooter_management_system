<?php

namespace App\Models\analysis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analysis extends Model
{
    protected $primaryKey = 'id';

    protected $table = "analysis";

    protected $guarded = [];

    public $timestamps = false;
}
