<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="blue">
        <a @if(Auth::guard('admin')->check()) href="{{route('admin.dashboard.index')}}" @else href="{{route('user.order.index')}}" @endif class="logo mt-2">
            <center>
                <span style="display:flex;">
                    <img src="{{ asset('img/fathscooter.png') }}" style="margin: 2px auto; padding:5px; width: 65%;" alt="navbar brand" class="navbar-brand">
                </span>
            </center>
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>

    </div>
    <!-- End Logo Header -->
    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <?php

                    $getnotif = DB::table('product')
                                ->where('stock', '<=', 2)
                                ->where('deleted_at',null)
                                ->orderBy('updated_at', 'desc');

                    $notif_all = $getnotif->limit(5)->get();
                ?>
                @if(Auth::guard('admin')->check())
                <li class="nav-item dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        <span class="notification">
                            <b>
                                {{ $getnotif->count() }}
                            </b>
                        </span>
                    </a>
                    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown" style="min-width: 22rem !important;">
                        <li>
                            <div class="dropdown-title">Notifications</div>
                        </li>
                        @if( $getnotif->count() != 0)
                        <li>
                            <div class="notif-scroll scrollbar-outer">
                                <div class="notif-center">

                                        @foreach($notif_all as $notif)
                                        <a href="{{ route('admin.product.index') }}">
                                            <div class="notif-icon notif-danger">
                                                <i class="fa fa-exclamation-triangle"></i>
                                            </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    <b>
                                                        {{ $notif->product_name }}
                                                    </b>
                                                </span>
                                                <span class="block">
                                                    Stock is Running Out!
                                                </span>
                                            </div>
                                        </a>
                                        @endforeach
                                </div>
                            </div>
                        </li>
                        <li>
                            <a class="see-all" href="{{route('admin.notif.index')}}">See All Notifications<i class="fa fa-angle-right"></i> </a>
                        </li>
                        @else
                        <li>
                            <div class="notif-scroll scrollbar-outer">
                                <div class="notif-center">
                                    <span class="see-all" style="margin-left:auto !important; margin-right:auto !important; justify-content:center !important">
                                        <center>
                                            No Notifications Available
                                        </center>
                                    </span>
                                </div>
                            </div>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            @if(Auth::guard('admin')->check())
                                <img src="{{ asset('img/admin.png') }}" style="background-color:white;" alt="..." class="avatar-img rounded-circle">
                            @else
                                <img src="{{ asset('img/user.png') }}" alt="..." class="avatar-img rounded-circle">
                            @endif
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        @if(Auth::guard('admin')->check())
                                            <img src="{{ asset('img/admin.png') }}" style="background-color:white;" alt="..." class="avatar-img rounded-circle">
                                        @else
                                            <img src="{{ asset('img/user.png') }}" alt="..." class="avatar-img rounded-circle">
                                        @endif
                                    </div>
                                    <div class="u-text">
                                        <h4>{{Auth::user()->name}}</h4>
                                        <p class="text-muted"><b>{{Auth::user()->role->role}}</b></p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <form action="{{url('/auth/logout')}}" method="post">
                                    @csrf
                                    <button class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>
<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            {{-- <div class="user">
                <div class="avatar-sm float-left mr-2">
                @if(Auth::guard('admin')->check())
                    <img src="{{ asset('img/admin.png') }}" alt="..." class="avatar-img rounded-circle">
                @else
                    <img src="{{ asset('img/user.png') }}" alt="..." class="avatar-img rounded-circle">
                @endif
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{Auth::user()->name}}
                            <span class="user-level">{{Auth::user()->role->role}}</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <form action="{{url('/auth/logout')}}" method="post">
                                    @csrf
                                    <button class="link-collapse" style="background: none;border: none;">Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> --}}
            <ul class="nav nav-primary">
            @if(Auth::guard('admin')->check())
                <li class="nav-item {{ $title === 'Dashboard' ? 'active' : '' }}">
                    <a href="{{route('admin.dashboard.index')}}" aria-expanded="false">
                        <i class="fas fa-chart-bar"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ $title === 'Analysis' || $title === 'Add Analysis' || $title === 'Edit Analysis' || $title === 'Detail Analysis' || $title === 'Summary Analysis'? 'active' : '' }}">
                    <a href="{{route('admin.analysis.index')}}" aria-expanded="false">
                        <i class="fas fa-chart-line"></i>
                        <p>Analysis</p>
                    </a>
                </li>
                <li class="nav-item {{ $title === 'List Order' || $title === 'Add Order' || $title === 'Edit Order' || $title === 'Detail Order'? 'active' : '' }}">
                    <a href="{{route('admin.order.index')}}" aria-expanded="false">
                        <i class="fas fa-clipboard-list"></i>
                        <p>Order</p>
                    </a>
                </li>
                <li class="nav-item {{ $title === 'List Products' || $title === 'Add Products' || $title === 'Edit Products' || $title === 'Detail Products'? 'active' : '' }}">
                    <a href="{{route('admin.product.index')}}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-boxes"></i>
                        <p>Product</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Master Data</h4>
                </li>
                <li
                    class="nav-item {{ $title === 'List Supplier' || $title === 'Add Supplier' || $title === 'Edit Supplier' || $title === 'Detail Supplier'? 'active' : '' }}">
                    <a href="{{route('admin.supplier.index')}}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-warehouse"></i>
                        <p>Master Supplier</p>
                    </a>
                </li>
                <li class="nav-item {{ $title === 'List Category Product' || $title === 'Add Category Product' || $title === 'Edit Category Product' || $title === 'Detail Category Product'? 'active' : '' }}">
                    <a href="{{route('admin.category.index')}}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-th"></i>
                        <p>Master Category</p>
                    </a>
                </li>
                <li
                    class="nav-item {{ $title === 'List Source Payment' || $title === 'Add Source Payment' || $title === 'Edit Source Payment' || $title === 'Detail Source Payment'? 'active' : '' }}">
                    <a href="{{route('admin.source_payment.index')}}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-wallet"></i>
                        <p>Master Payment</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">User Management</h4>
                </li>
                <li class="nav-item {{ $title === 'List User' || $title === 'Add User' || $title === 'Edit User' || $title === 'Detail User'? 'active' : '' }}"">
                    <a href="{{route('admin.users.index')}}" class="collapsed" aria-expanded="false">
                        <i class="fa fa-user-plus"></i>
                        <p>Create User</p>
                    </a>
                </li>
                <li class="nav-item {{ $title === 'List User Roles' || $title === 'Add User Roles' || $title === 'Edit User Roles' || $title === 'Detail User Roles'? 'active' : '' }}">
                    <a href="{{route('admin.role.index')}}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-user-cog"></i>
                        <p>User Role</p>
                    </a>
                </li>
            @else
                <li class="nav-item {{ $title === 'List Order' || $title === 'Add Order' || $title === 'Edit Order' || $title === 'Detail Order'? 'active' : '' }}">
                    <a href="{{route('user.order.index')}}" aria-expanded="false">
                        <i class="fas fa-clipboard-list"></i>
                        <p>Order</p>
                    </a>
                </li>
                <li class="nav-item {{ $title === 'List Products' || $title === 'Add Products' || $title === 'Edit Products' || $title === 'Detail Products'? 'active' : '' }}">
                    <a href="{{route('user.product.index')}}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-boxes"></i>
                        <p>Product</p>
                    </a>
                </li>
            @endif
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
