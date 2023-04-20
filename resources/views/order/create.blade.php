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
                <section class="content container-fluid">
                    <section class="content container-fluid">
                        <div class="box box-primary">
                            <div class="box-body create">
                                @if(Auth::guard('admin')->check())
                                <form id="form_add" action="{{ route('admin.order.' . $url) }}" method="POST" enctype="multipart/form-data">
                                @else
                                <form id="form_add" action="{{ route('user.order.' . $url) }}" method="POST" enctype="multipart/form-data">
                                @endif
                                    {{ csrf_field() }}
                                    <br>
                                    <input type="hidden" name="type_order" id="type_order" class="form-control" autocomplete="off" value="{{$type}}" required {{$disabled_}}>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label class="col-md-12">No Invoice <span style="color: red;">*</span></label>
                                            <div class="col-md-12">                          
                                                <input type="text" name="invoice" id="invoice" class="form-control" placeholder="No Invoice Order" @if(isset($orders)) value="{{$orders->invoice}}" @endisset autocomplete="off" required {{$disabled_}}>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="col-md-12">Source Payment <span style="color: red;">*</span></label>
                                            <div class="col-md-12">                          
                                                <select name="source_pay" id="source_pay" class="form-control" required {{$disabled_}}>
                                                    <option value="" style="display: none;" selected="">- Choose Sources -
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
                                            <label class="col-md-12">Date Order <span style="color: red;">*</span></label>
                                            <div class="col-md-12">                          
                                                <input type="date" name="tgl" id="tgl" class="form-control tgl_date"
                                                    autocomplete="off" data-date="" data-date-format="DD/MM/YYYY"
                                                    @isset($orders) value="{{ $orders->date }}" @endisset
                                                    required {{$disabled_}}>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="col-md-12">Entry Price <span style="color: red;">*</span></label>
                                            <div class="col-md-12">    
                                                <input type="text" name="entry_price" id="entry_price"
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
                                                    @if (isset($orders)) value="{{ $orders->tax }}" @endisset autocomplete="off" required {{$disabled_}} readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12" >
                                            <div style="float: right; margin-right:20px;">
                                                <a style="color:white;" class="btn btn-primary" id="btn-collapse"><i class="fa fa-plus"></i> Add Product</a>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if($type==1)
                                            {{-- FORM PRODUCT STOCK --}}
                                            <div id="collapse" class="panel-collapse collapse">
                                                <hr><br>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="col-md-12">Product <span style="color: red;">*</span></label>
                                                            <div class="col-md-12">
                                                                <select name="prods" id="prods" onchange="getProds()" class="form-control"
                                                                    @if (isset($orders)) @endisset {{$disabled_}}>
                                                                    <option value="" style="display: none;">- Choose Products -
                                                                    </option>
                                                                    @foreach ($products as $prod)
                                                                        <option @if (isset($orders))
                                                                        <?php if ($orders->product_id == $prod->id) {
                                                                            echo 'selected';
                                                                        } ?> @endisset
                                                                        value="{{ $prod->id }}" item-value="{{ $prod }}">{{ $prod->product_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="col-md-12">Qty <span style="color: red;">*</span></label>
                                                            <div class="col-md-12">
                                                                <input type="hidden" min="0" name="stock" id="stock" class="form-control"
                                                                    @if (isset($orders)) value="{{ $orders->product->stock }}" @endisset step="1" required="" {{$disabled_}}>
                                                                <input type="number" min="0" name="qty" id="qty" class="form-control"
                                                                    @if (isset($orders)) value="{{ $orders->qty }}" @endisset step="1" required="" {{$disabled__}} {{$disabled_}}>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="col-md-12">Base Price <span style="color: red;">*</span></label>
                                                            <div class="col-md-12">                          
                                                                <input type="text" name="base_price" id="base_price" class="form-control numeric"
                                                                    @if (isset($orders)) value="{{($orders->base_price_product * $orders->qty)}}" @endisset autocomplete="off" required="" style="width:100%" {{$disabled_}} readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="col-md-12">Selling Price <span style="color: red;">*</span></label>
                                                            <div class="col-md-12">                          
                                                                <input type="text" name="sell_price" id="sell_price" class="form-control numeric"
                                                                    @if (isset($orders)) value="{{($orders->sell_price_product * $orders->qty)}}" @endisset autocomplete="off" required="" style="width:100%" {{$disabled_}} readonly>
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
                                                <br>
                                                <table id="dt-detail" class="table table-striped table-bordered table-hover" width="100%" style="text-align: center;">
                                                    <thead style="background-color: #fbfbfb;">
                                                      <tr>
                                                        <!-- <th rowspan="2" style="vertical-align: middle;"><center>No</center></th> -->
                                                        <th rowspan="2" style="vertical-align: middle;"><center>Products</center></th>
                                                        <th rowspan="2" style="vertical-align: middle;"><center>Qty</center></th>
                                                        <th rowspan="2" style="vertical-align: middle;"><center>Base Price</center></th>
                                                        <th rowspan="2" style="vertical-align: middle;"><center>Selling Price</center></th>
                                                        <th rowspan="2" style="vertical-align: middle;"><center>Action</center></th>
                                                      </tr>
                                                    </thead>
                                                    <tbody id="table_body">
                                                    </tbody>
                                                </table>
                                            </div>
                                            @else
                                            {{-- FORM DROPSHIP --}}
                                            <div id="collapse" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="col-md-5">Product <span style="color: red;">*</span></label>
                                                            <div class="col-md-12">
                                                                <input type="text" placeholder="Input Product" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="col-md-5">Qty <span style="color: red;">*</span></label>
                                                            <div class="col-md-12">
                                                                <input type="hidden" min="0" name="stock" id="stock" class="form-control"
                                                                    @if (isset($orders)) value="{{ $orders->product->stock }}" @endisset step="1" required="" style="width:35%" {{$disabled_}}>
                                                                <input type="number" min="0" name="qty" id="qty" class="form-control"
                                                                    @if (isset($orders)) value="{{ $orders->qty }}" @endisset step="1" required="" style="width:35%" {{$disabled__}} {{$disabled_}}>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </section>
    </div>
    @include('layouts.footer')
    <script>
        var sell_price = 0;
        var base_price = 0;

        function removedata(id){
            $(document).ready(function() {
            $('#table_body > tr').eq(id).children('td').remove();
            });
        }

        function getProds() {
            var token = $('meta[name="csrf-token"]').attr('content');
            var id_prods = document.getElementById("prods").value;
            $.ajax({
                type: 'GET',
                @if(Auth::guard('admin')->check())
                    url: "{{ route('admin.order.getDetailProds') }}",
                @else
                    url: "{{ route('user.order.getDetailProds') }}",
                @endif
                data: {
                    'id_prod': id_prods
                },
                success: function(data) {
                    $("#entry_price").val(0);
                    $("#cal_tax").val(0);
                    $("#cal_profit").val(0);
                    $('#qty').removeAttr('disabled');

                    base_price = data["base_price"];
                    sell_price = data["selling_price"];
                    max_qty = data["stock"];

                    $('#qty').val(1);
                    $('#base_price').val(base_price);
                    $("#base_price_old").val(base_price);
                    $('#sell_price').val(sell_price);
                    $("#sell_price_old").val(sell_price);
                    $("#stock").val(max_qty);

                    var input = document.getElementById("qty");
                    input.setAttribute("max",max_qty);
                }
            });
        }
        function sell_price_update(e){
            var qty = $("#qty_"+e).val();
            var max_stock = $("#max_stock_"+e).val();
            var sell_price_table = $("#sell_price_data_"+e).val();

            // //Calculation
            if(sell_price != 0){
                if(qty.length <= max_qty.length) {
                    if(qty > max_stock && qty.length >= max_stock.length){
                    $('#save_data').attr('disabled', 'disabled');
                    alert("Item Quantity Exceed Stock Limit!");
                        $("#qty").val(1);
                        // $("#base_price").val(base_price);
                        $("#sell_price_"+e).val(sell_price_table);
                    }else{
                        $('#save_data').removeAttr('disabled');
                        // var result_base = base_price * qty;
                        var result_sell = sell_price_table * qty;
                        $("#sell_price_"+e).val(result_sell);
                        // $("#base_price").val(result_base);
                    }
                }else{
                    $('#save_data').attr('disabled', 'disabled');
                    alert("Item Quantity Exceed Stock Limit!");
                        $("#qty").val(1);
                        // $("#base_price").val(base_price);
                        $("#sell_price_"+e).val(sell_price_table);
                }

            }else{
                // var input = document.getElementById("qty");
                // input.setAttribute("max",max_stock);

                // if(qty > max_stock){
                //     $('#save_data').attr('disabled', 'disabled');
                //     alert("Item Quantity Exceed Stock Limit!");
                // }else{
                //     $('#save_data').removeAttr('disabled');
                //     $("#entry_price").val(0);
                //     $("#cal_tax").val(0);
                //     $("#cal_profit").val(0);
                    var result_base = base_price_old * qty;
                    var result_sell = sell_price_old * qty;
                    $("#base_price").val(result_base);
                    $("#sell_price").val(result_sell);
                // }
            }   
        }
    </script>
    <script>
        $(document).ready(function() {
            $("#btn-collapse").click(function(){
                // let invoice = $('#invoice').val();
                // let source = $('#source_pay').val();
                // let tgl = $('#tgl').val();
                // if(invoice == '' && source == '' && tgl == ''){
                //     AlertData();
                // }else{
                    $("#collapse").collapse('show');
                    $("html, body").animate({
                        scrollTop: $(
                        'html, body').get(0).scrollHeight
                    }, 2000);
                    
                // }
                
            });

            $('#btn_tambahToTable').on('click', function() {
                var table_body = $('#tabel_body');

                var product = $('#prods').val();
                var qty = $('#qty').val();
                var max_stock = $('#stock').val();
                var base = $('#base_price').val();
                var sell = $('#sell_price').val();

                if(product != ''){
                    var products = $('#prods option:selected').attr('item-value');
                    prodSelected = products.replace(/\'/g, '"');
                    var productData = JSON.parse(prodSelected);

                    var i = $('#dt-detail tbody tr').length;

                    $('#table_body').append("<tr id='"+(i+1)+"'>"+
                    "<td style='text-align:left;'><input type='hidden' name='product_id[]' value='"+productData.id+"' readonly>"+productData.product_name+"</td>"+
                    "<input type='hidden' name='max_stock[]' value='"+max_stock+"' id='max_stock_"+i+"' readonly>"+
                    "<td><center><input type='number' style='width:100px !important; height:25px !important; text-align:center;' class='form-control' name='qty[]' id='qty_"+i+"' value='"+qty+"' onkeyup ='sell_price_update("+i+")'></center></td>"+
                    "<td><center><input type='text' style='width:100px !important; height:25px !important; text-align:center;' class='form-control numeric' name='base_price_arr[]' id='base_price_"+i+"' value='"+base+"' disabled></center></td>"+
                    "<input type='hidden' style='width:100px !important; height:25px !important; text-align:center;' name='sell_price_data[]' id='sell_price_data_"+i+"' value='"+sell_price+"'>"+
                    "<td><center><input type='text' style='width:100px !important; height:25px !important; text-align:center;' class='form-control numeric' name='sell_price_arr[]' id='sell_price_"+i+"' value='"+sell+"' disabled></center></td>"+
                    "<td><center><button type='button' id='jumlah_"+i+"' class='btn btn-link btn-simple-danger' onclick='removedata("+i+")' title='Hapus'><i class='fa fa-trash' style='color:red;''></i></button></center></td>"+
                    "</tr>");

                    if(i==0){
                    $('#num_tbl_'+i).text(i+1);
                    }else{
                    $('#num_tbl_'+i).text(i);
                    }

                    $('#prods').val("");
                    $('#qty').val("");
                    $('#qty').attr('disabled','disabled');
                    $('#base_price').val("");
                    $('#sell_price').val("");

                    $("html, body").animate({
                        scrollTop: $(
                        'html, body').get(0).scrollHeight
                    }, 2000);
                }else{
                    AlertData();
                }

            });

            $('#qty').on('keyup textInput input', function() {
                var qty = $("#qty").val();
                var max_stock = $("#stock").val();
                var base = $("#base_price").val();
                var base_price_old = $("#base_price_old").val();
                var sell_price_old = $("#sell_price_old").val();

                //Calculation
                if(sell_price != 0){
                    if(qty.length <= max_qty.length) {
                        if(qty > max_qty && qty.length >= max_qty.length){
                        $('#save_data').attr('disabled', 'disabled');
                        alert("Item Quantity Exceed Stock Limit!");
                            $("#qty").val(1);
                            $("#base_price").val(base_price);
                            $("#sell_price").val(sell_price);
                        }else{
                            $('#save_data').removeAttr('disabled');
                            var result_base = base_price * qty;
                            var result_sell = sell_price * qty;
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
                    // var input = document.getElementById("qty");
                    // input.setAttribute("max",max_stock);

                    // if(qty > max_stock){
                    //     $('#save_data').attr('disabled', 'disabled');
                    //     alert("Item Quantity Exceed Stock Limit!");
                    // }else{
                    //     $('#save_data').removeAttr('disabled');
                    //     $("#entry_price").val(0);
                    //     $("#cal_tax").val(0);
                    //     $("#cal_profit").val(0);
                        var result_base = base_price_old * qty;
                        var result_sell = sell_price_old * qty;
                        $("#base_price").val(result_base);
                        $("#sell_price").val(result_sell);
                    // }
                }
            });

            $('#entry_price').on('keyup textInput input', function() {
                var entry_price = $("#entry_price").val();
                var sell_price_old = $("#sell_price_old").val();
                var base_price = $("#base_price").val();
                var entry = entry_price.split('.').join('').replace(/^Rp/, '');
                var base = base_price.split('.').join('').replace(/^Rp/, '');
                var qty = $("#qty").val();

                //Calculation
                if(sell_price != 0){
                    if(entry == 0){
                        var tax = 0;
                        var profit = 0;
                    }else{
                        var profit = entry - base;
                        var sell_total = sell_price * qty;
                        if(entry > sell_total){
                            var tax = 0;
                        }else{
                            var tax = sell_total - entry;
                        }
                    }
                }else{
                    if(entry == 0){
                        var tax = 0;
                        var profit = 0;
                    }else{
                        var profit = entry - base;
                        var sell_total = sell_price_old * qty;
                        if(entry > sell_total){
                            var tax = 0;
                        }else{
                            var tax = sell_total - entry;
                        }
                    }
                }
                $("#cal_tax").val(tax);
                $("#cal_profit").val(profit);
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
