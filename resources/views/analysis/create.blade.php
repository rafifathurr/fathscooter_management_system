<!DOCTYPE html>
<html lang="en">
@include('layouts.head')
<style>
    .numeric{
        text-align: right;
        width: 100px !important;
        height: 25px !important;
    }
</style>
<body>
    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="main-panel">
            <div class="content">
                <div class="panel-header bg-primary-gradient">
                    <div class="page-inner py-5">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            <div>
                                <h2 class="pb-2 fw-bold">{{ $title }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <form id="form_add" action="{{ route('admin.analysis.' . $url) }}" method="POST" enctype="multipart/form-data">
                    <section class="content container-fluid">
                        <div class="content container-fluid">
                            <div class="box box-primary">
                                <div class="box-body">
                                    <h4><b>Economic Order Quantity Analysis</b></h4>
                                    <input type="hidden" name="id_analysis" @isset($analysis) value="{{ $analysis->id }}" @endisset>
                                    {{-- <input type="hidden" name="month" @isset($month) value="{{ $month }}" @endisset> --}}
                                    <input type="hidden" name="year" @isset($year) value="{{ $year }}" @endisset>
                                    {{ csrf_field() }}
                                    <br>
                                    <table @if($title == 'Detail Analysis') id="add-row" @endif class="table table-striped table-bordered table-hover" width="100%" style="text-align: center;">
                                        <thead style="background-color: #fbfbfb;">
                                            <tr>
                                                <th style="vertical-align: middle;" width="5%">
                                                    <center>No</center>
                                                </th>
                                                <th style="vertical-align: middle;" width="25%">
                                                    <center>Products</center>
                                                </th>
                                                <th style="vertical-align: middle;" width="15%">
                                                    <center>Total Demand</center>
                                                </th>
                                                <th style="vertical-align: middle;" width="15%">
                                                    <center>Base Price Average</center>
                                                </th>
                                                <th style="vertical-align: middle;" width="15%">
                                                    <center>Holding Cost</center>
                                                </th>
                                                <th style="vertical-align: middle;" width="15%">
                                                    <center>EOQ</center>
                                                </th>
                                                @if ($title == 'Add Analysis' || $title == 'Edit Analysis')
                                                <th style="vertical-align: middle;" width="10%">
                                                    <center>Action</center>
                                                </th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody id="table_body">
                                        @if($title == 'Edit Analysis' || $title == 'Add Analysis')
                                            @foreach($details as $key=>$detail)
                                            <tr id='{{ $detail->id_product }}'>
                                                <td style="text-align:left;">
                                                    {{  $key+1 }}
                                                </td>
                                                <td style="text-align:left;">
                                                    <input type="hidden" name="id_product[]" value="{{$detail->id_product}}">
                                                    @isset($detail->product_name)
                                                        {{  $detail->product_name }}
                                                    @else
                                                        {{ $detail->product->product_name }}
                                                    @endisset
                                                </td>
                                                <td style="text-align:center;">
                                                    <input type="hidden" id="demandpermonth_data" @isset($detail->demandpermonth) value="{{$detail->demandpermonth}}" @else value="{{$detail->demand}}" @endisset readonly required>
                                                    <input type="number" class='form-control numeric' name="demandpermonth[]" @isset($detail->demandpermonth) value="{{$detail->demandpermonth}}" @else value="{{$detail->demand}}" @endisset id="demandpermonth_{{ $detail->id_product }}" readonly required>
                                                </td>
                                                <td style="text-align:center;">
                                                    <input type="hidden" id="setupcost_data" value="{{$detail->setupcost}}">
                                                    <input type="text" class='form-control numeric' name="setupcost[]" id="setupcost_{{ $detail->id_product }}" value="{{number_format((float)$detail->setupcost, 0, '.', '')}}" readonly required>
                                                </td>
                                                <td style="text-align:center;">
                                                    <input type="text" class='form-control numeric' min=0 @isset($detail->holdingcost) value="{{$detail->holdingcost}}" @endisset name="holdingcost[]" id="holdingcost_{{ $detail->id_product }}" oninput="calculate_eoq({{$detail->id_product}})" required>
                                                </td>
                                                <td style="text-align:center;">
                                                    <input type="number" class='form-control numeric' name="eoq[]" @isset($detail->eoq_value) value="{{$detail->eoq_value}}" @endisset id="eoq_{{ $detail->id_product }}" readonly required>
                                                </td>
                                                <td>
                                                    <center>
                                                        <button type='button' class='btn btn-link btn-simple-danger' onclick="reset_data({{ $detail->id_product }}, 1)" title='Reset'>
                                                            <i style="color:black; font-weight:bold;" class="icon-refresh"></i>
                                                        </button>
                                                    </center>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            @foreach($details as $key=>$detail)
                                                <tr id='{{ $detail->id_product }}'>
                                                    <td style="text-align:center;">
                                                        {{  $key+1 }}
                                                    </td>
                                                    <td style="text-align:left;">
                                                        <input type="hidden" name="id_product" value="{{$detail->id_product}}">
                                                        {{  $detail->product->product_name }}
                                                    </td>
                                                    <td>
                                                        <center>
                                                            {{$detail->demand}}
                                                        </center>
                                                    </td>
                                                    <td style="text-align:right;">
                                                        Rp. {{number_format($detail->setupcost,0,',','.')}}
                                                    </td>
                                                    <td style="text-align:right;">
                                                        Rp. {{number_format($detail->holdingcost,0,',','.')}}
                                                    </td>
                                                    <td style="text-align:right;">
                                                        <center>
                                                            <b>
                                                                {{ $detail->eoq_value }}
                                                            </b>
                                                        </center>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </section>

                    {{-- Safety Stock --}}
                    <section class="content container-fluid">
                        <div class="content container-fluid">
                            <div class="box box-primary">
                                <div class="box-body">
                                    <h4><b>Reorder Point Analysis</b></h4>
                                    {{ csrf_field() }}
                                    <br>
                                    <table @if($title == 'Detail Analysis') id="add-row-2" @endif class="table table-striped table-bordered table-hover" width="100%" style="text-align: center;overflow-x: auto;">
                                        <thead style="background-color: #fbfbfb;">
                                            <tr>
                                                <th style="vertical-align: middle;" width="5%">
                                                    <center>No</center>
                                                </th>
                                                <th style="vertical-align: middle;" width="30%">
                                                    <center>Products</center>
                                                </th>
                                                <th style="vertical-align: middle;" width="9%">
                                                    <center>Max Daily Sales</center>
                                                </th>
                                                <th style="vertical-align: middle;" width="9%">
                                                    <center>Avg Daily Sales</center>
                                                </th>
                                                <th style="vertical-align: middle;" width="9%">
                                                    <center>Max Lead Time</center>
                                                </th>
                                                <th style="vertical-align: middle;" width="9%">
                                                    <center>Avg Lead Time</center>
                                                </th>
                                                <th style="vertical-align: middle;" width="9%">
                                                    <center>Safety Stock</center>
                                                </th>
                                                <th style="vertical-align: middle;" width="9%">
                                                    <center>Reorder Point</center>
                                                </th>
                                                @if ($title == 'Add Analysis' || $title == 'Edit Analysis')
                                                <th style="vertical-align: middle;" width="11%">
                                                    <center>Action</center>
                                                </th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody id="table_body">
                                        @if($title == 'Edit Analysis' || $title == 'Add Analysis')
                                            @foreach($details as $key=>$detail)
                                            <tr id='{{ $detail->id_product }}'>
                                                <td style="text-align:center;">
                                                    {{  $key+1 }}
                                                </td>
                                                <td style="text-align:left;padding:10px !important;">
                                                    <input type="hidden" value="{{$detail->id_product}}">
                                                    @isset($detail->product_name)
                                                        {{  $detail->product_name }}
                                                    @else
                                                        {{ $detail->product->product_name }}
                                                    @endisset
                                                </td>
                                                <td style="text-align:center;">
                                                    <input type="hidden" id="max_sales_data" value="{{round($details_2[$key]->max_sales,0)}}" readonly required>
                                                    <input type="number" class='form-control numeric' name="max_sales[]" value="{{round($details_2[$key]->max_sales,0)}}" id="max_sales_{{ $detail->id_product }}" readonly required>
                                                </td>
                                                <td style="text-align:center;">
                                                    <input type="hidden" id="avg_sales_data" value="{{round($details_2[$key]->avg_sales,0)}}" readonly required>
                                                    <input type="number" class='form-control numeric' name="avg_sales[]" value="{{round($details_2[$key]->avg_sales,0)}}" id="avg_sales_{{ $detail->id_product }}" readonly required>
                                                </td>
                                                <td style="text-align:center;">
                                                    <input type="number" class='form-control numeric' min='0' name="max_lead_time[]" oninput="calculate_safety_stock({{ $detail->id_product }}, 2)" @isset($details_2[$key]->max_lead_time) value="{{$details_2[$key]->max_lead_time}}" @endisset id="max_lead_time_{{ $detail->id_product }}" required>
                                                </td>
                                                <td style="text-align:center;">
                                                    <input type="number" class='form-control numeric' min='0' name="avg_lead_time[]" oninput="calculate_safety_stock({{ $detail->id_product }}, 2)" @isset($details_2[$key]->avg_lead_time) value="{{$details_2[$key]->avg_lead_time}}" @endisset id="avg_lead_time_{{ $detail->id_product }}" required>
                                                </td>
                                                <td style="text-align:center;">
                                                    <input type="hidden" class='form-control' name="demandpermonthdatas[]" @isset($detail->demandpermonth) value="{{$detail->demandpermonth}}" @else value="{{$detail->demand}}" @endisset id="demandpermonthdata_{{ $detail->id_product }}">
                                                    <input type="number" class='form-control numeric' name="safety_stock[]" @isset($details_2[$key]->safety_stock) value="{{$details_2[$key]->safety_stock}}" @endisset id="safety_stock_{{ $detail->id_product }}" required readonly>
                                                </td>
                                                <td style="text-align:center;">
                                                    <input type="number" class='form-control numeric' name="rop[]" @isset($details_2[$key]->rop) value="{{$details_2[$key]->rop}}" @endisset id="rop_{{ $detail->id_product }}" required readonly>
                                                </td>
                                                <td>
                                                    <center>
                                                        <button type='button' class='btn btn-link btn-simple-danger' onclick="reset_data({{ $detail->id_product }}, 2)" title='Reset'>
                                                            <i style="color:black; font-weight:bold;" class="icon-refresh"></i>
                                                        </button>
                                                    </center>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            @foreach($details as $key=>$detail)
                                                <tr id='{{ $detail->id_product }}'>
                                                    <td style="text-align:left;">
                                                        {{  $key+1 }}
                                                    </td>
                                                    <td style="text-align:left;">
                                                        <input type="hidden" name="id_product" value="{{$detail->id_product}}">
                                                        {{  $details_2[$key]->product->product_name }}
                                                    </td>
                                                    <td>
                                                        <center>
                                                            {{$details_2[$key]->max_sales}}
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            {{$details_2[$key]->avg_sales}}
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            {{$details_2[$key]->max_lead_time}}
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            {{$details_2[$key]->avg_lead_time}}
                                                        </center>
                                                    </td>
                                                    <td style="text-align:right;">
                                                        <center>
                                                            {{ $details_2[$key]->safety_stock }}
                                                        </center>
                                                    </td>
                                                    <td style="text-align:right;">
                                                        <center>
                                                            <b>
                                                                {{ $details_2[$key]->rop }}
                                                            </b>
                                                        </center>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="modal-footer">
                        <div style="float:right;">
                            @if ($title == 'Add Analysis')
                                <div class="col-md-10" style="margin-right: 20px;">
                                    <a href="{{route('admin.analysis.index')}}" type="button" class="btn btn-danger">
                                        <i class="fa fa-arrow-left"></i>&nbsp;
                                        Back
                                    </a>
                                    <button type="submit" class="btn btn-primary" style="margin-left:10px;">
                                        <i class="fa fa-check"></i>&nbsp;
                                        Save
                                    </button>
                                </div>
                            @elseif ($title == 'Edit Analysis')
                                <div class="col-md-10" style="margin-right: 20px;">
                                    <a href="{{route('admin.analysis.index')}}" type="button" class="btn btn-danger">
                                        <i class="fa fa-arrow-left"></i>&nbsp;
                                        Back
                                    </a>
                                    <button type="submit" class="btn btn-primary" style="margin-left:10px;">
                                        <i class="fa fa-check"></i>&nbsp;
                                        Save
                                    </button>
                                </div>
                            @else
                                <div class="col-md-10" style="margin-right: 20px;">
                                    <a href="{{route('admin.analysis.index')}}" type="button" class="btn btn-danger">
                                        <i class="fa fa-arrow-left"></i>&nbsp;
                                        Back
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
            @include('layouts.footer')
            <script src="{{ asset('js/app/table.js') }}"></script>
            <script src="{{ asset('js/app/table_2.js') }}"></script>
            {{-- FUNCTIONS --}}
            <script>

                function reset_data(id, stat){
                    if(stat == 1){
                        $("#holdingcost_"+id).val('');
                        $("#eoq_"+id).val('');
                    }else{
                        $("#max_lead_time_"+id).val('');
                        $("#avg_lead_time_"+id).val('');
                        $("#safety_stock_"+id).val('');
                    }

                }

                function calculate_eoq(id){

                    let setupCost = $("#setupcost_"+id).val();
                        setupCost = setupCost.split("Rp.").pop();
                        setupCost = parseInt(setupCost.split(".").join(''));

                    let holdingCost = $("#holdingcost_"+id).val();
                        holdingCost = holdingCost.split("Rp.").pop();
                        holdingCost = parseInt(holdingCost.split(".").join(''));

                    let demand = $("#demandpermonth_"+id).val();

                    let eoq = Math.sqrt((2 * demand * setupCost) / holdingCost);
                    $("#eoq_"+id).val(eoq.toFixed(2));

                }

                function calculate_safety_stock(id){

                    let max_daily_sales = $("#max_sales_"+id).val();
                    let avg_daily_sales = $("#avg_sales_"+id).val();
                    let max_lead_time = $("#max_lead_time_"+id).val();
                    let avg_lead_time = $("#avg_lead_time_"+id).val();
                    let demand = $("#demandpermonthdata_"+id).val();
                    let rop = 0;

                    let safety_stock = (max_daily_sales*max_lead_time) - (avg_daily_sales*avg_lead_time);

                    if(safety_stock < 0){
                        safety_stock = 0;
                    }else{
                        rop = (avg_lead_time * demand) + safety_stock;
                    }

                    $("#rop_"+id).val(rop);
                    $("#safety_stock_"+id).val(safety_stock);

                }


            </script>
        </div>
    </div>
</body>
</html>
