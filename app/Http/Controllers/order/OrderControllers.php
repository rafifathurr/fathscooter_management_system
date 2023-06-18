<?php

namespace App\Http\Controllers\order;

use App\Http\Controllers\Controller;
use App\Models\order\Order;
use App\Models\order\DetailOrder;
use App\Models\source_payment\Source;
use App\Models\type_buy\Type;
use App\Models\product\Product;
use App\Exports\ReportOrderExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;
use Auth;
use Session;
use DB;

class OrderControllers extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Index View and Scope Data
    public function index()
    {
        return view('order.index', [
            "title" => "List Order",
            "years" => Order::select(DB::raw('YEAR(date_order) as tahun'))->orderBy(DB::raw('YEAR(date_order)'))->where('deleted_at',null)->groupBy(DB::raw("YEAR(date_order)"))->get(),
            "months" => Order::select(DB::raw('MONTH(date_order) as bulan'))->orderBy(DB::raw('MONTH(date_order)'))->where('deleted_at',null)->groupBy(DB::raw("MONTH(date_order)"))->get(),
            "types" => Type::orderBy('id', 'ASC')->where('deleted_at',null)->get(),
            "orders" => Order::orderBy('date_order', 'DESC')->where('deleted_at',null)->get()
        ]);
    }

    public function getMonth(Request $req){
        $months = Order::select(DB::raw('MONTH(date) as bulan, MONTHNAME(date) as nama_bulan'))->whereYear('date', $req->tahun)->orderBy(DB::raw('MONTH(date)'))->where('is_deleted',null)->groupBy(DB::raw("MONTHNAME(date)"))->groupBy(DB::raw("MONTH(date)"))->get();
        return json_encode($months);
    }

    // Create View Data
    public function create()
    {
        $data['title'] = "Add Order";
        $data['url'] = 'store';
        $data['disabled_'] = '';
        $data['types'] = Type::orderBy('id', 'asc')
                        ->where('deleted_at', null)
                        ->get();
        $data['products'] = Product::orderBy('product_name', 'asc')
                            ->where('status', 'Active')
                            ->where('deleted_at', null)
                            ->get();
        $data['sources'] = Source::orderBy('id', 'asc')
                            ->where('deleted_at', null)
                            ->get();
        return view('order.create', $data);
    }

    // get Detail Product View Data
    public function getProds(Request $req)
    {
        $data = Product::where('deleted_at', null)->get();
        return response()->json($data);
    }

    // get Detail Product View Data
    public function getDetailProds(Request $req)
    {
        $data["prods"] = Product::where("id", $req->id_prod)->first();
        return $data["prods"];
    }

    // Store Function to Database
    public function store(Request $req)
    {

        date_default_timezone_set("Asia/Jakarta");
        $datenow = date('Y-m-d H:i:s');

        $total_arr = count($req->product_id);

        $orders = Order::create([
            'invoice' => $req->invoice,
            'date_order' => $req->tgl,
            'source_id' => $req->source_pay,
            'type_buy' => $req->type_buy,
            'entry_price' => $req->entry_price,
            'total_base_price' => $req->base_price,
            'total_sell_price' => $req->sell_price,
            'platform_fee' => $req->cal_tax,
            'profit' => $req->cal_profit,
            'source_id' => $req->source_pay,
            'created_at' => $datenow,
            'created_by' => Auth::user()->id
        ]);

        if($orders){

            $total_arr = count($req->product_id);

            for($i = 0; $i<$total_arr; $i++){
                $sell = $req->sell_price_arr[$i];
                $sell = explode("Rp.", $sell);
                $sell = array_pop($sell);
                $sell = explode(".", $sell);
                $total_sell = implode("", $sell);

                $base = $req->base_price_arr[$i];
                $base = explode("Rp.", $base);
                $base = array_pop($base);
                $base = explode(".", $base);
                $total_base = implode("", $base);

                $details = DetailOrder::create([
                    'id_order' => $orders->id,
                    'id_product' => $req->product_id[$i],
                    'qty' => $req->qty[$i],
                    'base_price_save' => $total_base,
                    'selling_price_save' => $total_sell,
                    'created_at' => $datenow
                ]);

                if($details){

                    $get_prods = Product::where('id', $req->product_id[$i])
                                ->first();

                    $new_update_stock = $get_prods->stock - $req->qty[$i];

                    if($new_update_stock == 0){

                       $update_stock = Product::where('id', $req->product_id[$i])
                                        ->update([
                                            'stock' => $new_update_stock,
                                            'status' => 'Inactive',
                                            'updated_at' => $datenow,
                                            'updated_by' => Auth::user()->id
                                        ]);

                    }else{

                        $update_stock = Product::where('id', $req->product_id[$i])
                                        ->update([
                                            'stock' => $new_update_stock,
                                            'updated_at' => $datenow,
                                            'updated_by' => Auth::user()->id
                                        ]);

                    }

                }

            }

            if($update_stock){

                if(Auth::guard('admin')->check()){

                    return redirect()->route('admin.order.index')->with(['success' => 'Data successfully stored!']);
                }else{

                    return redirect()->route('user.order.index')->with(['success' => 'Data successfully stored!']);

                }

            }

        }

    }

    // Detail Data View by id
    public function detail($id)
    {
        $data['title'] = "Detail Order";
        $data['disabled_'] = 'disabled';
        $data['url'] = 'create';
        $data['orders'] = Order::where('id', $id)
                            ->first();
        $data['details_order'] = DetailOrder::with('product')
                                ->where('id_order', $id)
                                ->get();
        $data['products'] = Product::orderBy('product_name', 'asc')
                            ->get();
        $data['sources'] = Source::orderBy('id', 'asc')
                            ->get();
        $data['types'] = Type::orderBy('id', 'asc')
                        ->where('deleted_at', null)
                        ->get();
        return view('order.create', $data);
    }

    // Edit Data View by id
    public function edit($id)
    {
        $data['title'] = "Edit Order";
        $data['disabled_'] = '';
        $data['url'] = 'update';
        $data['orders'] = Order::where('id', $id)
                            ->first();
        $data['products'] = Product::orderBy('product_name', 'asc')
                            ->get();
        $data['sources'] = Source::orderBy('id', 'asc')
                            ->get();
        $data['types'] = Type::orderBy('id', 'asc')
                        ->where('deleted_at', null)
                        ->get();
        return view('order.create', $data);
    }

    // Update Function to Database
    public function update(Request $req)
    {
        date_default_timezone_set("Asia/Bangkok");
        $datenow = date('Y-m-d H:i:s');
        $order_pay = Order::where('id', $req->id)->update([
            'product_id' => $req->prods,
            'qty' => $req->qty,
            'entry_price' => $req->entry_price,
            'source_id' => $req->source_pay,
            'date' => $req->tgl,
            'note' => $req->note,
            'tax' => $req->cal_tax,
            'profit' => $req->cal_profit,
            'updated_at' => $datenow,
            'updated_by' => Auth::user()->username
        ]);

        if(Auth::guard('admin')->check()){
            return redirect()->route('admin.order.index')->with(['success' => 'Data successfully updated!']);
        }else{
            return redirect()->route('user.order.index')->with(['success' => 'Data successfully updated!']);
        }
    }

    // Delete Data Function
    public function delete(Request $req)
    {
        $datenow = date('Y-m-d H:i:s');
        $exec_1 = Order::where('id', $req->id )->update([
            'deleted_at'=>$datenow,
            'updated_at'=>$datenow,
            'updated_by'=>Auth::user()->username
        ]);

        $exec_2 = DetailOrder::where('id_order', $req->id )->update([
            'deleted_at'=>$datenow,
            'updated_at'=>$datenow
        ]);

        if ($exec_1 && $exec_2) {
            Session::flash('success', 'Data successfully deleted!');
          } else {
            Session::flash('gagal', 'Error Data');
          }
    }

    // Index View and Scope Data
    public function export(Request $req)
    {
        if($req->bulan==0){
            $orders= Order::whereYear('date', $req->tahun)->orderBy('date', 'ASC')->get();
            $sum= Order::selectRaw(DB::raw("SUM(base_price_product) as total_base, SUM(qty) as total_qty, SUM(tax) as total_tax, SUM(profit) as total_profit"))->whereYear('date', $req->tahun)->first();
            $data =  [
                'success' => 'success',
                'orders' => $orders,
                'sum' => $sum,
                'year' => $req->tahun
            ];
            return Excel::download(new ReportOrderExport($data), 'Reports_Order_'.$req->tahun.'.xlsx');
        }else{
            $orders= Order::whereMonth('date', $req->bulan)->whereYear('date', $req->tahun)->get();
            $sum= Order::selectRaw(DB::raw("SUM(base_price_product) as total_base, SUM(qty) as total_qty, SUM(tax) as total_tax, SUM(profit) as total_income, SUM(profit) as total_profit"))->whereMonth('date', $req->bulan)->whereYear('date', $req->tahun)->orderBy('date', 'ASC')->first();
            $data =  [
                'success' => 'success',
                'orders' => $orders,
                'sum' => $sum,
                'year' => $req->tahun,
                'month' => $req->bulan
            ];
            return Excel::download(new ReportOrderExport($data), 'Reports_Order_'.date("F", mktime(0, 0, 0, $req->month, 10)).'_'.$req->tahun.'.xlsx');
        }

    }
}
