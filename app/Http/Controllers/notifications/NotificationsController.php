<?php

namespace App\Http\Controllers\notifications;

use App\Http\Controllers\Controller;
use App\Models\product\Product;

class NotificationsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // Index View and Scope Data
    public function index()
    {
        return view('notifications.index', [
            "title" => "List All Notifications",
            "all_notif" => Product::where('stock', '<=', 2)
                ->where('deleted_at', null)
                ->orderBy('updated_at', 'desc')
                ->get()
        ]);
    }
}
