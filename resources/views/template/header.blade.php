<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Dashboard | Remark Material Admin Template</title>

    <link rel="apple-touch-icon" href="{{ asset('public/themeforest/page-base/images/apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('public/themeforest/page-base/images/favicon.ico') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/css/bootstrap-extend.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/page-base/css/site.min.css') }}">

    <!-- Plugins -->
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/animsition/animsition.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/asscrollable/asScrollable.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/switchery/switchery.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/intro-js/introjs.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/slidepanel/slidePanel.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/flag-icon-css/flag-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/waves/waves.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/chartist/chartist.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/bootstrap-tokenfield/bootstrap-tokenfield.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/bootstrap-select/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/switchery/switchery.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/asrange/asRange.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/ionrangeslider/ionrangeslider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/asspinner/asSpinner.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/clockpicker/clockpicker.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/ascolorpicker/asColorPicker.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/bootstrap-touchspin/bootstrap-touchspin.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/jquery-labelauty/jquery-labelauty.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/bootstrap-maxlength/bootstrap-maxlength.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/timepicker/jquery-timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/jquery-strength/jquery-strength.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/multi-select/multi-select.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/typeahead-js/typeahead.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/blueimp-file-upload/jquery.fileupload.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/dropify/dropify.css') }}">

    <link rel="stylesheet" href="{{ asset('public/themeforest/page-base/examples/css/dashboard/v1.css') }}">

    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/formvalidation/formValidation.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/page-base//examples/css/forms/validation.css') }}">

    <link rel="stylesheet" href="{{ asset('public/themeforest/page-base/examples/css/forms/advanced.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/page-base/examples/css/advanced/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/webui-popover/webui-popover.css') }}">

    @yield('css')

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/fonts/material-design/material-design.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themeforest/global/fonts/brand-icons/brand-icons.min.css') }}">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

    <!--[if lt IE 9]>
    <script src="{{ asset('public/themeforest/global/vendor/html5shiv/html5shiv.min.js') }}"></script>
    <![endif]-->

    <!--[if lt IE 10]>
    <script src="{{ asset('public/themeforest/global/vendor/media-match/media.match.min.js') }}"></script>
    <script src="{{ asset('public/themeforest/global/vendor/respond/respond.min.js') }}"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="{{ asset('public/themeforest/global/vendor/breakpoints/breakpoints.js') }}"></script>
    <script>
        Breakpoints();
    </script>
</head>

