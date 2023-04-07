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
                                <h2 class="text-white pb-2 fw-bold">{{($title)}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <!-- Button -->
                    <div class="d-flex">
                        <a class="btn btn-primary btn-round ml-auto mb-3" href="{{ route('admin.source_payment.create') }}">
                            <i class="fa fa-plus"></i>
                            Add Source Payment
                        </a>
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
                                                <th class="sorting_asc" tabindex="0" aria-controls="add-row" width:0%>
                                                    <center>No</center>
                                                </th>
                                                <th width="50%" class="sorting" tabindex="0" aria-controls="add-row"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                    style="font-weight:900;">
                                                    <center>Source</center>
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
                                        @foreach($sources as $source)
                                            <tr role="row" class="odd">
                                                <td>
                                                    <center>{{$num=$num+1}}</center>
                                                </td>
                                                <td class="sorting_1">
                                                    <center>{{$source->source}}</center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <div class="form-button-action">
                                                            <a href="{{route('admin.source_payment.detail', $source->id) }}" data-toggle="tooltip" title="Detail"
                                                                class="btn btn-link btn-simple-primary btn-lg"
                                                                data-original-title="Detail" control-id="ControlID-16">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            <a href="{{route('admin.source_payment.edit', $source->id) }}" data-toggle="tooltip" title="Edit"
                                                                class="btn btn-link btn-simple-primary btn-lg"
                                                                data-original-title="Edit" control-id="ControlID-16">
                                                                <i class="fa fa-edit" style="color:grey;"></i>
                                                            </a>
                                                            <button type="submit" onclick="destroy({{$source->id}})" data-toggle="tooltip" title="Delete"
                                                                class="btn btn-link btn-simple-danger"
                                                                data-original-title="Delete" control-id="ControlID-17">
                                                                <i class="fa fa-trash" style="color:red;"></i>
                                                            </button>
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
            $.post("{{route('admin.source_payment.delete')}}",{ id:id,_token:token},function(data){
                location.reload();
            })
          } else {
            return false;
          }
      });
  }
</script>

@include('layouts.swal')
</html>
