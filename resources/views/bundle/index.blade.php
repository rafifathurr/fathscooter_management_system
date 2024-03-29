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
                <div class="page-inner mt--5">
                    <!-- Button -->
                    <div class="d-flex">
                        @if (Auth::guard('admin')->check())
                            <a class="btn btn-primary btn-round ml-auto mb-3"
                                href="{{ route('admin.bundle.create') }}">
                                <i class="fa fa-plus"></i>
                                Add Bundling
                            </a>
                        @else
                            <div class="mb-3">
                                <br>
                            </div>
                        @endif
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length" id="add-row_length"></div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="add-row_filter"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="add-row" class="display table table-striped table-hover dataTable"
                                        cellspacing="0" width="100%" role="grid" aria-describedby="add-row_info"
                                        style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="add-row"
                                                    rowspan="1" colspan="1" aria-sort="ascending" width="10%"
                                                    aria-label="Name: activate to sort column descending">
                                                    <center>No</center>
                                                </th>
                                                <th width="30%" class="sorting" tabindex="0"
                                                    aria-controls="add-row" rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                    style="font-weight:900;">
                                                    <center>Bundle Name</center>
                                                </th>
                                                {{-- @if (Auth::guard('admin')->check())
                                                    <th width="15%" class="sorting" tabindex="0" aria-controls="add-row"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 15%; font-weight:900;">
                                                        <center>Base Price</center>
                                                    </th>
                                                @endif
                                                <th width="15%" class="sorting" tabindex="0" aria-controls="add-row"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                    style="width: 15%; font-weight:900;">
                                                    <center>Selling Price</center>
                                                </th> --}}
                                                <th width="10%" class="sorting" tabindex="0"
                                                    aria-controls="add-row" rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                    style="font-weight:900;">
                                                    <center>Status</center>
                                                </th>
                                                <th width="10%" class="sorting" tabindex="0"
                                                    aria-controls="add-row" rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                    style="font-weight:900;">
                                                    <center>Stock</center>
                                                </th>
                                                <th width="10%" class="sorting" tabindex="0"
                                                    aria-controls="add-row" rowspan="1" colspan="1"
                                                    aria-label="Action: activate to sort column ascending"
                                                    style="font-weight:900;">
                                                    <center>Action</center>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $num = 0; ?>
                                            {{-- @foreach ($products as $prod)
                                            <tr role="row" class="odd">
                                                <td>
                                                    <center>{{$num=$num+1}}</center>
                                                </td>
                                                <td>
                                                    {{$prod->product_name}}
                                                </td>
                                                <td>
                                                    <center>{{$prod->code}}</center>
                                                </td>
                                                {{-- @if (Auth::guard('admin')->check())
                                                    <td style="text-align:right">
                                                        Rp. {{number_format($prod->base_price,0,',','.')}}
                                                    </td>
                                                @endif
                                                <td style="text-align:right">
                                                    Rp. {{number_format($prod->selling_price,0,',','.')}}
                                                </td>
                                                <td>
                                                    @if ($prod->status == 'Active')
                                                        <center style="background-color:#05c305; color:white; padding:2px; border-radius:5px;">{{$prod->status}}</center>
                                                    @else
                                                        <center style="background-color:red; color:white; padding:2px; border-radius:5px;">{{$prod->status}}</center>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($prod->stock <= 2)
                                                   <center style="color:red !important;">{{$prod->stock}}</center>
                                                   @else
                                                   <center>{{$prod->stock}}</center>
                                                   @endif
                                                </td>
                                                <td>
                                                    <center>
                                                        <div class="form-button-action">
                                                        @if (Auth::guard('admin')->check())
                                                            <a href="{{route('admin.product.detail', $prod->id) }}" data-toggle="tooltip" title="Detail"
                                                                class="btn btn-link btn-simple-primary btn-lg"
                                                                data-original-title="Detail" control-id="ControlID-16">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            <a href="{{route('admin.product.edit', $prod->id) }}" data-toggle="tooltip" title="Edit"
                                                                class="btn btn-link btn-simple-primary btn-lg"
                                                                data-original-title="Edit" control-id="ControlID-16">
                                                                <i class="fa fa-edit" style="color:grey;"></i>
                                                            </a>
                                                            <button type="submit" onclick="destroy({{$prod->id}})" data-toggle="tooltip" title="Delete"
                                                                class="btn btn-link btn-simple-danger"
                                                                data-original-title="Delete" control-id="ControlID-17">
                                                                <i class="fa fa-trash" style="color:red;"></i>
                                                            </button>
                                                        @else
                                                            <a href="{{route('user.product.detail', $prod->id) }}" data-toggle="tooltip" title="Detail"
                                                                class="btn btn-link btn-simple-primary btn-lg"
                                                                data-original-title="Detail" control-id="ControlID-16">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            <a href="{{route('user.product.edit', $prod->id) }}" data-toggle="tooltip" title="Edit"
                                                                class="btn btn-link btn-simple-primary btn-lg"
                                                                data-original-title="Edit" control-id="ControlID-16">
                                                                <i class="fa fa-edit" style="color:grey;"></i>
                                                            </a>
                                                            <!-- <button type="submit" onclick="destroy({{$prod->id}})" data-toggle="tooltip" title="Delete"
                                                                class="btn btn-link btn-simple-danger"
                                                                data-original-title="Delete" control-id="ControlID-17">
                                                                <i class="fa fa-trash" style="color:red;"></i>
                                                            </button> -->
                                                        @endif
                                                        </div>
                                                    </center>
                                                </td>
                                            </tr>
                                        @endforeach --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="add-row_info"></div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="add-row_paginate"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
            <script src="{{ asset('js/app/table.js') }}"></script>
        </div>
    </div>
</body>
<script>
    function destroy(id) {
        var token = $('meta[name="csrf-token"]').attr('content');

        swal({
            title: "",
            text: "Are you sure want to delete this record?",
            icon: "warning",
            buttons: ['Cancel', 'OK'],
            // dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                @if (Auth::guard('admin')->check())
                    $.post("{{ route('admin.product.delete') }}", {
                        id: id,
                        _token: token
                    }, function(data) {
                        location.reload();
                    })
                @else
                    $.post("{{ route('user.product.delete') }}", {
                        id: id,
                        _token: token
                    }, function(data) {
                        location.reload();
                    })
                @endif
            } else {
                return false;
            }
        });
    }
</script>

@include('layouts.swal')

</html>
