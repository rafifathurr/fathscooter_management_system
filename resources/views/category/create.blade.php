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
                                <h2 class="text-black pb-2 fw-bold">{{$title}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="content container-fluid">
                    <section class="content container-fluid">
                        <div class="box box-primary">
                            <div class="box-body">
                                <form id="form_add" action="{{ route('admin.category.' . $url) }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">Category Product <span style="color: red;">*</span></label>
                                            <div class="col-md-11">
                                                <input type="hidden" class="form-control" id="id" name="id" autocomplete="off" @isset($categories) value="{{ $categories->id }}" readonly @endisset required>
                                                <input type="text" name="category" id="category" class="form-control"  step="1" @if (isset($categories)) value="{{ $categories->category }}" @endisset autocomplete="off" required {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">Note</label>
                                            <div class="col-md-11">
                                                <textarea class="form-control" name="note" id="note" rows="5" cols="10"  autocomplete="off" {{ $disabled_ }} style="width:100%">@if (isset($categories)) {{ $categories->note }} @endisset</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="modal-footer">
                                        <div style="float:right;">
                                            @if ($title == 'Add Category Product')
                                                <div class="col-md-10" style="margin-right: 20px;">
                                                    <a href="{{ route('admin.category.index')}}" type="button" class="btn btn-danger">
                                                        <i class="fa fa-arrow-left"></i>&nbsp; 
                                                        Back
                                                    </a>
                                                    <button type="submit" class="btn btn-primary" style="margin-left:10px;">
                                                        <i class="fa fa-check"></i>&nbsp;
                                                        Save
                                                    </button>
                                                </div>
                                            @elseif ($title == 'Edit Category Product')
                                                <div class="col-md-10" style="margin-right: 20px;">
                                                    <a href="{{ route('admin.category.index')}}" type="button" class="btn btn-danger">
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
                                                    <a href="{{ route('admin.category.index')}}" type="button" class="btn btn-danger">
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
                    </section>
                </section>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</body>
</html>
