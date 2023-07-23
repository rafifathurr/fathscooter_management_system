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
                                <h2 class="text-black pb-2 fw-bold">{{ $title }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="content container-fluid">
                    <div class="content container-fluid">
                        <div class="box box-primary">
                            <div class="box-body">
                                @if(Auth::guard('admin')->check())
                                <form id="form_add" action="{{ route('admin.product.' . $url) }}" method="post"
                                    enctype="multipart/form-data" >
                                @else
                                <form id="form_add" action="{{ route('user.product.' . $url) }}" method="post"
                                    enctype="multipart/form-data" >
                                @endif
                                    {{ csrf_field() }}
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10" style="display:block !important  ">
                                            <label class="col-md-12">Name Product <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="hidden" class="form-control" id="id" name="id" autocomplete="off" @isset($products) value="{{ $products->id }}" readonly @endisset required>
                                                <input type="text" name="name" id="name " class="form-control"
                                                    step="1" @if (isset($products)) value="{{ $products->product_name }}" @endisset autocomplete="off" required
                                                    {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    @if(Auth::guard('admin')->check())
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-4">
                                            <label class="col-md-12">Part Code <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" name="code" id="code" class="form-control"
                                                    step="1" @if (isset($products)) value="{{ $products->code }}" @endisset autocomplete="off" required
                                                    {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="col-md-12">Status <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <select class="form-control selectpicker" id="status"
                                                    name="status" data-size="8" data-show-subtext="true"
                                                    data-live-search="true" @if(isset($products)) @endisset autocomplete="off" required {{ $disabled_ }}>
                                                    <option value="" disabled hidden>- Select Status -</option>
                                                    @if(isset($products))
                                                        <option selected value="{{$products->status}}" hidden>{{$products->status}}</option>
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                    @else
                                                        <option value="Active" selected>Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                    @endisset
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="col-md-12">Stock <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="number" style="text-align:center;" name="stock" id="stock" class="form-control"
                                                    step="1" @if (isset($products)) value="{{ $products->stock }}" @endisset autocomplete="off" required
                                                    {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-3">
                                            <label class="col-md-12">Part Code <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" name="code" id="code" class="form-control"
                                                    step="1" @if (isset($products)) value="{{ $products->code }}" @endisset autocomplete="off" required
                                                    {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="col-md-12">Status <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <select class="form-control selectpicker" id="status"
                                                    name="status" data-size="8" data-show-subtext="true"
                                                    data-live-search="true" @if(isset($products)) @endisset autocomplete="off" required {{ $disabled_ }}>
                                                    <option value="" disabled hidden>- Select Status -</option>
                                                    @if(isset($products))
                                                        <option selected value="{{$products->status}}" hidden>{{$products->status}}</option>
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                    @else
                                                        <option value="Active" selected>Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                    @endisset
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="hidden" name="base_price" id="base_price" class="form-control numeric"
                                                step="1" @if (isset($products)) value="{{ $products->base_price }}" @endisset autocomplete="off" required
                                                {{ $disabled_ }} style="width:100%;">
                                            <label class="col-md-12">Selling Price <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" name="selling_price" id="selling_price" class="form-control numeric"
                                                    step="1" @if (isset($products)) value="{{ $products->selling_price }}" @endisset autocomplete="off" required
                                                    {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="col-md-12">Stock <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="number" style="text-align:center;" name="stock" id="stock" class="form-control"
                                                    step="1" @if (isset($products)) value="{{ $products->stock }}" @endisset autocomplete="off" required
                                                    {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <br>
                                    @if(Auth::guard('admin')->check())
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-5">
                                            <label class="col-md-12">Base Price <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" name="base_price" id="base_price" class="form-control numeric"
                                                    step="1" @if (isset($products)) value="{{ $products->base_price }}" @endisset autocomplete="off" required
                                                    {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <label class="col-md-12">Selling Price <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" name="selling_price" id="selling_price" class="form-control numeric"
                                                    step="1" @if (isset($products)) value="{{ $products->selling_price }}" @endisset autocomplete="off" required
                                                    {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10" style="display:block !important">
                                            <label class="col-md-12">Description </label>
                                            <div class="col-md-12">
                                                <textarea class="form-control" name="desc" id="desc" rows="5" cols="10" autocomplete="off"
                                                    {{ $disabled_ }} style="width:100%">@if (isset($products)) {{ $products->desc }} @endisset</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-5">
                                            <label class="col-md-12">Category <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <select class="form-control selectpicker" id="category"
                                                    name="category" data-size="8" data-show-subtext="true"
                                                    data-live-search="true" @if(isset($products)) @endisset autocomplete="off" required {{ $disabled_ }}>
                                                    <option value="" selected disabled hidden>- Select Category -</option>
                                                    @foreach($categories as $cat)
                                                        <option  @if(isset($products)) <?php if($products->category_id == $cat->id){echo 'selected';}?> @endisset value="{{$cat->id}}">{{$cat->category}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <label class="col-md-12">Supplier <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <select class="form-control selectpicker" id="supplier"
                                                    name="supplier" data-size="8" data-show-subtext="true"
                                                    data-live-search="true" @if(isset($products)) @endisset autocomplete="off" required {{ $disabled_ }}>
                                                    <option value="" selected disabled hidden>- Select Supplier -</option>
                                                    @foreach($suppliers as $sup)
                                                        <option  @if(isset($products)) <?php if($products->supplier_id == $sup->id){echo 'selected';}?> @endisset value="{{$sup->id}}">{{$sup->supplier}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10" style="display:block!important">
                                            <label class="col-md-12">Attachment </span></label>
                                            <div class="col-md-12">
                                                @if ($title == 'Add Products' || $title == 'Edit Products')
                                                    <input type="file" id="uploads" name="uploads" class="form-control"
                                                        accept=".png, .jpg, .jpeg">
                                                    <br>
                                                    @if(isset($products))
                                                        @if($products->upload != null)
                                                            <?php
                                                            $newtext = wordwrap($products->upload, 50, "<br>", true);
                                                            $namafile = "$newtext<br>";
                                                            $explode = explode("_",$products->upload);
                                                            $changename = str_replace( $explode[0]."_","",$products->upload);
                                                            ?>
                                                            <a href="{{url('/').'/Uploads/Product/'.$products->id.'/uploads/'.$products->upload}}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> &nbsp;<?php echo $changename; ?> </a>
                                                            <br>
                                                            <span style="font-size: 13px;color: red">*) .png .jpg .jpeg</span>
                                                        @else
                                                            <span style="font-size: 13px;color: red">*) .png .jpg .jpeg</span>
                                                        @endif
                                                    @else
                                                        <span style="font-size: 13px;color: red">*) .png .jpg .jpeg</span>
                                                    @endif
                                                @else
                                                    @if(isset($products))
                                                        @if($products->upload != null)
                                                            <?php
                                                            $newtext = wordwrap($products->upload, 50, "<br>", true);
                                                            $namafile = "$newtext<br>";
                                                            $explode = explode("_",$products->upload);
                                                            $changename = str_replace( $explode[0]."_","",$products->upload);
                                                            ?>
                                                            <a href="{{url('/').'/Uploads/Product/'.$products->id.'/uploads/'.$products->upload}}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> &nbsp;<?php echo $changename; ?> </a><br>
                                                        @else
                                                            <span style="font-size: 13px;color: red">*) .png .jpg .jpeg</span>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    @if(isset($products))
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-12">
                                                <i><b>Created By</b></i>
                                            </label>
                                            <div class="col-md-12">
                                                <label for=""><i><b>{{$products->createdby->name}}</b></i></label>
                                            </div>
                                            <div class="col-md-12">
                                                <label for=""><i><b>{{date('l, j F Y  h:i A', strtotime($products->created_at))}}</b></i></label>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <div class="col-md-2"></div>
                                            <label class="col-md-12"> <i><b>Updated By</b></i> </label>
                                            @if($products->updated_by != null)
                                            <div class="col-md-12">
                                                <label for=""><i><b>{{$products->updatedby->name}}</b></i></label>
                                            </div>
                                            <div class="col-md-12">
                                                <label for=""><i><b>{{date('l, j F Y  h:i A', strtotime($products->updated_at))}}</b></i></label>
                                            </div>
                                            @else
                                            <div class="col-md-2">
                                                <label for=""><i><b>-</b></i></label>
                                            </div>
                                            <div class="col-md-4">
                                                <label for=""><i><b>-</b></i></label>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    @endif
                                    <div class="modal-footer">
                                        <div style="float:right;">
                                            @if ($title == 'Add Products')
                                                <div class="col-md-10" style="margin-right: 20px;">
                                                   @if(Auth::guard('admin')->check())
                                                        <a href="{{route('admin.product.index')}}" type="button" class="btn btn-danger">
                                                            <i class="fa fa-arrow-left"></i>&nbsp;
                                                            Back
                                                        </a>
                                                        <button type="submit" class="btn btn-primary" style="margin-left:10px;">
                                                            <i class="fa fa-check"></i>&nbsp;
                                                            Save
                                                        </button>
                                                    @else
                                                        <a href="{{route('user.product.index')}}" type="button" class="btn btn-danger">
                                                            <i class="fa fa-arrow-left"></i>&nbsp;
                                                            Back
                                                        </a>
                                                        <button type="submit" class="btn btn-primary" style="margin-left:10px;">
                                                            <i class="fa fa-check"></i>&nbsp;
                                                            Save
                                                        </button>
                                                    @endif
                                                </div>
                                            @elseif ($title == 'Edit Products')
                                                <div class="col-md-10" style="margin-right: 20px;">
                                                    @if(Auth::guard('admin')->check())
                                                        <a href="{{route('admin.product.index')}}" type="button" class="btn btn-danger">
                                                            <i class="fa fa-arrow-left"></i>&nbsp;
                                                            Back
                                                        </a>
                                                        <button type="submit" class="btn btn-primary" style="margin-left:10px;">
                                                            <i class="fa fa-check"></i>&nbsp;
                                                            Save
                                                        </button>
                                                    @else
                                                        <a href="{{route('user.product.index')}}" type="button" class="btn btn-danger">
                                                            <i class="fa fa-arrow-left"></i>&nbsp;
                                                            Back
                                                        </a>
                                                        <button type="submit" class="btn btn-primary" style="margin-left:10px;">
                                                            <i class="fa fa-check"></i>&nbsp;
                                                            Save
                                                        </button>
                                                    @endif
                                                </div>
                                            @else
                                                <div class="col-md-10" style="margin-right: 20px;">
                                                    @if(Auth::guard('admin')->check())
                                                        <a href="{{route('admin.product.index')}}" type="button" class="btn btn-danger">
                                                            <i class="fa fa-arrow-left"></i>&nbsp;
                                                            Back
                                                        </a>
                                                    @else
                                                        <a href="{{route('user.product.index')}}" type="button" class="btn btn-danger">
                                                            <i class="fa fa-arrow-left"></i>&nbsp;
                                                            Back
                                                        </a>
                                                    @endif
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
        </div>
    </div>
</body>
</html>
