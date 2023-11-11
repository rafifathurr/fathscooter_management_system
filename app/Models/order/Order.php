<?php

namespace App\Models\order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'id';

    protected $table = "orders";

    protected $guarded = [];

    public $timestamps = false;

    public function details()
    {
        return $this->belongsTo('App\Models\order\DetailOrder', 'id', 'id_order');
    }

    public function source()
    {
        return $this->belongsTo('App\Models\source_payment\Source', 'source_id', 'id');
    }

    public function createdby()
    {
        return $this->belongsTo('App\Models\users\User', 'created_by', 'id');
    }

    public function updatedby()
    {
        return $this->belongsTo('App\Models\users\User', 'updated_by', 'id');
    }
}
