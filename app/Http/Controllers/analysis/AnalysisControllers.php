<?php

namespace App\Http\Controllers\analysis;

use App\Http\Controllers\Controller;
use App\Models\analysis\Analysis;
use App\Models\analysis\DetailAnalysis;
use App\Models\order\DetailOrder;
use App\Models\type_buy\Type;
use App\Models\product\Product;
use App\Exports\ReportOrderExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;
use Auth;
use Session;
use DB;

class AnalysisControllers extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Index View and Scope Data
    public function index()
    {
        date_default_timezone_set("Asia/Jakarta");
        $year = date('Y', strtotime('-1 years'));
        $check = Analysis::where('year', $year)
                ->whereNull('deleted_at')
                ->first();

        if($check){
            $disabled = true;
        }else{
            $disabled = false;
        }

        return view('analysis.index', [
            "title" => "Analysis",
            "analysis" => Analysis::orderBy('month', 'DESC')->where('deleted_at',null)->get(),
            'disabled' => $disabled
        ]);
    }

    // Create View Data
    public function create()
    {
        date_default_timezone_set("Asia/Jakarta");
        $year = date('Y', strtotime('-1 years'));

        $data['title'] = "Add Analysis";
        $data['url'] = 'store';
        $data['year'] = $year;
        $data['details'] = DetailOrder::selectRaw('
                                    product.id as id_product,
                                    product.product_name,
                                    AVG(details_order.base_price_save) as setupcost,
                                    SUM(details_order.qty) as demandpermonth
                                ')
                                ->join('orders', 'orders.id', '=', 'details_order.id_order')
                                ->join('product', 'product.id', '=', 'details_order.id_product')
                                ->whereYear('orders.date_order', $year)
                                ->groupBy('product.id')
                                ->groupBy('product.product_name')
                                ->get();

       $data_prods = DetailOrder::selectRaw('
                                product.id as id_product,
                                product.product_name
                            ')
                            ->join('orders', 'orders.id', '=', 'details_order.id_order')
                            ->join('product', 'product.id', '=', 'details_order.id_product')
                            ->whereYear('orders.date_order', $year)
                            ->groupBy('product.id')
                            ->groupBy('product.product_name')
                            ->get();

        foreach($data_prods as $prods){

            $data['details_2'][] = DetailOrder::selectRaw('
                                    AVG(details_order.qty) as avg_sales,
                                    MAX(details_order.qty) as max_sales
                                ')
                                ->join('orders', 'orders.id', '=', 'details_order.id_order')
                                ->where('details_order.id_product', $prods->id_product)
                                ->whereYear('orders.date_order', $year)
                                ->groupBy(DB::raw('MONTH(orders.date_order)'))
                                ->first();

        }
        $data['disabled_'] = '';
        return view('analysis.create', $data);
    }

    // Store Function to Database
    public function store(Request $req)
    {

        date_default_timezone_set("Asia/Jakarta");
        $datenow = date('Y-m-d H:i:s');

        $analysis = Analysis::create([
            // 'month' => $req->month,
            'year' => $req->year,
            'created_at' => $datenow,
            'created_by' => Auth::user()->id
        ]);

        if($analysis){
            $total_arr = count($req->id_product);

            for($i = 0; $i<$total_arr; $i++){

                $details = DetailAnalysis::create([
                    'id_analysis' => $analysis->id,
                    'id_product' => $req->id_product[$i],
                    'demand' => $req->demandpermonth[$i],
                    'setupcost' => $req->setupcost[$i],
                    'holdingcost' => $req->holdingcost[$i],
                    'eoq_value' => $req->eoq[$i],
                    'avg_sales' => $req->avg_sales[$i],
                    'max_sales' => $req->max_sales[$i],
                    'avg_lead_time' => $req->avg_lead_time[$i],
                    'max_lead_time' => $req->max_lead_time[$i],
                    'safety_stock' => $req->safety_stock[$i],
                    'rop' => $req->rop[$i],
                    'created_at' => $datenow
                ]);

            }

            if($details){

                return redirect()->route('admin.analysis.index')->with(['success' => 'Data successfully stored!']);

            }

        }

    }

    // Edit Data View by id
    public function edit($id)
    {
        date_default_timezone_set("Asia/Jakarta");
        $year = date('Y', strtotime('-1 years'));
        // $month = date('m', strtotime('-1 month'));

        // $data['month'] = $month;
        $data['year'] = $year;
        $data['title'] = "Edit Analysis";
        $data['disabled_'] = 'disabled';
        $data['url'] = 'update';
        $data['analysis'] = Analysis::where('id', $id)
                                ->first();

        $data['details'] = DetailAnalysis::with('product')
                            ->where('id_analysis', $id)
                            ->orderBy('eoq_value','desc')
                            ->get();

        $data['details_2'] = DetailAnalysis::with('product')
                            ->where('id_analysis', $id)
                            ->orderBy('rop','desc')
                            ->get();

        return view('analysis.create', $data);
    }

    // Store Function to Database
    public function update(Request $req)
    {

        date_default_timezone_set("Asia/Jakarta");
        $datenow = date('Y-m-d H:i:s');



        $analysis = Analysis::where('id', $req->id_analysis)
                    ->update([
                        // 'month' => $req->month,
                        'year' => $req->year,
                        'updated_at' => $datenow,
                        'updated_by' => Auth::user()->id
                    ]);

        $check = DetailAnalysis::where('id_analysis', $req->id_analysis)->get();

        if($analysis){
            $total_arr = count($req->id_product);

            for($i = 0; $i<$total_arr; $i++){
                $details = DetailAnalysis::where('id_analysis', $req->id_analysis)
                ->where('id', $check[$i]->id)
                ->update([
                    'id_product' => $req->id_product[$i],
                    'demand' => $req->demandpermonth[$i],
                    'setupcost' => $req->setupcost[$i],
                    'holdingcost' => $req->holdingcost[$i],
                    'eoq_value' => $req->eoq[$i],
                    'avg_sales' => $req->avg_sales[$i],
                    'max_sales' => $req->max_sales[$i],
                    'avg_lead_time' => $req->avg_lead_time[$i],
                    'max_lead_time' => $req->max_lead_time[$i],
                    'safety_stock' => $req->safety_stock[$i],
                    'rop' => $req->rop[$i],
                    'updated_at' => $datenow
                ]);

            }

            if($details){

                return redirect()->route('admin.analysis.index')->with(['success' => 'Data successfully updated!']);

            }

        }

    }

    // Detail Data View by id
    public function detail($id)
    {
        $data['title'] = "Detail Analysis";
        $data['disabled_'] = 'disabled';
        $data['url'] = 'create';
        $data['details'] = DetailAnalysis::with('product')
                            ->where('id_analysis', $id)
                            ->orderBy('eoq_value','desc')
                            ->get();
        $data['details_2'] = DetailAnalysis::with('product')
                            ->where('id_analysis', $id)
                            ->orderBy('rop','desc')
                            ->get();
        return view('analysis.create', $data);
    }

    // Summary Data View by id
    public function summary($id)
    {
        $analysis = Analysis::where('id', $id)
                    ->first();
                    
        $data['title'] = "Summary Analysis";
        $data['year'] = $analysis->year;
        $data['disabled_'] = 'disabled';
        $data['details'] = DetailAnalysis::with('product')
                            ->where('id_analysis', $id)
                            ->orderBy('eoq_value','desc')
                            ->limit(5)
                            ->get();
        $data['details_2'] = DetailAnalysis::with('product')
                            ->where('id_analysis', $id)
                            ->orderBy('rop','desc')
                            ->limit(5)
                            ->get();
        return view('analysis.summary', $data);
    }

    // Delete Data Function
    public function delete(Request $req)
    {
        $datenow = date('Y-m-d H:i:s');
        $exec_1 = Analysis::where('id', $req->id )->update([
            'deleted_at'=>$datenow,
            'updated_at'=>$datenow,
            'updated_by'=>Auth::user()->id
        ]);

        $exec_2 = DetailAnalysis::where('id_analysis', $req->id )->update([
            'deleted_at'=>$datenow,
            'updated_at'=>$datenow
        ]);

        if ($exec_1 && $exec_2) {
            Session::flash('success', 'Data successfully deleted!');
          } else {
            Session::flash('gagal', 'Error Data');
          }
    }
}
