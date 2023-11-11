<!DOCTYPE html>
<html lang="en">
@include('layouts.head')
<style>
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
                <div class="page-inner mt--5">

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
                                                    width="15%">
                                                    <center>No</center>
                                                </th>
                                                <th width="55%" class="sorting" tabindex="0"
                                                    aria-controls="add-row" rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                    style="font-weight:900;">
                                                    <center>Notification</center>
                                                </th>
                                                <th width="30%" class="sorting" tabindex="0"
                                                    aria-controls="add-row" rowspan="1" colspan="1"
                                                    aria-label="Action: activate to sort column ascending"
                                                    style="font-weight:900;">
                                                    <center>Action</center>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $num = 0; ?>
                                            @foreach ($all_notif as $notif)
                                                <tr role="row" class="odd">
                                                    <td>
                                                        <center>{{ $num = $num + 1 }}</center>
                                                    </td>
                                                    <td class="sorting_1">
                                                        {{ $notif->product_name }}
                                                        Stock is Running Out!
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <div class="form-button-action">
                                                                <a href="{{ route('admin.product.edit', $notif->id) }}"
                                                                    data-toggle="tooltip" title="Edit"
                                                                    class="btn btn-link btn-simple-primary btn-lg"
                                                                    data-original-title="Edit Product"
                                                                    control-id="ControlID-16">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                            </div>
                                                        </center>
                                                    </td>
                                                </tr>
                                            @endforeach
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

@include('layouts.swal')

</html>
