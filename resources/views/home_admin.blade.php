<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>SMK BAKTI ILHAM</title>
    <link rel="icon" type="image/png" href="{{ asset('images/smk.png') }}"/>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Iconic Bootstrap 4.5.0 Admin Template">
<meta name="author" content="WrapTheme, design by: ThemeMakker.com">
<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

<!-- VENDOR CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/toastr/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/charts-c3/plugin.css') }}">
<!-- MAIN Project CSS file -->
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>
<style>
a.disabled {
    cursor: not-allowed;
    pointer-events: all !important;
}
</style>
<body data-theme="light" class="font-nunito">
<div id="wrapper" class="theme-cyan">

    <!-- Page Loader -->
    {{-- <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img src="assets/images/logo-icon.svg" width="48" height="48" alt="Iconic"></div>
            <p>Please wait...</p>
        </div>
    </div> --}}

    <!-- Top navbar div start -->
    <nav class="navbar navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-brand">
                <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-bars"></i></button>
                <button type="button" class="btn-toggle-fullwidth"><i class="fa fa-bars"></i></button>
                <a href="#">ADMIN PANEL</a>
            </div>

            {{-- <div class="navbar-right">
                <form id="navbar-search" class="navbar-form search-form">
                    <input value="" class="form-control" placeholder="Search here..." type="text">
                    <button type="button" class="btn btn-default"><i class="icon-magnifier"></i></button>
                </form>

                <div id="navbar-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                <i class="fa fa-bell"></i>
                                <span class="notification-dot"></span>
                            </a>
                            <ul class="dropdown-menu notifications">
                                <li class="header"><strong>You have 4 new Notifications</strong></li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <div class="media-left">
                                                <i class="icon-info text-warning"></i>
                                            </div>
                                            <div class="media-body">
                                                <p class="text">Campaign <strong>Holiday Sale</strong> is nearly reach budget limit.</p>
                                                <span class="timestamp">10:00 AM Today</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <div class="media-left">
                                                <i class="icon-like text-success"></i>
                                            </div>
                                            <div class="media-body">
                                                <p class="text">Your New Campaign <strong>Holiday Sale</strong> is approved.</p>
                                                <span class="timestamp">11:30 AM Today</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                 <li>
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <div class="media-left">
                                                <i class="icon-pie-chart text-info"></i>
                                            </div>
                                            <div class="media-body">
                                                <p class="text">Website visits from Twitter is 27% higher than last week.</p>
                                                <span class="timestamp">04:00 PM Today</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <div class="media-left">
                                                <i class="icon-info text-danger"></i>
                                            </div>
                                            <div class="media-body">
                                                <p class="text">Error on website analytics configurations</p>
                                                <span class="timestamp">Yesterday</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="footer"><a href="javascript:void(0);" class="more">See all notifications</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="page-login.html" class="icon-menu"><i class="fa fa-power-off"></i></a>
                        </li>
                    </ul>
                </div>
            </div> --}}
        </div>
    </nav>
    <!-- main left menu -->
    <div id="left-sidebar" class="sidebar">
        <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-arrow-left"></i></button>
        <div class="sidebar-scroll">
            <div class="user-account">
                <img src="{{ asset('assets/images/lg/avatar1.jpg') }}" class="rounded-circle user-photo" alt="User Profile Picture">
                <div class="dropdown">
                    <span>Welcome,</span>
                    <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>{{ Auth::user()->name }}</strong></a>
                    <ul class="dropdown-menu dropdown-menu-right account">
                        <li>
                            <a href="{{ route('logout') }}" class="action-button shadow animate red" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                    </ul>
                </div>
                <hr>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/smk.png') }}" style="width: 18%; left:50%; right:50%;" alt="">
                        &nbsp;&nbsp;&nbsp;&nbsp;Dashboard
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content padding-0">
                <div class="tab-pane active" id="menu">
                    <nav id="left-sidebar-nav" class="sidebar-nav">
                        <ul id="main-menu" class="metismenu li_animation_delay">
                            <li>
                                <a href="#" class="has-arrow"><i class="fa fa-th-large"></i><span>Master Data</span></a>
                                <ul>
                                    {{-- <li><a href="#" class="disabled">Jabatan</a></li> --}}
                                    {{-- <li><a href="#" class="disabled">Pengajar</a></li> --}}
                                    {{-- <li><a href="#" class="disabled">Profesi</a></li> --}}
                                    <li><a href="{{ route('jabatan') }}">Jabatan</a></li>
                                    <li><a href="{{ route('mapel') }}">Mata Pelajaran</a></li>
                                    <li><a href="{{ route('pendidik') }}" >Pegawai</a></li>
                                    <li><a href="{{ route('profesi') }}">Profesi</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="has-arrow"><i class="fa fa-users"></i><span>Kehadiran</span></a>
                                <ul>
                                    <li><a href="{{ route('kehadiran.index') }}">Cek Kehadiran</a></li>
                                    <li><a href="{{ route('kehadiran.report') }}" class="">Report</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="has-arrow"><i class="fa fa-list-alt" ></i><span>Jadwal Pelajaran</span></a>
                                <ul>
                                    <li><a href="{{ route('jadwal') }}" class="">Cek Jadwal</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="tab-pane" id="Chat">
                    <form>
                        <div class="input-group m-b-20">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-magnifier"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                    </form>
                    <ul class="right_chat list-unstyled li_animation_delay">
                        <li>
                            <a href="javascript:void(0);" class="media">
                                <img class="media-object" src="assets/images/xs/avatar1.jpg" alt="">
                                <div class="media-body">
                                    <span class="name d-flex justify-content-between">Chris Fox <i class="fa fa-heart-o font-12"></i></span>
                                    <span class="message">chrisfox@gmail.com</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="media">
                                <img class="media-object" src="assets/images/xs/avatar2.jpg" alt="">
                                <div class="media-body">
                                    <span class="name d-flex justify-content-between">Joge Lucky <i class="fa fa-heart-o font-12"></i></span>
                                    <span class="message">Jogelucky@gmail.com</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="media">
                                <img class="media-object" src="assets/images/xs/avatar3.jpg" alt="">
                                <div class="media-body">
                                    <span class="name d-flex justify-content-between">Isabella <i class="fa fa-heart-o font-12"></i></span>
                                    <span class="message">Isabella@gmail.com</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="media">
                                <img class="media-object" src="assets/images/xs/avatar4.jpg" alt="">
                                <div class="media-body">
                                    <span class="name d-flex justify-content-between">Folisise Chosielie <i class="fa fa-heart font-12"></i></span>
                                    <span class="message">FolisiseChosielie@gmail.com</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="media">
                                <img class="media-object" src="assets/images/xs/avatar5.jpg" alt="">
                                <div class="media-body">
                                    <span class="name d-flex justify-content-between">Alexander <i class="fa fa-heart-o font-12"></i></span>
                                    <span class="message">Alexander@gmail.com</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-pane" id="setting">
                    <h6>Choose Skin</h6>
                    <ul class="choose-skin list-unstyled">
                        <li data-theme="purple"><div class="purple"></div></li>
                        <li data-theme="blue"><div class="blue"></div></li>
                        <li data-theme="cyan" class="active"><div class="cyan"></div></li>
                        <li data-theme="green"><div class="green"></div></li>
                        <li data-theme="orange"><div class="orange"></div></li>
                        <li data-theme="blush"><div class="blush"></div></li>
                        <li data-theme="red"><div class="red"></div></li>
                    </ul>

                    <ul class="list-unstyled font_setting mt-3">
                        <li>
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="font" value="font-nunito" checked="">
                                <span class="custom-control-label">Nunito Google Font</span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="font" value="font-ubuntu">
                                <span class="custom-control-label">Ubuntu Font</span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="font" value="font-raleway">
                                <span class="custom-control-label">Raleway Google Font</span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="font" value="font-IBMplex">
                                <span class="custom-control-label">IBM Plex Google Font</span>
                            </label>
                        </li>
                    </ul>

                    <ul class="list-unstyled mt-3">
                        <li class="d-flex align-items-center mb-2">
                            <label class="toggle-switch theme-switch">
                                <input type="checkbox">
                                <span class="toggle-switch-slider"></span>
                            </label>
                            <span class="ml-3">Enable Dark Mode!</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <label class="toggle-switch theme-rtl">
                                <input type="checkbox">
                                <span class="toggle-switch-slider"></span>
                            </label>
                            <span class="ml-3">Enable RTL Mode!</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <label class="toggle-switch theme-high-contrast">
                                <input type="checkbox">
                                <span class="toggle-switch-slider"></span>
                            </label>
                            <span class="ml-3">Enable High Contrast Mode!</span>
                        </li>
                    </ul>

                    <hr>
                    <h6>General Settings</h6>
                    <ul class="setting-list list-unstyled">
                        <li>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="checkbox" checked>
                                <span>Allowed Notifications</span>
                            </label>
                        </li>
                        <li>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="checkbox">
                                <span>Offline</span>
                            </label>
                        </li>
                        <li>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="checkbox">
                                <span>Location Permission</span>
                            </label>
                        </li>
                    </ul>

                    <a href="#" target="_blank" class="btn btn-block btn-primary">Buy this item</a>
                    <a href="https://themeforest.net/user/wrraptheme/portfolio" target="_blank" class="btn btn-block btn-secondary">View portfolio</a>
                </div>
                <div class="tab-pane" id="question">
                    <form>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-magnifier"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                    </form>
                    <ul class="list-unstyled question">
                        <li class="menu-heading">HOW-TO</li>
                        <li><a href="javascript:void(0);">How to Create Campaign</a></li>
                        <li><a href="javascript:void(0);">Boost Your Sales</a></li>
                        <li><a href="javascript:void(0);">Website Analytics</a></li>
                        <li class="menu-heading">ACCOUNT</li>
                        <li><a href="javascript:void(0);">Cearet New Account</a></li>
                        <li><a href="javascript:void(0);">Change Password?</a></li>
                        <li><a href="javascript:void(0);">Privacy &amp; Policy</a></li>
                        <li class="menu-heading">BILLING</li>
                        <li><a href="javascript:void(0);">Payment info</a></li>
                        <li><a href="javascript:void(0);">Auto-Renewal</a></li>
                        <li class="menu-button mt-3">
                            <a href="../docs/index.html" class="btn btn-primary btn-block">Documentation</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- rightbar icon div -->
    {{-- <div class="right_icon_bar">
        <ul>
            <li><a href="app-inbox.html"><i class="fa fa-envelope"></i></a></li>
            <li><a href="app-chat.html"><i class="fa fa-comments"></i></a></li>
            <li><a href="app-calendar.html"><i class="fa fa-calendar"></i></a></li>
            <li><a href="file-dashboard.html"><i class="fa fa-folder"></i></a></li>
            <li><a href="app-contact.html"><i class="fa fa-id-card"></i></a></li>
            <li><a href="blog-list.html"><i class="fa fa-globe"></i></a></li>
            <li><a href="javascript:void(0);"><i class="fa fa-plus"></i></a></li>
            <li><a href="javascript:void(0);" class="right_icon_btn"><i class="fa fa-angle-right"></i></a></li>
        </ul>
    </div> --}}

    <!-- mani page content body part -->
    <div id="main-content">
        @yield('content')
    </div>

</div>
<!-- Javascript -->
<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script>
<!-- page vendor js file -->
<script src="{{ asset('assets/vendor/toastr/toastr.js') }}"></script>
<script src="{{ asset('assets/bundles/c3.bundle.js') }}"></script>
<!-- page js file -->
<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
<script src="{{ asset('js_iconic/index.js') }}"></script>
@yield('script')
</body>
</html>
