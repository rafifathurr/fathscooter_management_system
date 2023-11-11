<?php

namespace App\Models\analysis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAnalysis extends Model
{
    protected $primaryKey = 'id';

    protected $table = "detail_analysis";

    protected $guarded = [];

    public $timestamps = false;

    public function analysis()
    {
        return $this->belongsTo('App\Models\analysis\Analysis', 'id_analysis', 'id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\product\Product', 'id_product', 'id');
    }
}
