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
                        <a class="btn btn-primary btn-round ml-auto mb-3" id="add_analysis">
                            <i class="fa fa-plus"></i>
                            Add Analysis
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
                                                <th class="sorting_asc" tabindex="0" aria-controls="add-row"
                                                    rowspan="1" colspan="1" aria-sort="ascending" width="10%"
                                                    aria-label="Name: activate to sort column descending">
                                                    <center>No</center>
                                                </th>
                                                <th width="30%" class="sorting" tabindex="0"
                                                    aria-controls="add-row" rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                    style="font-weight:900;">
                                                    <center>Year</center>
                                                </th>
                                                {{-- <th width="20%" class="sorting" tabindex="0" aria-controls="add-row"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                    style="font-weight:900;">
                                                    <center>Month</center>
                                                </th> --}}
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
                                            @foreach ($analysis as $anls)
                                                <tr role="row" class="odd">
                                                    <td>
                                                        <center>{{ $num = $num + 1 }}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{ $anls->year }}</center>
                                                    </td>
                                                    {{-- <td>
                                                    <center>{{ $monthName = date('F', mktime(0, 0, 0, $anls->month, 1)) }}</center>
                                                </td> --}}
                                                    <td>
                                                        <center>
                                                            <div class="form-button-action">
                                                                <a href="{{ route('admin.analysis.summary', $anls->id) }}"
                                                                    data-toggle="tooltip" title="Summary"
                                                                    class="btn btn-link btn-simple-primary btn-lg"
                                                                    data-original-title="Summary"
                                                                    control-id="ControlID-16">
                                                                    <i class="fa fa-list-alt"></i>
                                                                </a>
                                                                <a href="{{ route('admin.analysis.detail', $anls->id) }}"
                                                                    data-toggle="tooltip" title="Detail"
                                                                    class="btn btn-link btn-simple-primary btn-lg"
                                                                    data-original-title="Detail"
                                                                    control-id="ControlID-16">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                                <a href="{{ route('admin.analysis.edit', $anls->id) }}"
                                                                    data-toggle="tooltip" title="Edit"
                                                                    class="btn btn-link btn-simple-primary btn-lg"
                                                                    data-original-title="Edit"
                                                                    control-id="ControlID-16">
                                                                    <i class="fa fa-edit" style="color:grey;"></i>
                                                                </a>
                                                                <button type="submit"
                                                                    onclick="destroy({{ $anls->id }})"
                                                                    data-toggle="tooltip" title="Delete"
                                                                    class="btn btn-link btn-simple-danger"
                                                                    data-original-title="Delete"
                                                                    control-id="ControlID-17">
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
    $(document).ready(function() {
        $('#add_analysis').on('click', function() {
            const div = document.createElement("form");
            div.method = 'POST';
            div.action = '{{ route('admin.analysis.create') }}';
            $(div).html(
                "<input name='_token' value='{{ csrf_token() }}' type='hidden'>" +
                "<select id='tahun' name='tahun' onchange='getMonth()' class='form-control'>" +
                "<option value='' style='display: none;' selected=''>- Choose Year -</option>" +
                "@foreach ($years as $year)" +
                "<option value='{{ $year->tahun }}'>{{ $year->tahun }}</option>" +
                "@endforeach" +
                "</select>"
            );
            swal({
                title: "Add Analysis Order",
                content: div,
                buttons: [true, "Export"]
            }).then((result) => {
                if (result == true) {
                    if ($('#tahun').val() != '') {
                        div.submit();
                    } else {
                        swal({
                            icon: 'warning',
                            title: 'Oops !',
                            button: false,
                            text: 'Please Choose Year First!',
                            timer: 1500
                        });
                    }
                }
            })
        })
    })

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
                $.post("{{ route('admin.analysis.delete') }}", {
                    id: id,
                    _token: token
                }, function(data) {
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
