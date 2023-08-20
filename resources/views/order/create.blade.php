<!DOCTYPE html>
<html lang="en">
@include('layouts.head')
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

                {{-- ADMIN SECTION --}}
                @if(Auth::guard('admin')->check())
                <section class="content container-fluid">
                    <div class="content container-fluid">
                        <div class="box box-primary">
                            <div class="box-body">
                                <form id="form_add" action="{{ route('admin.order.' . $url) }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="col-md-12">No Invoice <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" name="invoice" id="invoice" class="form-control" placeholder="No Invoice Order" @if(isset($orders)) value="{{$orders->invoice}}" @endisset autocomplete="off" required {{$disabled_}}>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="col-md-12">Source Payment <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <select name="source_pay" id="source_pay" class="form-control" required {{$disabled_}}>
                                                    <option value="" style="display: none;" selected="">- Choose Source -
                                                    </option>
                                                    @foreach ($sources as $source)
                                                        <option @if (isset($orders))
                                                        <?php if ($orders->source_id == $source->id) {
                                                            echo 'selected';
                                                        } ?> @endisset
                                                        value="{{ $source->id }}">{{ $source->source }}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="col-md-12">Type Selling <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <select name="type_buy" id="type_buy" class="form-control" required {{$disabled_}}>
                                                    <option value="" style="display: none;" selected="">- Choose Type -
                                                    </option>
                                                    @foreach ($types as $type)
                                                        <option @if (isset($orders))
                                                        <?php if ($orders->type_buy == $type->id) {
                                                            echo 'selected';
                                                        } ?> @endisset
                                                        value="{{ $type->id }}">{{ $type->type_buy }}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="col-md-12">Date Order <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="date" max="{{date('Y-m-d')}}" name="tgl" id="tgl" class="form-control tgl_date"
                                                    autocomplete="off" data-date="" data-date-format="DD/MM/YYYY"
                                                    @isset($orders) value="{{ $orders->date_order}}" @endisset
                                                    required {{$disabled_}}>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="col-md-12">Entry Price <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" oninput="entry_change()" name="entry_price" id="entry_price"
                                                    @if (isset($orders)) value="{{ $orders->entry_price }}" @endisset class="form-control numeric" autocomplete="off" required="" {{$disabled_}}
                                                    style="width:100%">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="col-md-12">Total Profit  <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" name="cal_profit" id="cal_profit"
                                                    @if (isset($orders)) value="{{ $orders->profit }}" @endisset class="form-control numeric" autocomplete="off" required {{$disabled_}} readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="col-md-12">Platform Fee <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" name="cal_tax" id="cal_tax" class="form-control numeric"
                                                    @if (isset($orders)) value="{{ $orders->platform_fee }}" @endisset autocomplete="off" required {{$disabled_}} readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    @if ($title == 'Add Order' || $title == 'Edit Order')
                                    <div class="row">
                                        <div class="col-md-12" >
                                            <div style="float: right; margin-right:20px;">
                                                <a style="color:white;" class="btn btn-primary" id="btn-collapse"><i class="fa fa-plus"></i> Add Product</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="collapse" class="panel-collapse collapse @isset($orders) show @endisset">
                                                <hr><br>
                                                @if ($title == 'Add Order' || $title == 'Edit Order')
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="col-md-12">Product <span style="color: red;">*</span></label>
                                                            <div class="col-md-12">
                                                                <select name="prods" id="prods" onchange="getDetails()" class="form-control"
                                                                    {{$disabled_}}>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="col-md-12">Qty <span style="color: red;">*</span></label>
                                                            <div class="col-md-12">
                                                                <input type="hidden" min="0" name="stock" id="stock" class="form-control"
                                                                    required="" {{$disabled_}}>
                                                                <input type="number" min="0" name="qty" id="qty" oninput="price_change()" class="form-control"
                                                                    required="" {{$disabled_}}>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="col-md-12">Base Price <span style="color: red;">*</span></label>
                                                            <div class="col-md-12">
                                                                <input type="hidden" id="base_price_">
                                                                <input type="text" id="base_price" class="form-control numeric"
                                                                    autocomplete="off" required="" style="width:100%" {{$disabled_}} readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="col-md-12">Selling Price <span style="color: red;">*</span></label>
                                                            <div class="col-md-12">
                                                                <input type="hidden" id="sell_price_">
                                                                <input type="text" id="sell_price" class="form-control numeric"
                                                                    autocomplete="off" required="" style="width:100%" {{$disabled_}} readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row" style="float:right; margin-right:20px; margin-bottom:20px;">
                                                        <div class="col-md-12" >
                                                            <button type="button" class="btn btn-primary" id="btn_tambahToTable">
                                                                <i class="fa fa-save"></i> Save Product
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                <br>
                                                <table id="dt-detail" class="table table-striped table-bordered table-hover" width="100%" style="text-align: center;">
                                                    <thead style="background-color: #fbfbfb;">
                                                        <tr>
                                                            <th style="vertical-align: middle;">
                                                                <center>Products</center>
                                                            </th>
                                                            <th style="vertical-align: middle;" width="15%">
                                                                <center>Qty</center>
                                                            </th>
                                                            <th style="vertical-align: middle;">
                                                                <center>Base Price</center>
                                                            </th>
                                                            <th style="vertical-align: middle;">
                                                                <center>Selling Price</center>
                                                            </th>
                                                            @if ($title == 'Add Order' || $title == 'Edit Order')
                                                            <th style="vertical-align: middle;" width="15%">
                                                                <center>Action</center>
                                                            </th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_body">
                                                    @isset($orders)
                                                        @foreach($details_order as $details)
                                                        <tr>
                                                            <td style="text-align:left;">
                                                                {{  $details->product->product_name  }}
                                                            </td>
                                                            <td style="text-align:right;">
                                                                {{  $details->qty  }}
                                                            </td>
                                                            <td style="text-align:right;">
                                                                Rp. {{number_format(($details->qty * $details->base_price_save),0,',','.')}}
                                                            </td>
                                                            <td style="text-align:right;">
                                                                Rp. {{number_format($details->qty * $details->selling_price_save,0,',','.')}}
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    @endisset
                                                    </tbody>
                                                    <tbody >
                                                        <tr>
                                                            <td colspan="2">
                                                                <b>TOTAL</b>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control numeric" @if (isset($orders)) value="{{ $orders->total_base_price }}" @endisset style='width:100px !important; height:25px !important; text-align:center;' name="base_price" id="total_base_price" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control numeric" @if (isset($orders)) value="{{ $orders->total_sell_price }}" @endisset style='width:100px !important; height:25px !important; text-align:center;' name="sell_price" id="total_sell_price" readonly>
                                                            </td>
                                                            @if ($title == 'Add Order' || $title == 'Edit Order')
                                                            <td>
                                                                <button type='button' class='btn btn-link' onclick="removedata()">
                                                                    <i style="color:black; font-weight:bold;" class="icon-refresh"></i>
                                                                </button>
                                                            </td>
                                                            @endif
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                @if(isset($orders))
                                                <br>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label class="col-md-12">
                                                            <i><b>Created By</b></i>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <label for="">
                                                                <i><b>{{$orders->createdby->name}}</b></i>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="">
                                                                <i><b>{{date('l, j F Y  h:i A', strtotime($orders->created_at))}}</b></i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                @endif
                                                <div class="modal-footer">
                                                    <div style="float:right;">
                                                        @if ($title == 'Add Order')
                                                            <div class="col-md-10" style="margin-right: 20px;">
                                                                <a href="{{route('admin.order.index')}}" type="button" class="btn btn-danger">
                                                                    <i class="fa fa-arrow-left"></i>&nbsp;
                                                                    Back
                                                                </a>
                                                                <button type="submit" class="btn btn-primary" style="margin-left:10px;">
                                                                    <i class="fa fa-check"></i>&nbsp;
                                                                    Save
                                                                </button>
                                                            </div>
                                                        @elseif ($title == 'Edit Order')
                                                            <div class="col-md-10" style="margin-right: 20px;">
                                                                <a href="{{route('admin.order.index')}}" type="button" class="btn btn-danger">
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
                                                                <a href="{{route('admin.order.index')}}" type="button" class="btn btn-danger">
                                                                    <i class="fa fa-arrow-left"></i>&nbsp;
                                                                    Back
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
                @else

                {{-- USER SECTION --}}
                <section class="content container-fluid">
                    <div class="content container-fluid">
                        <div class="box box-primary">
                            <div class="box-body">
                                <form id="form_add" action="{{ route('user.order.' . $url) }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="col-md-12">No Invoice <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" name="invoice" id="invoice" class="form-control" placeholder="No Invoice Order" @if(isset($orders)) value="{{$orders->invoice}}" @endisset autocomplete="off" required {{$disabled_}}>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="col-md-12">Source Payment <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <select name="source_pay" id="source_pay" class="form-control" required {{$disabled_}}>
                                                    <option value="" style="display: none;" selected="">- Choose Source -
                                                    </option>
                                                    @foreach ($sources as $source)
                                                        <option @if (isset($orders))
                                                        <?php if ($orders->source_id == $source->id) {
                                                            echo 'selected';
                                                        } ?> @endisset
                                                        value="{{ $source->id }}">{{ $source->source }}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="col-md-12">Type Selling <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <select name="type_buy" id="type_buy" class="form-control" required {{$disabled_}}>
                                                    <option value="" style="display: none;" selected="">- Choose Type -
                                                    </option>
                                                    @foreach ($types as $type)
                                                        <option @if (isset($orders))
                                                        <?php if ($orders->type_buy == $type->id) {
                                                            echo 'selected';
                                                        } ?> @endisset
                                                        value="{{ $type->id }}">{{ $type->type_buy }}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-12">Date Order <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="date" max="{{date('Y-m-d')}}" name="tgl" id="tgl" class="form-control tgl_date"
                                                    autocomplete="off" data-date="" data-date-format="DD/MM/YYYY"
                                                    @isset($orders) value="{{ $orders->date_order}}" @endisset
                                                    required {{$disabled_}}>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-md-12">Entry Price <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" oninput="entry_change()" name="entry_price" id="entry_price"
                                                    @if (isset($orders)) value="{{ $orders->entry_price }}" @endisset class="form-control numeric" autocomplete="off" required="" {{$disabled_}}
                                                    style="width:100%">
                                            </div>
                                        </div>
                                        <input type="hidden" name="cal_profit" id="cal_profit"
                                            @if (isset($orders)) value="{{ $orders->profit }}" @endisset class="form-control numeric" autocomplete="off" required {{$disabled_}} readonly>
                                        <input type="hidden" name="cal_tax" id="cal_tax" class="form-control numeric"
                                            @if (isset($orders)) value="{{ $orders->platform_fee }}" @endisset autocomplete="off" required {{$disabled_}} readonly>
                                    </div>
                                    <br>
                                    @if ($title == 'Add Order' || $title == 'Edit Order')
                                    <div class="row">
                                        <div class="col-md-12" >
                                            <div style="float: right; margin-right:20px;">
                                                <a style="color:white;" class="btn btn-primary" id="btn-collapse"><i class="fa fa-plus"></i> Add Product</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="collapse" class="panel-collapse collapse @isset($orders) show @endisset">
                                                <hr><br>
                                                @if ($title == 'Add Order' || $title == 'Edit Order')
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <label class="col-md-12">Product <span style="color: red;">*</span></label>
                                                            <div class="col-md-12">
                                                                <select name="prods" id="prods" onchange="getDetails()" class="form-control"
                                                                    {{$disabled_}}>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="col-md-12">Qty <span style="color: red;">*</span></label>
                                                            <div class="col-md-12">
                                                                <input type="hidden" min="0" name="stock" id="stock" class="form-control"
                                                                    srequired="" {{$disabled_}}>
                                                                <input type="number" min="0" name="qty" id="qty" oninput="price_change()" class="form-control"
                                                                    required="" {{$disabled_}}>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" id="base_price_">
                                                        <input type="hidden" id="base_price" class="form-control numeric"
                                                            autocomplete="off" required="" style="width:100%" {{$disabled_}} readonly>
                                                        <div class="col-md-5">
                                                            <label class="col-md-12">Selling Price <span style="color: red;">*</span></label>
                                                            <div class="col-md-12">
                                                                <input type="hidden" id="sell_price_">
                                                                <input type="text" id="sell_price" class="form-control numeric"
                                                                    autocomplete="off" required="" style="width:100%" {{$disabled_}} readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row" style="float:right; margin-right:20px; margin-bottom:20px;">
                                                        <div class="col-md-12" >
                                                            <button type="button" class="btn btn-primary" id="btn_tambahToTableUser">
                                                                <i class="fa fa-save"></i> Save Product
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                <br>
                                                <table id="dt-detail" class="table table-striped table-bordered table-hover" width="100%" style="text-align: center;">
                                                    <thead style="background-color: #fbfbfb;">
                                                        <tr>
                                                            <th style="vertical-align: middle;">
                                                                <center>Products</center>
                                                            </th>
                                                            <th style="vertical-align: middle;" width="15%">
                                                                <center>Qty</center>
                                                            </th>
                                                            <th style="vertical-align: middle;">
                                                                <center>Selling Price</center>
                                                            </th>
                                                            @if ($title == 'Add Order' || $title == 'Edit Order')
                                                            <th style="vertical-align: middle;" width="15%">
                                                                <center>Action</center>
                                                            </th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_body">
                                                    @isset($orders)
                                                        @foreach($details_order as $details)
                                                        <tr>
                                                            <td style="text-align:left;">
                                                                {{  $details->product->product_name  }}
                                                            </td>
                                                            <td style="text-align:right;">
                                                                {{  $details->qty  }}
                                                            </td>
                                                            <td style="text-align:right;">
                                                                Rp. {{number_format($details->qty * $details->selling_price_save,0,',','.')}}
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    @endisset
                                                    </tbody>
                                                    <tbody >
                                                        <tr>
                                                            <td colspan="2"><b>TOTAL</b></td>
                                                            <td>
                                                                <input type="hidden" class="form-control numeric" @if (isset($orders)) value="{{ $orders->total_base_price }}" @endisset style='width:100px !important; height:25px !important; text-align:center;' name="base_price" id="total_base_price" readonly>
                                                                <input type="text" class="form-control numeric" @if (isset($orders)) value="{{ $orders->total_sell_price }}" @endisset style='width:100px !important; height:25px !important; text-align:center;' name="sell_price" id="total_sell_price" readonly>
                                                            </td>
                                                            @if ($title == 'Add Order' || $title == 'Edit Order')
                                                            <td><button type='button' class='btn btn-link' onclick="removedata()"><i style="color:black; font-weight:bold;" class="icon-refresh"></i></button></td>
                                                            @endif
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                @if(isset($orders))
                                                <br>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-2"></div>
                                                        <label class="col-md-2"> <i><b>Created By</b></i> </label>
                                                        <div class="col-md-2">
                                                            <label for=""><i><b>{{$orders->createdby->name}}</b></i></label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for=""><i><b>{{$orders->created_at}}</b></i></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                @endif
                                                <div class="modal-footer">
                                                    <div style="float:right;">
                                                        @if ($title == 'Add Order')
                                                            <div class="col-md-10" style="margin-right: 20px;">
                                                                <a href="{{route('user.order.index')}}" type="button" class="btn btn-danger">
                                                                    <i class="fa fa-arrow-left"></i>&nbsp;
                                                                    Back
                                                                </a>
                                                                <button type="submit" class="btn btn-primary" style="margin-left:10px;">
                                                                    <i class="fa fa-check"></i>&nbsp;
                                                                    Save
                                                                </button>
                                                            </div>
                                                        @elseif ($title == 'Edit Order')
                                                            <div class="col-md-10" style="margin-right: 20px;">
                                                                <a href="{{route('user.order.index')}}" type="button" class="btn btn-danger">
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
                                                                <a href="{{route('user.order.index')}}" type="button" class="btn btn-danger">
                                                                    <i class="fa fa-arrow-left"></i>&nbsp;
                                                                    Back
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
                @endif
            </div>
            @include('layouts.footer')
            <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

            {{-- FUNCTIONS --}}
            <script>
                getProds();

                $('#prods').select2();
                $('.select2-container--default').css('width', '100%');
                $('.select2-selection--single ').css('border', 'none');

                function getProds(){

                    var token = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        @if(Auth::guard('admin')->check())
                            url: "{{ route('admin.order.getProds') }}",
                        @else
                            url: "{{ route('user.order.getProds') }}",
                        @endif
                        data: {
                            '_token' : token
                        },
                        success: function(data) {
                            $('#prods').append("<option value='' style='display:none;' disabled>Choose Product</option>");
                            data.forEach(function(item){
                                $('#prods').append($('<option>', {
                                    value: item.id,
                                    text: item.product_name
                                }));
                            });
                        }
                    });

                }

                function getDetails() {

                    var token = $('meta[name="csrf-token"]').attr('content');
                    var id_prods = $("#prods").val();

                    $.ajax({
                        type: 'POST',
                        @if(Auth::guard('admin')->check())
                            url: "{{ route('admin.order.getDetailProds') }}",
                        @else
                            url: "{{ route('user.order.getDetailProds') }}",
                        @endif
                        data: {
                            '_token' : token,
                            'id_prod': id_prods
                        },
                        success: function(data) {
                            $('#qty').removeAttr('disabled');

                            let id_product = data.id
                            let base_price = data.base_price;
                            let sell_price = data.selling_price;
                            let max_qty = data.stock;

                            $('#qty').val(1);

                            if($('#product_id_'+id_product).length>0){
                                let qty_data = $('#qty_'+id_product).val();
                                max_qty = max_qty-qty_data;
                                $("#stock").val(max_qty);
                            }else{
                                $("#stock").val(max_qty);
                            }

                            $('#base_price_').val(base_price);
                            $('#base_price').val(base_price);

                            $('#sell_price_').val(sell_price);
                            $('#sell_price').val(sell_price);

                            @if($title == 'Add Order')
                            let input = document.getElementById("qty");
                            input.setAttribute("min",1);
                            input.setAttribute("max",max_qty);
                            @endif
                        }
                    });
                }

                function price_change(){

                    let qty = $("#qty").val();
                    let max_stock = $("#stock").val();

                    let base_price = $("#base_price_").val();
                    let sell_price = $("#sell_price_").val();

                    let base_price_old = $("#base_price_old").val();
                    let sell_price_old = $("#sell_price_old").val();

                    //Calculation
                    if(sell_price != 0){
                        if(qty.length <= max_stock.length) {

                            if(qty > max_stock && qty.length >= max_stock.length){

                                $('#save_data').attr('disabled', 'disabled');
                                alert("Item Quantity Exceed Stock Limit!");
                                $("#qty").val(1);
                                $("#base_price").val(base_price);
                                $("#sell_price").val(sell_price);

                            }else{

                                $('#save_data').removeAttr('disabled');
                                let result_base = base_price * qty;
                                let result_sell = sell_price * qty;
                                $("#sell_price").val(result_sell);
                                $("#base_price").val(result_base);

                            }

                        }else{

                            $('#save_data').attr('disabled', 'disabled');
                            alert("Item Quantity Exceed Stock Limit!");
                            $("#qty").val(1);
                            $("#base_price").val(base_price);
                            $("#sell_price").val(sell_price);

                        }

                    }else{

                        let result_base = base_price_old * qty;
                        let result_sell = sell_price_old * qty;
                        $("#base_price").val(result_base);
                        $("#sell_price").val(result_sell);

                    }

                }

                function price_update(e){

                    let id_prods = $('#product_id_'+e+'').val();
                    let prods = $('#product_name_'+e+'').text();

                    let qty = $("#qty_"+e).val();
                    let max_stock = $("#max_stock_"+e).val();

                    let base_price_table = $("#base_price_data_"+e).val();
                    let sell_price_table = $("#sell_price_data_"+e).val();

                    if(qty == max_stock){

                        $("#prods option[value='"+e+"']").remove();

                    }

                    // //Calculation
                    if(sell_price != 0){

                        if(qty.length <= max_stock.length) {

                            if(qty > max_stock && qty.length >= max_stock.length){

                                $('#save_data').attr('disabled', 'disabled');
                                alert("Item Quantity Exceed Stock Limit!");
                                $("#qty_"+e).val(1);
                                $("#base_price_"+e).val(base_price_table);
                                $("#sell_price_"+e).val(sell_price_table);

                            }else{

                                $('#save_data').removeAttr('disabled');

                                let result_base = base_price_table * qty;
                                let result_sell = sell_price_table * qty;

                                $("#sell_price_"+e).val(result_sell);
                                $("#sell_price_"+e).inputmask({
                                    alias:"numeric",
                                    prefix: "Rp.",
                                    digits:0,
                                    repeat:20,
                                    digitsOptional:false,
                                    decimalProtect:true,
                                    groupSeparator:".",
                                    placeholder: '0',
                                    radixPoint:",",
                                    radixFocus:true,
                                    autoGroup:true,
                                    autoUnmask:false,
                                    clearMaskOnLostFocus: false,
                                    onBeforeMask: function (value, opts) {
                                        return value;
                                    },
                                    removeMaskOnSubmit:true
                                });


                                $("#base_price_"+e).val(result_base);
                                $("#base_price_"+e).inputmask({
                                    alias:"numeric",
                                    prefix: "Rp.",
                                    digits:0,
                                    repeat:20,
                                    digitsOptional:false,
                                    decimalProtect:true,
                                    groupSeparator:".",
                                    placeholder: '0',
                                    radixPoint:",",
                                    radixFocus:true,
                                    autoGroup:true,
                                    autoUnmask:false,
                                    clearMaskOnLostFocus: false,
                                    onBeforeMask: function (value, opts) {
                                        return value;
                                    },
                                    removeMaskOnSubmit:true
                                });

                            }

                        }else{

                            $('#save_data').attr('disabled', 'disabled');
                            alert("Item Quantity Exceed Stock Limit!");
                            $("#qty_"+e).val(1);
                            $("#base_price"+e).val(base_price_table);
                            $("#sell_price_"+e).val(sell_price_table);

                        }

                    }else{

                        let result_base = base_price_old * qty;
                        let result_sell = sell_price_old * qty;
                        $("#base_price").val(result_base);
                        $("#sell_price").val(result_sell);

                    }

                    allprice();

                }

                function removedata(id){

                    if(id){

                       let prods = $('#product_name_'+id+'').text();
                       let id_prods = $('#product_id_'+id+'').val();
                       let max_stock = $('#max_stock_'+id+'').val();
                       let qty = $('#qty_'+id+'').val();
                       let tbl_length = $('#table_body').children('tr').length;

                        if(qty == max_stock){

                            $('#prods').append($('<option>', {
                                value: id_prods,
                                text: prods
                            }));

                        }

                        document.getElementById(id).remove();

                        if(tbl_length == 1){

                                allprice();
                                resetprice();

                        }else{

                                allprice();

                        }

                    }else{

                        $('#table_body').empty();
                        $('#prods').empty();
                        $('#total_base_price').val(0);
                        $('#total_sell_price').val(0);

                        getProds();
                        allprice();
                        resetprice();

                    }

                }

                function allprice(){

                    let total_base = 0;
                    let total_sell = 0;

                    $("input[name='base_price_arr[]']").map(function(){

                        var base = $(this).val();
                        base = base.split("Rp.").pop();
                        base = base.split(".").join('');
                        total_base += parseInt(base);

                    });

                    $("input[name='sell_price_arr[]']").map(function(){

                        var sell = $(this).val();
                        sell = sell.split("Rp.").pop();
                        sell = sell.split(".").join('');
                        total_sell += parseInt(sell);

                    });

                    $('#total_base_price').val(total_base);
                    $('#total_sell_price').val(total_sell);

                    summaryprice();

                }

                function summaryprice(){

                    let total_entry = 0;
                    let total_base = 0;
                    let total_sell = 0;

                    let entry = $('#entry_price').val();
                    entry = entry.split("Rp.").pop();
                    entry = entry.split(".").join('');
                    total_entry += parseInt(entry);


                    let base = $('#total_base_price').val();
                    base = base.split("Rp.").pop();
                    base = base.split(".").join('');
                    total_base += parseInt(base);

                    let sell = $('#total_sell_price').val();
                    sell = sell.split("Rp.").pop();
                    sell = sell.split(".").join('');
                    total_sell += parseInt(sell);

                    platform_fee = total_sell - total_entry;
                    total_profit = total_entry - total_base;

                    if(total_profit < 0){

                        swal({
                            title: "",
                            text: "Harap Sesuaikan Data Dengan Benar!",
                            icon: "error"
                            // dangerMode: true,
                        })

                        resetprice();
                        // removedata();

                    }else{

                        if(platform_fee < 0){

                            $('#cal_tax').val(0);
                            $('#cal_profit').val(total_profit);

                        }else{

                            $('#cal_tax').val(platform_fee);
                            $('#cal_profit').val(total_profit);

                        }

                    }

                }

                function entry_change(){

                    let total_entry = 0;
                    let total_base = 0;
                    let total_sell = 0;

                    let entry = $('#entry_price').val();
                    entry = entry.split("Rp.").pop();
                    entry = entry.split(".").join('');
                    total_entry += parseInt(entry);


                    let base = $('#total_base_price').val();
                    base = base.split("Rp.").pop();
                    base = base.split(".").join('');
                    total_base += parseInt(base);

                    let sell = $('#total_sell_price').val();
                    sell = sell.split("Rp.").pop();
                    sell = sell.split(".").join('');
                    total_sell += parseInt(sell);

                    platform_fee = total_sell - total_entry;
                    total_profit = total_entry - total_base;

                    if(total_profit < 0){

                        $('#cal_tax').val(0);
                        $('#cal_profit').val(0);

                    }else{

                        if(platform_fee < 0){

                            $('#cal_tax').val(0);
                            $('#cal_profit').val(total_profit);

                        }else{

                            $('#cal_tax').val(platform_fee);
                            $('#cal_profit').val(total_profit);

                        }

                    }

                }

                function resetprice(){

                    $('#cal_tax').val(0);
                    $('#cal_profit').val(0);

                }

            </script>

            {{-- JQUERY FUNCTION --}}
            <script>
                $(document).ready(function() {

                    $("#btn-collapse").click(function(){
                        let invoice = $('#invoice').val();
                        let source = $('#source_pay').val();
                        let tgl = $('#tgl').val();
                        let entry_price = $('#entry_price').val();

                        if(invoice == '' && source == '' && tgl == '' && entry_price == ''){

                            AlertData();

                        }else{

                            $("#collapse").collapse('show');
                            $("html, body").animate({
                                scrollTop: $(
                                'html, body').get(0).scrollHeight
                            }, 2000);

                        }

                    });

                    $('#btn_tambahToTable').on('click', function() {
                        var table_body = $('#tabel_body');

                        let id_product = $('#prods').val();

                        let qty = parseInt($('#qty').val());
                        let max_stock = $('#stock').val();

                        let base_price = $('#base_price_').val();
                        let sell_price = $('#sell_price_').val();

                        let base = $('#base_price').val();
                        let sell = $('#sell_price').val();

                        var data = $('input[name^="product_id[]"]').map(function(){
                                    return $(this).val();
                                }).get();

                        if(id_product != ""){

                            let length = $('#product_id_'+id_product).length;

                            if(data.length > 0 && length > 0){

                                let id_prods = $('#product_id_'+id_product).val();
                                max_stock = $('#max_stock_'+id_product).val();
                                let qty_prods = parseInt($('#qty_'+id_prods).val());
                                let result_qty = qty_prods+qty;

                                if(result_qty == max_stock){

                                    $("#prods option[value='"+id_product+"']").remove();

                                }

                                $('#qty_'+id_prods).val(result_qty);

                                $('#base_price_'+id_prods).val(result_qty*base_price);
                                $('#base_price_'+id_prods).inputmask({
                                    alias:"numeric",
                                    prefix: "Rp.",
                                    digits:0,
                                    repeat:20,
                                    digitsOptional:false,
                                    decimalProtect:true,
                                    groupSeparator:".",
                                    placeholder: '0',
                                    radixPoint:",",
                                    radixFocus:true,
                                    autoGroup:true,
                                    autoUnmask:false,
                                    clearMaskOnLostFocus: false,
                                    onBeforeMask: function (value, opts) {
                                        return value;
                                    },
                                    removeMaskOnSubmit:true
                                });

                                $('#sell_price_'+id_prods).val(result_qty*sell_price);
                                $("#sell_price_"+id_prods).inputmask({
                                    alias:"numeric",
                                    prefix: "Rp.",
                                    digits:0,
                                    repeat:20,
                                    digitsOptional:false,
                                    decimalProtect:true,
                                    groupSeparator:".",
                                    placeholder: '0',
                                    radixPoint:",",
                                    radixFocus:true,
                                    autoGroup:true,
                                    autoUnmask:false,
                                    clearMaskOnLostFocus: false,
                                    onBeforeMask: function (value, opts) {
                                        return value;
                                    },
                                    removeMaskOnSubmit:true
                                });

                                $('#prods').val("");

                                $('#qty').val("");
                                $('#qty').attr('disabled','disabled');

                                $('#base_price').val("");
                                $('#sell_price').val("");

                            }else{

                                var product_name = $('#prods option:selected').text();

                                if(qty == max_stock){
                                    $("#prods option[value='"+id_product+"']").remove();
                                }

                                $('#table_body').append("<tr id='"+id_product+"'>"+
                                "<td style='text-align:left;'><input type='hidden' name='product_id[]' id='product_id_"+id_product+"' value='"+id_product+"' readonly><span id='product_name_"+id_product+"'>"+product_name+"</span></td>"+
                                "<input type='hidden' name='max_stock[]' value='"+max_stock+"' id='max_stock_"+id_product+"' readonly>"+
                                "<td><center><input type='number' style='width:100px !important; height:25px !important; text-align:center;' min=0 max='"+max_stock+"' class='form-control' name='qty[]' id='qty_"+id_product+"' value='"+qty+"' oninput ='price_update("+id_product+")'></center></td>"+
                                "<input type='hidden' name='base_price_data[]' id='base_price_data_"+id_product+"' value='"+base_price+"'>"+
                                "<td><center><input type='text' style='width:100px !important; height:25px !important; text-align:center;' class='form-control numeric' name='base_price_arr[]' id='base_price_"+id_product+"' value='"+base+"' readonly></center></td>"+
                                "<input type='hidden' name='sell_price_data[]' id='sell_price_data_"+id_product+"' value='"+sell_price+"'>"+
                                "<td><center><input type='text' style='width:100px !important; height:25px !important; text-align:center;' class='form-control numeric' name='sell_price_arr[]' id='sell_price_"+id_product+"' value='"+sell+"' readonly></center></td>"+
                                "<td><center><button type='button' class='btn btn-link btn-simple-danger' onclick='removedata("+id_product+")' title='Hapus'><i class='fa fa-trash' style='color:red;''></i></button></center></td>"+
                                "</tr>");

                                $('#prods').val("");
                                $('#qty').val("");
                                $('#qty').attr('disabled','disabled');
                                $('#base_price').val("");
                                $('#sell_price').val("");

                                $("html, body").animate({
                                    scrollTop: $(
                                    'html, body').get(0).scrollHeight
                                }, 2000);

                            }

                            allprice();

                        }else{
                            AlertData();
                        }

                    });

                    $('#btn_tambahToTableUser').on('click', function() {
                        var table_body = $('#tabel_body');

                        let id_product = $('#prods').val();

                        let qty = parseInt($('#qty').val());
                        let max_stock = $('#stock').val();

                        let base_price = $('#base_price_').val();
                        let sell_price = $('#sell_price_').val();

                        let base = $('#base_price').val();
                        let sell = $('#sell_price').val();

                        var data = $('input[name^="product_id[]"]').map(function(){
                                    return $(this).val();
                                }).get();

                        if(id_product != ""){

                            let length = $('#product_id_'+id_product).length;

                            if(data.length > 0 && length > 0){

                                let id_prods = $('#product_id_'+id_product).val();
                                max_stock = $('#max_stock_'+id_product).val();
                                let qty_prods = parseInt($('#qty_'+id_prods).val());
                                let result_qty = qty_prods+qty;

                                if(result_qty == max_stock){

                                    $("#prods option[value='"+id_product+"']").remove();

                                }

                                $('#qty_'+id_prods).val(result_qty);

                                $('#base_price_'+id_prods).val(result_qty*base_price);
                                $('#base_price_'+id_prods).inputmask({
                                    alias:"numeric",
                                    prefix: "Rp.",
                                    digits:0,
                                    repeat:20,
                                    digitsOptional:false,
                                    decimalProtect:true,
                                    groupSeparator:".",
                                    placeholder: '0',
                                    radixPoint:",",
                                    radixFocus:true,
                                    autoGroup:true,
                                    autoUnmask:false,
                                    clearMaskOnLostFocus: false,
                                    onBeforeMask: function (value, opts) {
                                        return value;
                                    },
                                    removeMaskOnSubmit:true
                                });

                                $('#sell_price_'+id_prods).val(result_qty*sell_price);
                                $("#sell_price_"+id_prods).inputmask({
                                    alias:"numeric",
                                    prefix: "Rp.",
                                    digits:0,
                                    repeat:20,
                                    digitsOptional:false,
                                    decimalProtect:true,
                                    groupSeparator:".",
                                    placeholder: '0',
                                    radixPoint:",",
                                    radixFocus:true,
                                    autoGroup:true,
                                    autoUnmask:false,
                                    clearMaskOnLostFocus: false,
                                    onBeforeMask: function (value, opts) {
                                        return value;
                                    },
                                    removeMaskOnSubmit:true
                                });

                                $('#prods').val("");

                                $('#qty').val("");
                                $('#qty').attr('disabled','disabled');

                                $('#base_price').val("");
                                $('#sell_price').val("");

                            }else{

                                var product_name = $('#prods option:selected').text();

                                if(qty == max_stock){
                                    $("#prods option[value='"+id_product+"']").remove();
                                }

                                $('#table_body').append("<tr id='"+id_product+"'>"+
                                "<td style='text-align:left;'><input type='hidden' name='product_id[]' id='product_id_"+id_product+"' value='"+id_product+"' readonly><span id='product_name_"+id_product+"'>"+product_name+"</span></td>"+
                                "<input type='hidden' name='max_stock[]' value='"+max_stock+"' id='max_stock_"+id_product+"' readonly>"+
                                "<td><center><input type='number' style='width:100px !important; height:25px !important; text-align:center;' min=0 max='"+max_stock+"' class='form-control' name='qty[]' id='qty_"+id_product+"' value='"+qty+"' oninput ='price_update("+id_product+")'></center></td>"+
                                "<input type='hidden' name='base_price_data[]' id='base_price_data_"+id_product+"' value='"+base_price+"'>"+
                                "<input type='hidden' style='width:100px !important; height:25px !important; text-align:center;' class='form-control numeric' name='base_price_arr[]' id='base_price_"+id_product+"' value='"+base+"' readonly>"+
                                "<input type='hidden' name='sell_price_data[]' id='sell_price_data_"+id_product+"' value='"+sell_price+"'>"+
                                "<td><center><input type='text' style='width:100px !important; height:25px !important; text-align:center;' class='form-control numeric' name='sell_price_arr[]' id='sell_price_"+id_product+"' value='"+sell+"' readonly></center></td>"+
                                "<td><center><button type='button' class='btn btn-link btn-simple-danger' onclick='removedata("+id_product+")' title='Hapus'><i class='fa fa-trash' style='color:red;''></i></button></center></td>"+
                                "</tr>");

                                $('#prods').val("");
                                $('#qty').val("");
                                $('#qty').attr('disabled','disabled');
                                $('#base_price').val("");
                                $('#sell_price').val("");

                                $("html, body").animate({
                                    scrollTop: $(
                                    'html, body').get(0).scrollHeight
                                }, 2000);

                            }

                            allprice();

                        }else{
                            AlertData();
                        }

                    });

                    $("#tgl_date").on("change", function() {

                        if (this.value == "") {

                            this.setAttribute("data-date", "DD-MM-YYYY")

                        } else {

                            this.setAttribute(
                                "data-date",
                                moment(this.value, "dd/mm/yyyy")
                                .format(this.getAttribute("data-date-format"))
                            )

                        }

                    }).trigger("change");

                });
            </script>
        </div>
    </div>
</body>
</html>
