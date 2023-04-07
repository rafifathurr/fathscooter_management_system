<?php

namespace App\Exports;

use App\Models\order\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportOrderExport implements FromView
{
    
    public function __construct($data) {
        $this->data = $data;
    }

    public function view(): View
    { 
        return view('order.export', $this->data);
    }
}
