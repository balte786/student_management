<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet" />
    <link href="{{ asset('dist-assets/css/themes/lite-purple.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist-assets/css/plugins/perfect-scrollbar.min.css') }}" rel="stylesheet" />
    {{--<title>Dashboard | PCN State Office : Lagos</title>--}}
</head>

<body class="text-left">
<div class="app-admin-wrap layout-sidebar-compact sidebar-dark-purple sidenav-open clearfix">
    <div class="side-content-wrap">
        <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
            <ul class="navigation-left">

                <li class="nav-item  active" data-item="admin">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-Bar-Chart"></i>
                        <span class="nav-text">Admin</span>
                    </a>
                    <div class="triangle"></div>
                </li>

            </ul>
        </div>
        <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
            <i class="sidebar-close i-Close" (click)="toggelSidebar()"></i>
            <header>
                <div class="logo">
                    <img src="{{ asset('dist-assets/images/logo.png') }}" alt="">
                </div>
            </header>
            <!-- Submenu Dashboards -->



            <div class="submenu-area" data-parent="admin">
                <header>
                    <h6>PCN Education</h6>
                    <p>{{Auth::user()->first_name}}</p>

                </header>
                <ul class="childNav">
                    <li class="nav-item">

                        <?php

                        $user = Auth::user();
                        if($user->admin==1){

                            $urlwillbe  =   "dashboard";
                            $profileurl =   "admin/profile";
                        }else{

                            $urlwillbe  =   "dashboard";
                            $profileurl =   "profile";
                        }

                        ?>

                        <a href="{{url($urlwillbe)}}">
                            <i class="nav-icon i-Bar-Chart"></i>
                            <span class="item-name">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url($profileurl) }}">
                            <i class="nav-icon i-Bar-Chart"></i>
                            <span class="item-name">Profile</span>
                        </a>
                    </li>

                    @if(Auth::user()->admin==1)
                    <li class="nav-item">
                        <a href="{{ url('admin-users') }}">
                            <i class="nav-icon i-Receipt-4"></i>
                            <span class="item-name">Admin Users</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin-schools') }}">
                            <i class="nav-icon i-Receipt-4"></i>
                            <span class="item-name">Schools</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin-schools-profiles') }}">
                            <i class="nav-icon i-Receipt-4"></i>
                            <span class="item-name">Schools Profile Users</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/quota') }}">
                            <i class="nav-icon i-Receipt-4"></i>
                            <span class="item-name">Quota Management</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{url('admin-index-list')}}">
                            <i class="nav-icon i-Receipt-4"></i>
                            <span class="item-name">Index Management</span>
                        </a>
                    </li>
                        @else
                        <li class="nav-item">
                            <a href="{{ url('school-index-list') }}">
                                <i class="nav-icon i-Receipt-4"></i>
                                <span class="item-name">Index Number</span>
                            </a>
                        </li>
                    @endif

                </ul>
            </div>

        </div>
    </div>
<!--=============== Left side End ================-->
    <div class="main-content-wrap d-flex flex-column">
        <div class="main-header">
            <div class="logo">
                <img src="{{ asset('dist-assets/images/logo.png') }}" alt="">
            </div>
            <div class="menu-toggle">
                <div></div>
                <div></div>
                <div></div>
            </div>

            <div style="margin: auto"></div>
            <div class="header-part-right">
                <!-- Full screen toggle -->
                <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i>
                <!-- Grid menu Dropdown -->


                <!-- User avatar dropdown -->
                <div class="dropdown">
                    <div class="user col align-self-end">
                        <img src="{{ asset('dist-assets/images/faces/1.jpg') }}" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <div class="dropdown-header">
                                <i class="i-Lock-User mr-1"></i> {{Auth::user()->first_name}} {{Auth::user()->last_name}}
                            </div>



                            <a class="dropdown-item" href="{{url($profileurl)}}">Profile Settings</a>
                            <a class="dropdown-item" href="#">Billing History</a>
                            <a class="dropdown-item" href="{{ route('logout') }}">Sign Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- ============ Body content start ============= -->
        @yield('content')
</div>
</div>
<script src="{{ asset('dist-assets/js/plugins/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('dist-assets/js/plugins/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist-assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('dist-assets/js/scripts/script.min.js') }}"></script>
<script src="{{ asset('dist-assets/js/scripts/sidebar.compact.script.min.js') }}"></script>
<script src="{{ asset('dist-assets/js/scripts/customizer.script.min.js') }}"></script>
<script src="{{ asset('dist-assets/js/plugins/echarts.min.js') }}"></script>
<script src="{{ asset('dist-assets/js/scripts/echart.options.min.js') }}"></script>
<script src="{{ asset('dist-assets/js/plugins/datatables.min.js') }}"></script>
<script src="{{ asset('dist-assets/js/scripts/datatables.script.min.js') }}"></script>
<script src="{{ asset('dist-assets/js/scripts/dashboard.v2.script.min.js') }}"></script>


</body>

</html>
