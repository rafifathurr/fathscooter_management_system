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
                    <div class="content container-fluid">
                        <div class="box box-primary">
                            <div class="box-body">
                                <form id="form_add" action="{{ route('admin.order.' . $url) }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <br>
                                    <table id="dt-detail" class="table table-striped table-bordered table-hover" width="100%" style="text-align: center;">
                                        <thead style="background-color: #fbfbfb;">
                                            <tr>
                                                <th style="vertical-align: middle;" width="10%">
                                                    <center>No</center>
                                                </th>
                                                <th style="vertical-align: middle;" width="25%">
                                                    <center>Products</center>
                                                </th>
                                                <th style="vertical-align: middle;" width="15%">
                                                    <center>Total Demand</center>
                                                </th>
                                                <th style="vertical-align: middle;" width="20%">
                                                    <center>Base Price Average</center>
                                                </th>
                                                <th style="vertical-align: middle;" width="20%">
                                                    <center>Holding Cost</center>
                                                </th>
                                                @if ($title == 'Add Analysis' || $title == 'Edit Analysis')
                                                <th style="vertical-align: middle;" width="10%">
                                                    <center>Action</center>
                                                </th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody id="table_body">
                                        @isset($orders)
                                            @if($title == 'Edit Order')
                                                @foreach($details_order as $details)
                                                <tr id='{{ $details->id_product }}'>
                                                    <td style="text-align:left;">
                                                        {{  $details->product->product_name  }}
                                                    </td>
                                                    <td style="text-align:right;">
                                                        {{  $details->qty  }}
                                                    </td>
                                                    <td style="text-align:right;">
                                                        Rp. {{number_format($details->base_price_save,0,',','.')}}
                                                    </td>
                                                    <td style="text-align:right;">
                                                        Rp. {{number_format($details->selling_price_save,0,',','.')}}
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <button type='button' class='btn btn-link btn-simple-danger' onclick='removedata({{ $details->id_product }})' title='Hapus'>
                                                                <i class='fa fa-trash' style='color:red;'>
                                                                </i>
                                                            </button>
                                                        </center>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                                @foreach($details_order as $details)
                                                <tr>
                                                    <td style="text-align:left;">
                                                        {{  $details->product->product_name  }}
                                                    </td>
                                                    <td style="text-align:right;">
                                                        {{  $details->qty  }}
                                                    </td>
                                                    <td style="text-align:right;">
                                                        Rp. {{number_format($details->base_price_save,0,',','.')}}
                                                    </td>
                                                    <td style="text-align:right;">
                                                        Rp. {{number_format($details->selling_price_save,0,',','.')}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif
                                        @endisset
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
