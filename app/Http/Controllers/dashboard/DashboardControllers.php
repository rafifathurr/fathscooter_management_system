<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\order\Order;
use App\Models\order\DetailOrder;
use App\Models\product\Product;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use DateTime;

class DashboardControllers extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Index View and Scope Data
    public function index()
    {

        $month = range(1, 12);
        $year = range(date('Y') - 4, date('Y'));

        // RETURN DATA
        $data['title'] = "Dashboard";
        $data['orders'] = Order::all();
        $data['dayofweeks'] = Order::whereRaw('date_order >= DATE(NOW() - INTERVAL 7 DAY)')
            ->where('deleted_at', null)
            ->orderBy('date_order', 'ASC')
            ->select(DB::raw('DATE_FORMAT(date_order, "%a") as name_day'))
            ->get();
        $data['calofday'] = Order::whereRaw('date_order >= DATE(NOW() - INTERVAL 7 DAY)')
            ->where('deleted_at', null)
            ->select(DB::raw('count(*) as total'))
            ->orderBy('date_order', 'ASC')
            ->groupBy('date_order')
            ->get();
        $data['profitmonth'] = Order::whereRaw('date_order <= NOW() and date_order >= Date_add(Now(),interval - 12 month)')
            ->where('deleted_at', null)
            ->select(DB::raw('sum(profit) as profit'))
            ->orderBy(DB::raw('DATE_FORMAT(date_order, "%b")'), 'ASC')
            ->groupBy(DB::raw('DATE_FORMAT(date_order, "%b")'))
            ->get();
        $data['countorderall'] = count(Order::all()->where('deleted_at', null));
        $data['countorderyear'] = count(Order::whereYear('date_order', Carbon::now()->year)->where('deleted_at', null)->get());
        $data['countorderlastyear'] = count(Order::whereYear('date_order', (Carbon::now()->year) - 1)->where('deleted_at', null)->get());
        $data['countordermonth'] = count(Order::whereMonth('date_order', Carbon::now()->month)
            ->where('deleted_at', null)
            ->whereRaw('YEAR(date_order) = YEAR(now())')
            ->get());
        $data['countorderlastmonth'] = count(Order::whereMonth('date_order', Carbon::now()->month - 1)
            ->where('deleted_at', null)
            ->whereRaw('YEAR(date_order) = YEAR(now())')
            ->get());
        $data['countorderday'] = count(Order::whereRaw('DAY(date_order) = DAY(now())')
            ->where('deleted_at', null)
            ->whereRaw('YEAR(date_order) = YEAR(now())')
            ->get());
        $data['countorderlastday'] = count(Order::whereRaw('DAY(date_order) = (DAY(now())-1)')
            ->where('deleted_at', null)
            ->whereRaw('YEAR(date_order) = YEAR(now())')
            ->get());
        $data['totalincome'] = Order::whereMonth('date_order', Carbon::now()->month)
            ->where('deleted_at', null)
            ->whereRaw('YEAR(date_order) = YEAR(now())')
            ->sum('entry_price');
        $data['totalincomelast'] = Order::whereMonth('date_order', Carbon::now()->month - 1)
            ->where('deleted_at', null)
            ->whereRaw('YEAR(date_order) = YEAR(now())')
            ->sum('entry_price');
        $data['totalprofit'] = Order::whereMonth('date_order', Carbon::now()->month)
            ->where('deleted_at', null)
            ->whereRaw('YEAR(date_order) = YEAR(now())')
            ->sum('profit');
        $data['totalprofitlast'] = Order::whereMonth('date_order', Carbon::now()->month - 1)
            ->where('deleted_at', null)
            ->whereRaw('YEAR(date_order) = YEAR(now())')
            ->sum('profit');
        $data['totaltax'] = Order::whereMonth('date_order', Carbon::now()->month)
            ->where('deleted_at', null)
            ->whereRaw('YEAR(date_order) = YEAR(now())')
            ->sum('platform_fee');
        $data['totaltaxlast'] = Order::whereMonth('date_order', Carbon::now()->month - 1)
            ->where('deleted_at', null)
            ->whereRaw('YEAR(date_order) = YEAR(now())')
            ->sum('platform_fee');
        $data['incomepermonth'] = Order::whereYear('date_order', Carbon::now()->year)
            ->where('deleted_at', null)
            ->selectRaw('sum(entry_price) as income')
            ->groupBy(DB::raw('MONTH(date_order)'))
            ->orderBy(DB::raw('MONTH(date_order)'), 'ASC')
            ->get();

        foreach ($year as $y) {
            $data['years'][] = array(strval($y));
            $checkstat = Order::whereYear('date_order', $y)
                ->where('deleted_at', null)
                ->selectRaw('sum(profit) as profit')
                ->orderBy(DB::raw('YEAR(date_order)'), 'ASC')
                ->groupBy(DB::raw('YEAR(date_order)'))
                ->first();
            $profityear = Order::whereYear('date_order', $y)
                ->where('deleted_at', null)
                ->selectRaw('sum(profit) as profit')
                ->orderBy(DB::raw('YEAR(date_order)'), 'ASC')
                ->groupBy(DB::raw('YEAR(date_order)'))
                ->get();
            if ($checkstat) {
                foreach ($profityear as $profit) {
                    if ($profit->profit) {
                        $data['profityear'][] = array($profit->profit);
                    } else {
                        $data['profityear'][] = array('0');
                    }
                }
            } else {
                $data['profityear'][] = array('0');
            }
        }

        foreach ($month as $mon) {
            $dateObj   = DateTime::createFromFormat('!m', $mon);
            $monthName = $dateObj->format('F');
            $data['month'][] = array('month' => $monthName);
            $checkstat = Order::whereYear('date_order', Carbon::now()->year)
                ->where('deleted_at', null)
                ->whereMonth('date_order', $mon)
                ->selectRaw('sum(profit) as profit')
                ->orderBy(DB::raw('MONTH(date_order)'), 'ASC')
                ->groupBy(DB::raw('MONTH(date_order)'))
                ->first();
            $profitmonth = Order::whereYear('date_order', Carbon::now()->year)
                ->where('deleted_at', null)
                ->whereMonth('date_order', $mon)
                ->selectRaw('sum(profit) as profit')
                ->orderBy(DB::raw('MONTH(date_order)'), 'ASC')
                ->groupBy(DB::raw('MONTH(date_order)'))
                ->get();
            if ($checkstat) {
                foreach ($profitmonth as $profit) {
                    if ($profit->profit) {
                        $data['profitpermonth'][] = array($profit->profit);
                    } else {
                        $data['profitpermonth'][] = array('0');
                    }
                }
            } else {
                $data['profitpermonth'][] = array('0');
            }
        }

        $data['allprods'] = Product::where('deleted_at', null)->count();
        $data['activeprods'] = Product::where('deleted_at', null)->where('status', 'Active')->count();
        $data['inactiveprods'] = Product::where('deleted_at', null)->where('status', 'Inactive')->count();

        $data['topproduct'] = DetailOrder::with('product')
            ->select(DB::raw('details_order.id_product, sum(qty) as total'))
            ->join('orders', 'orders.id', '=', 'details_order.id_order')
            ->whereYear('orders.date_order', Carbon::now()->year)
            ->whereRaw('MONTH(orders.date_order) = MONTH(now())')
            ->where('orders.deleted_at', null)
            ->groupBy('details_order.id_product')
            ->orderBy('total', 'desc')
            ->get();

        $data['topsource'] = Order::with('source')
            ->whereYear('date_order', Carbon::now()->year)
            ->whereRaw('MONTH(date_order) = MONTH(now())')
            ->where('deleted_at', null)
            ->select(DB::raw('source_id, count(*) as total'))
            ->groupBy('source_id')
            ->orderBy('total', 'desc')
            ->get();

        // RETURN VIEW
        return view('dashboard', $data);
    }
}
