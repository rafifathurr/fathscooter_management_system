<!DOCTYPE html>
<html lang="en">
@include('layouts.head')
<style>
    .swal-button--cancel{
        color:white;
        background-color:red;
    }

    .swal-button--confirm{
        color:white;
        background-color:#509dc1;
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
                                <h2 class="pb-2 fw-bold">{{$title}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="container">
                    <form id="form_add" action="{{ route('admin.role.' . $url) }}" method="post" enctype="multipart/form-data" style="margin-right:100px;">
                    {{ csrf_field() }}
                        <br>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="col-md-2"></div>
                                <label class="col-md-2">User Role <span style="color: red;">*</span></label>
                                <div class="col-md-10">
                                    <input type="hidden" class="form-control" id="id" name="id" autocomplete="off" @isset($roles) value="{{ $roles->id }}" readonly @endisset required>
                                    <input type="text" name="role" id="role" class="form-control"  step="1" @if (isset($roles)) value="{{ $roles->role }}" @endisset autocomplete="off" required {{ $disabled_ }} style="width:100%;">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="col-md-2"></div>
                                <label class="col-md-2">Note</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" name="note" id="note" rows="5" cols="10"  autocomplete="off" {{ $disabled_ }} style="width:100%">@if (isset($roles)) {{ $roles->note }} @endisset</textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <div style="float:right;">
                                @if ($title == 'Add User Roles')
                                    <div class="col-md-10" style="margin-right: 20px;">
                                        <a href="{{ route('admin.role.index')}}" type="button" class="btn btn-danger">
                                            <i class="fa fa-arrow-left"></i>&nbsp;
                                            Back
                                        </a>
                                        <button type="submit" class="btn btn-primary" style="margin-left:10px;">
                                            <i class="fa fa-check"></i>&nbsp;
                                            Save
                                        </button>
                                    </div>
                                @elseif ($title == 'Edit User Roles')
                                    <div class="col-md-10" style="margin-right: 20px;">
                                        <a href="{{ route('admin.role.index')}}" type="button" class="btn btn-danger">
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
                                        <a href="{{ route('admin.role.index')}}" type="button" class="btn btn-danger">
                                            <i class="fa fa-arrow-left"></i>&nbsp;
                                            Back
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </section>
            </div>
            @include('layouts.footer')

        </div>
    </div>
</body>
@include('layouts.swal')
</html>
