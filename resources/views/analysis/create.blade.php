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
                <section class="content container-fluid">
                    <div class="content container-fluid">
                        <div class="box box-primary">
                            <div class="box-body">
                                <h4><b>EOQ Analysis</b></h4>
                                <form id="form_add" action="{{ route('admin.order.' . $url) }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <br>
                                    <table id="dt-detail" class="table table-striped table-bordered table-hover" width="100%" style="text-align: center;">
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
                                                    <input type="hidden" name="id_product" value="{{$detail->id_product}}">
                                                    {{  $detail->product_name }}
                                                </td>
                                                <td style="text-align:right;">
                                                    <input type="number" class='form-control numeric' name="demandpermonth" id="demandpermonth" value="{{$detail->demandpermonth}}" readonly>
                                                </td>
                                                <td style="text-align:right;">
                                                    <input type="text" class='form-control numeric' name="setupcost" id="setupcost" value="{{number_format((float)$detail->setupcost, 0, '.', '')}}" readonly>
                                                </td>
                                                <td style="text-align:right;">
                                                    <input type="number" class='form-control numeric' name="holdingcost" id="holdingcost">
                                                </td>
                                                <td style="text-align:right;">
                                                    <input type="number" class='form-control numeric' name="eoq" id="eoq" readonly>
                                                </td>
                                                <td>
                                                    <center>
                                                        <button type='button' class='btn btn-link btn-simple-danger' title='Hapus'>
                                                            <i class='fa fa-trash' style='color:red;'>
                                                            </i>
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
                                                    {{  $detail->product_name }}
                                                </td>
                                                <td style="text-align:right;">
                                                    <input type="number" name="demandpermonth" id="demandpermonth" value="{{$detail->demandpermonth}}" readonly>
                                                </td>
                                                <td style="text-align:right;">
                                                    <input type="number" name="setupcost" id="setupcost" value="{{$detail->setupcost}}" readonly>
                                                </td>
                                                <td style="text-align:right;">
                                                    <input type="number" name="holdingcost" id="holdingcost">
                                                </td>
                                                <td style="text-align:right;">
                                                    <input type="number" name="eoq" id="eoq" readonly>
                                                </td>
                                                <td>
                                                    <center>
                                                        <button type='button' class='btn btn-link btn-simple-danger'  title='Hapus'>
                                                            <i class='fa fa-trash' style='color:red;'>
                                                            </i>
                                                        </button>
                                                    </center>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                    <br>
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
                        </div>
                    </div>
                </section>
            </div>
            @include('layouts.footer')
            {{-- FUNCTIONS --}}
            <script>

            </script>
        </div>
    </div>
</body>
</html>