<body class="animation {{ $bodyType ?? 'dashboard' }}">
    <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
        <div class="navbar-header">
            <a class="navbar-toggler md-arrow-left navbar-toggler-left" href="{{ url('/') }}">
            </a>

            <button type="button" class="navbar-toggler" data-target="#site-navbar-collapse" data-toggle="collapse" aria-expanded="false">
                <i class="icon md-more" aria-hidden="true"></i>
            </button>

            <div class="navbar-brand navbar-brand-center">
                <a class="brand" href="{{ url('/') }}">
                    <img class="navbar-brand-logo" src="{{ asset('public/themeforest/page-base/images/logo.png') }}" title="Remark">
                    <span class="navbar-brand-text hidden-xs-down white">ECommerce</span>
                </a>
            </div>
        </div>

        <div class="navbar-container container-fluid">
            <!-- Navbar Collapse -->
            <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
                <!-- Navbar Toolbar -->
                <ul class="nav navbar-toolbar">
                    @if (url()->current() !== url('/'))
                    <li class="nav-item hidden-float" id="toggleMenubar">
                        <a class="nav-link" @if ((Auth::user()->group_id ?? '') === 'ADMINISTRATOR') data-toggle="menubar" @endif
                            href="javascript:history.go(-1)">
                            <i class="icon @if ((Auth::user()->group_id ?? '') === 'ADMINISTRATOR') hamburger hamburger-arrow-left @else md-arrow-left @endif ">
                                <span class="sr-only">Toggle menubar</span>
                                <span class="hamburger-bar"></span>
                            </i>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item hidden-sm-down" id="toggleFullscreen">
                        <a class="nav-link icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
                            <span class="sr-only">Toggle fullscreen</span>
                        </a>
                    </li>
                </ul>
                <!-- End Navbar Toolbar -->

                <!-- Navbar Toolbar Right -->
                <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                    @if (url()->current() === url('/') || url()->current() === url('/index-tabel'))
                    <li class="nav-item">
                        <a class="nav-link icon md-search" data-toggle="collapse" href="#" data-target="#site-navbar-search" role="button">
                            <span class="sr-only">Toggle Search</span>
                        </a>
                    </li>

                    <li class="nav-item" id="toggleFilterKatalog">
                        <a class="nav-link icon md-filter-list" data-toggle="modal" data-target="#filterKatalog" href="javascript(void(a))" role="button">
                            <span class="sr-only">Filter Katalog</span>
                        </a>
                    </li>
                    @endif

                    @if (Auth::check())
                    @if (Auth::user()->group_id != 'ADMINISTRATOR')

                    <li class="nav-item dropdown">
                        <a class="nav-link waves-effect waves-light waves-round" data-toggle="dropdown" href="javascript:void(0)" aria-expanded="false" data-animation="scale-up" role="button">
                            <i class="icon md-notifications" aria-hidden="true"></i>
                            <span class="badge badge-pill badge-danger up" id="badge-notification">0</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
                            <div class="dropdown-menu-header">
                                <h5>NOTIFICATIONS</h5>
                            </div>

                            <div class="list-group scrollable is-enabled scrollable-vertical" style="position: relative;">
                                <div data-role="container" class="scrollable-container" style="height: 270px; width: 358px; padding-right: 16px;">
                                    <div data-role="content" class="scrollable-content" style="width: 358px;" id="notification-content">
                                    </div>
                                </div>
                                <div class="scrollable-bar scrollable-bar-vertical scrollable-bar-hide" draggable="false">
                                    <div class="scrollable-bar-handle" style="height: 198.151px; transform: translate3d(0px, 0px, 0px);"></div>
                                </div>
                            </div>

                            <div class="dropdown-menu-footer">
                                <a class="dropdown-menu-footer-btn waves-effect waves-light waves-round" href="javascript:void(0)" role="button">
                                    <i class="icon md-settings" aria-hidden="true"></i>
                                </a>
                                <a class="dropdown-item waves-effect waves-light waves-round" href="javascript:void(0)" role="menuitem">
                                    All notifications
                                </a>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link waves-effect waves-light waves-round" data-toggle="dropdown" href="javascript:void(0)" aria-expanded="false" data-animation="scale-up" role="button">
                            <i class="icon md-shopping-cart" aria-hidden="true"></i>
                            <span class="badge badge-pill badge-danger up badge-cart">0</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
                            <div class="dropdown-menu-header">
                                <h5>KERANJANG SAYA</h5>
                                <span class="badge badge-round badge-primary" style="cursor: pointer; font-size: 15px" data-target="#validasiNotifikasi" data-toggle="modal">Checkout</span>
                            </div>

                            <div class="list-group scrollable is-enabled scrollable-vertical" style="position: relative;">
                                <div data-role="container" class="scrollable-container" style="height: 270px; width: 358px; padding-right: 16px;">
                                    <div data-role="content" class="scrollable-content" style="width: 358px; " id="cart-content">

                                    </div>
                                </div>
                                <div class="scrollable-bar scrollable-bar-vertical scrollable-bar-hide" draggable="false">
                                    <div class="scrollable-bar-handle" style="height: 198.151px; transform: translate3d(0px, 0px, 0px);"></div>
                                </div>
                            </div>
                            <div class="dropdown-menu-footer">
                                <a class="dropdown-menu-footer-btn waves-effect waves-light waves-round" href="javascript:void(0)" role="button">
                                    Rp <span id="nominal-total">0</span>
                                </a>
                                <a class="dropdown-item waves-effect waves-light waves-round" href="javascript:void(0)" role="menuitem">
                                    Total Pesanan
                                </a>
                            </div>
                        </div>
                    </li>
                    @endif

                    <li class="nav-item dropdown">
                        <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false" data-animation="scale-up" role="button">
                        <span class="avatar avatar-online">
                                <img src="{{ asset('public/themeforest/global/portraits/5.jpg') }}" alt="...">
                                <i></i>
                        </span>  
                        </a>
                        <div class="dropdown-menu" role="menu">
                            @if (Auth::user()->group_id != 'ADMINISTRATOR')
                            <span class="username ml-4" style="color: blue">{{ Auth::user()->name }}</span>
                            <a class="dropdown-item" href="{{ url('/profile') }}" role="menuitem"><i class="icon md-account" aria-hidden="true"></i> Profile</a>
                            <a class="dropdown-item" href="{{ url('/order') }}" role="menuitem"><i class="icon md-bike" aria-hidden="true"></i>Pesanan</a>
                            <div class="dropdown-divider" role="presentation"></div>
                            @endif

                            <form action="{{ url('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item" type="submit" role="menuitem" style="color: red">
                                    <i class="icon md-power" aria-hidden="true"></i> Logout
                                </button>
                            </form>
                        </div>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link icon md-sign-in" href="{{ url('login') }}" role="button">
                            <span class="sr-only">Sign in</span>
                        </a>
                    </li>
                    @endif
                </ul>
                <!-- End Navbar Toolbar Right -->
            </div>
            <!-- End Navbar Collapse -->

            <!-- Site Navbar Seach -->
            <div class="collapse navbar-search-overlap" id="site-navbar-search">
                <form id="search_form">
                    <div class="form-group">
                        <div class="input-search">
                            <i class="input-search-icon md-search" aria-hidden="true"></i>
                            <input type="text" class="form-control" id="input_search" name="site-search" placeholder="Search...">
                            <button type="button" class="input-search-close icon md-close" data-target="#site-navbar-search" data-toggle="collapse" aria-label="Close"></button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- End Site Navbar Seach -->
        </div>
    </nav>

    @yield('modal')

    <div class="modal fade" id="filterKatalog" aria-hidden="true" aria-labelledby="examplePositionSidebar" role="dialog">
        <div class="modal-dialog modal-simple modal-sidebar modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" style="color: blue">Filter</h4>

                </div>
                <div class="modal-body">
                    <form id="form_filter" method="get" action="">
                        <div class="d-flex flex-column">
                            <label for="kategori"><b>Kategori</b></label>
                            <select class="form-control" data-plugin="select2" name="kategori" id="kategori">
                                <option  value="" >Pilih Kategori</option>
                                @foreach (App\Category::tree() as $i => $child)
                                <option value="{{ $child['id'] }}">{{ $child['name'] }}</option>
                                @endforeach
                            </select>

                            <label for="kategori" style="margin-top:10px"><b>Merek</b></label>
                            <select class="form-control" data-plugin="select2" name="merek" id="merek">
                                <option value="">Pilih Merek</option>
                                @foreach (App\Product::all() as $i)
                                <option value="{{ $i['merek'] }}">{{ $i['merek'] }}</option>
                                @endforeach
                            </select>

                            <label for="kategori" style="margin-top:10px"><b>Harga</b></label>
                            <div class="example-wrap">
                                <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                    <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                        <span class="input-group-text" style="color: orange">Rp</span>
                                    </span>
                                    <input type="text" class="form-control" name="hargaMin" id="hargaMin" placeholder="Harga Minimum">
                                </div>
                                <br>
                                <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                    <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                        <span class="input-group-text" style="color: orange">Rp</span>
                                    </span>
                                    <input type="text" class="form-control" name="hargaMax" id="hargaMax" placeholder="Harga Maximum">
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-block" id="btn_filter">Terapkan</button>
                    <button type="reset" class="btn btn-default btn-block" id="reset" style="background: #fb8b34; color: white;">Atur Ulang</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade example-modal-lg modal-3d-sign" id="validasiNotifikasi" aria-hidden="true" aria-labelledby="validasiNotifikasi" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-simple modal-center modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    <h4 class="modal-title" style="color: blue;">Konfirmasi Keranjang Belanja</h4>
                </div>
                <div class="modal-body">
                    <div class="example-wrap">
                        <br>
                        <h4 class="example-title text-center">Daftar Belanja</h4>
                        <div class="example">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th width="5%">No.</th>
                                            <th width="30%">Nama</th>
                                            <th width="20%">Tanggal Pesan</th>
                                            <th width="20%">Catatan</th>
                                            <th width="10%">Qty</th>
                                            <th width="20%">Total Pesanan</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-cart">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" style="cursor: pointer" data-id="${index}" id="btn-buy">Beli Sekarang</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <div class="modal fade example-modal-lg modal-3d-sign" id="purchaseOrder" aria-hidden="true" aria-labelledby="purchaseOrder" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-simple modal-center modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" style="color: blue;">Konfirmasi Pembelian</h4>
                </div>
                <div class="modal-body">
                    <div class="example-wrap">
                        <br>
                        <h4 class="example-title text-center">Daftar pembelian</h4>
                        <div class="example">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th>No.</th>
                                            <th width="30%">Nama</th>
                                            <th width="20%">Catatan</th>
                                            <th>Harga Satuan</th>
                                            <th>Qty</th>
                                            <th>Harga Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody class="pembelian-content">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <table class="table">
                        <tr>
                            <td>
                                <h4>Total :</h4>
                            </td>
                            <td>
                                <h4 class="text-right" style="color: #fb8b34;"><b id="data-harga"></b></h4>
                            </td>
                            <td>
                            </td>
                        </tr>
                    </table>
                    <button type="button" class="btn btn-primary" id="btn-buy-item" style="padding-right: 25px" data-id="-1" data-dismiss="modal">Beli Sekarang</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->