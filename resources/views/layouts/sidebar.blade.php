<?php
use App\Models\Menu;
?>
<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="blue">
        <a @if (Auth::guard('admin')->check()) href="{{ route('admin.dashboard.index') }}" @else href="{{ route('user.order.index') }}" @endif
            class="logo my-auto" style="margin: auto;">
            <img src="{{ asset('img/fathscooter.png') }}" width="130" alt="navbar brand" class="navbar-brand">
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
            data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
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
                    ->where('deleted_at', null)
                    ->orderBy('updated_at', 'desc');

                $notif_all = $getnotif->limit(3)->get();
                ?>
                @if (Auth::guard('admin')->check())
                    <li class="nav-item dropdown hidden-caret">
                        <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="notification">
                                <b>
                                    {{ $getnotif->count() }}
                                </b>
                            </span>
                        </a>
                        <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown"
                            style="min-width: 23rem !important;">
                            <li>
                                <div class="dropdown-title">Notifications</div>
                            </li>
                            @if ($getnotif->count() != 0)
                                <li>
                                    <div class="notif-scroll scrollbar-outer">
                                        <div class="notif-center">

                                            @foreach ($notif_all as $notif)
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
                                    <a class="see-all" href="{{ route('admin.notif.index') }}">See All Notifications<i
                                            class="fa fa-angle-right"></i> </a>
                                </li>
                            @else
                                <li>
                                    <div class="notif-scroll scrollbar-outer">
                                        <div class="notif-center">
                                            <span class="see-all"
                                                style="margin-left:auto !important; margin-right:auto !important; justify-content:center !important">
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
                            @if (Auth::guard('admin')->check())
                                <img src="{{ asset('img/admin.png') }}" style="background-color:white;" alt="..."
                                    class="avatar-img rounded-circle">
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
                                        @if (Auth::guard('admin')->check())
                                            <img src="{{ asset('img/admin.png') }}" style="background-color:white;"
                                                alt="..." class="avatar-img rounded-circle">
                                        @else
                                            <img src="{{ asset('img/user.png') }}" alt="..."
                                                class="avatar-img rounded-circle">
                                        @endif
                                    </div>
                                    <div class="u-text">
                                        <h4>{{ Auth::user()->name }}</h4>
                                        <p class="text-muted"><b>{{ Auth::user()->role->role }}</b></p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('login.logout') }}" class="dropdown-item">Logout</a>
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
            <ul class="nav nav-primary">
                @foreach (Menu::listMenu() as $generate)
                    @if (Auth::guard($generate['auth'])->check())
                        @foreach ($generate['menu'] as $menus)
                            <li class="nav-section">
                                <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                </span>
                                <h4 class="text-section">{{ $menus['title'] }}</h4>
                            </li>
                            @foreach ($menus['list_menu'] as $list_menu)
                                <?php
                                    $explode_menus = explode('.', $list_menu['route']);
                                    $explode_route = explode('.', \Request::route()->getName());
                                ?>
                                <li class="nav-item @if (\Request::route()->getName() == $list_menu['route'] || $explode_menus[1] == $explode_route[1]) active @endif">
                                    <a href="{{ route($list_menu['route']) }}" aria-expanded="false">
                                        <i class="fas {{ $list_menu['icon'] }}"></i>
                                        <p>{{ $list_menu['display_name'] }}</p>
                                    </a>
                                </li>
                            @endforeach
                        @endforeach
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
