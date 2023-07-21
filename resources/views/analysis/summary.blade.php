<!DOCTYPE html>
<html lang="en">
@include('layouts.head')
<style>
    .numeric {
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
                                <h4><b>Economic Order Quantity Analysis</b></h4>
                                <br>
                                <div class="col-md-12">
                                    <h6>The Summary of <b>The Top 5 Products</b> of The Economic Order Quantity Analysis in {{ $year }} : </h6>
                                </div>
                                <table class="table table-striped table-bordered table-hover" width="100%"
                                    style="text-align: center;">
                                    <thead style="background-color: #fbfbfb;">
                                        <tr>
                                            <th style="vertical-align: middle;" width="5%">
                                                <center>No</center>
                                            </th>
                                            <th style="vertical-align: middle;" width="25%">
                                                <center>Products</center>
                                            </th>
                                            <th style="vertical-align: middle;" width="15%">
                                                <center>EOQ</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_body">
                                        @foreach ($details as $key => $detail)
                                            <tr id='{{ $detail->id_product }}'>
                                                <td style="text-align:center;">
                                                    {{ $key + 1 }}
                                                </td>
                                                <td style="text-align:left;">
                                                    <input type="hidden" name="id_product"
                                                        value="{{ $detail->id_product }}">
                                                    {{ $detail->product->product_name }}
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
                                <div class="col-md-12">
                                    <h6>The Summary of <b>The Top 5 Products</b> of The Reorder Point Analysis in {{ $year }} : </h6>
                                </div>
                                <table class="table table-striped table-bordered table-hover" width="100%"
                                    style="text-align: center;overflow-x: auto;">
                                    <thead style="background-color: #fbfbfb;">
                                        <tr>
                                            <th style="vertical-align: middle;" width="5%">
                                                <center>No</center>
                                            </th>
                                            <th style="vertical-align: middle;" width="30%">
                                                <center>Products</center>
                                            </th>
                                            <th style="vertical-align: middle;" width="9%">
                                                <center>Reorder Point</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_body">
                                        @foreach ($details as $key => $detail)
                                            <tr id='{{ $detail->id_product }}'>
                                                <td style="text-align:left;">
                                                    {{ $key + 1 }}
                                                </td>
                                                <td style="text-align:left;">
                                                    <input type="hidden" name="id_product"
                                                        value="{{ $detail->id_product }}">
                                                    {{ $details_2[$key]->product->product_name }}
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="modal-footer">
                    <div style="float:right;">
                        <a href="{{ route('admin.analysis.index') }}" type="button" class="btn btn-danger">
                            <i class="fa fa-arrow-left"></i>&nbsp;
                            Back
                        </a>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</body>

</html>
