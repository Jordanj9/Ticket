<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset("assets/img/apple-icon.png")}}">
    <link rel="icon" type="image/png" href="{{asset("assets/img/favicon.png")}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!-- Extra details for Live View on GitHub Pages -->
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://www.creative-tim.com/product/material-dashboard-pro"/>
    <!--  Social tags      -->
    <meta name="keywords"
          content="creative tim, html dashboard, html css dashboard, web dashboard, bootstrap 4 dashboard, bootstrap 4, css3 dashboard, bootstrap 4 admin, material dashboard bootstrap 4 dashboard, frontend, responsive bootstrap 4 dashboard, material design, material dashboard bootstrap 4 dashboard">
    <meta name="description"
          content="Material Dashboard PRO is a Premium Material Bootstrap 4 Admin with a fresh, new design inspired by Google's Material Design.">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Material Dashboard PRO by Creative Tim">
    <meta itemprop="description"
          content="Material Dashboard PRO is a Premium Material Bootstrap 4 Admin with a fresh, new design inspired by Google's Material Design.">
    <meta itemprop="image"
          content="https://s3.amazonaws.com/creativetim_bucket/products/51/original/opt_mdp_thumbnail.jpg">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@creativetim">
    <meta name="twitter:title" content="Material Dashboard PRO by Creative Tim">
    <meta name="twitter:description"
          content="Material Dashboard PRO is a Premium Material Bootstrap 4 Admin with a fresh, new design inspired by Google's Material Design.">
    <meta name="twitter:creator" content="@creativetim">
    <meta name="twitter:image"
          content="https://s3.amazonaws.com/creativetim_bucket/products/51/original/opt_mdp_thumbnail.jpg">
    <!-- Open Graph data -->
    <meta property="fb:app_id" content="655968634437471">
    <meta property="og:title" content="Material Dashboard PRO by Creative Tim"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="http://demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html"/>
    <meta property="og:image"
          content="https://s3.amazonaws.com/creativetim_bucket/products/51/original/opt_mdp_thumbnail.jpg"/>
    <meta property="og:description"
          content="Material Dashboard PRO is a Premium Material Bootstrap 4 Admin with a fresh, new design inspired by Google's Material Design."/>
    <meta property="og:site_name" content="Creative Tim"/>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{asset('assets/css/material-dashboard.min.css?v=2.1.0')}}" rel="stylesheet"/>
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{asset('assets/demo/demo.css')}}" rel="stylesheet"/>
    <!-- JQuery DataTable Css -->
    <link href="{{asset('css/dataTables.bootstrap.css')}}" rel="stylesheet">
    <!-- Google Tag Manager -->
    <script>
        (function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-NKDMSK6');
    </script>
    <!-- End Google Tag Manager -->
</head>

<body class="">
<!-- Extra details for Live View on GitHub Pages -->
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="wrapper ">
    <div class="sidebar" data-color="green" data-background-color="white"
         data-image="{{asset('assets/img/sidebar-1.jpg')}}">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

          Tip 2: you can also add an image using data-image tag
      -->
        <div class="logo">
            <a href="{{route('home')}}" class="logo-mini"
               style="text-align: center; color: black; font-size: 35px; font-family: inherit">
                <strong>TK</strong>
            </a>
            <a href="{{route('home')}}" class="logo-normal"
               style="text-align: center; color: black; font-size: 35px; font-family: inherit">
                <strong>TicKets</strong>
            </a>
        </div>
        <div class="sidebar-wrapper">
            <div class="user">
                <div class="photo">
                    <img src="{{asset("assets/img/faces/avatar.jpg")}}"/>
                </div>
                <div class="user-info">
                    <a data-toggle="collapse" href="#collapseExample" class="username">
                                <span>
                                    {{Auth::user()->nombres}}</br>{{Auth::user()->apellidos}}
                                </span>
                    </a>
                </div>
            </div>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('inicio')}}">
                        <i class="fa fa-home"></i>
                        <p> Inicio </p>
                    </a>
                </li>

                @if($location=='usuarios')
                    <li class="nav-item active">
                @else
                    <li class="nav-item">
                @endif
                        <a class="nav-link" href="{{route('admin.usuarios')}}">
                            <i class="material-icons">supervised_user_circle</i>
                            <p> Usuario </p>
                        </a>
                    </li>

                    @if($location=='general')
                        <li class="nav-item active">
                    @else
                        <li class="nav-item">
                    @endif
                            <a class="nav-link"  href="{{route('admin.general')}}">
                                <i class="material-icons">account_balance</i>
                                <p> General</p>
                            </a>
                        </li>

                @if($location=='mantenimiento')
                    <li class="nav-item active">
                @else
                    <li class="nav-item">
                @endif
                    <a class="nav-link" href="#componentsExamples">
                        <i class="material-icons">assignment</i>
                        <p>Mantenimiento</p>
                    </a>
                </li>
                        <li class="nav-item ">
                            <a class="nav-link" data-toggle="collapse" href="#formsExamples">
                                <i class="material-icons">trending_up</i>
                                <p> Reportes</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" data-toggle="collapse" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form2').submit();">
                                <i class="fa fa-sign-out"></i> Salir
                            </a>
                            <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                            <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                            <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                        </button>
                    </div>
                    <a class="navbar-brand" href="#pablo">Gestión de Tickets</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">person</i>
                                <p class="d-lg-none d-md-block">
                                    Account
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                <a class="dropdown-item" href="#">Profile</a>
                                <a class="dropdown-item" href="#">Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" data-toggle="collapse" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form2').submit();">
                                    <i class="fa fa-sign-out"></i> Salir
                                </a>
                                <form id="logout-form2" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <section class="content">
            @yield('breadcrumb')
            <div class="container-fluid">
                <div class="block-header">
                    <div class="col-md-12">
                        @include('flash::message')
                    </div>
                    @yield('content')
                </div>
            </div>
        </section>
        <footer class="footer">
            <div class="container-fluid">
                <div class="copyright float-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    , versión 1.0 Desarollado por
                    <a href="" target="_blank">Jordan Cuadro, Camilo Colón & Alberto Rojas</a>.
                </div>
            </div>
        </footer>
    </div>
</div>
<!--   Core JS Files   -->
<script src="{{asset('assets/js/core/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap-material-design.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<!-- Plugin for the momentJs  -->
<script src="{{asset('assets/js/plugins/moment.min.js')}}"></script>
<!--  Plugin for Sweet Alert -->
<script src="{{asset('assets/js/plugins/sweetalert2.js')}}"></script>
<!-- Forms Validations Plugin -->
<script src="{{asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="{{asset('assets/js/plugins/jquery.bootstrap-wizard.js')}}"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="{{asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
<script src="{{asset('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="{{asset('assets/js/plugins/bootstrap-tagsinput.js')}}"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{asset('assets/js/plugins/jasny-bootstrap.min.js')}}"></script>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="{{asset('assets/js/plugins/fullcalendar.min.js')}}"></script>
<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="{{asset('assets/js/plugins/jquery-jvectormap.js')}}"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{asset('assets/js/plugins/nouislider.min.js')}}"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<!-- Library for adding dinamically elements -->
<script src="{{asset('assets/js/plugins/arrive.min.js')}}"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Chartist JS -->
<script src="{{asset('assets/js/plugins/chartist.min.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('assets/js/plugins/bootstrap-notify.js')}}"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('assets/js/material-dashboard.min.js?v=2.1.0')}}" type="text/javascript"></script>
<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('assets/js/plugins/jquery.dataTables.min.js')}}"></script>

<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{asset('assets/demo/demo.js')}}"></script>
<script>
    $(document).ready(function () {
        $().ready(function () {
            $sidebar = $('.sidebar');

            $sidebar_img_container = $sidebar.find('.sidebar-background');

            $full_page = $('.full-page');

            $sidebar_responsive = $('body > .navbar-collapse');

            window_width = $(window).width();

            fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

            $('.switch-sidebar-image input').change(function () {
                $full_page_background = $('.full-page-background');

                $input = $(this);

                if ($input.is(':checked')) {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar_img_container.fadeIn('fast');
                        $sidebar.attr('data-image', '#');
                    }

                    if ($full_page_background.length != 0) {
                        $full_page_background.fadeIn('fast');
                        $full_page.attr('data-image', '#');
                    }

                    background_image = true;
                } else {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar.removeAttr('data-image');
                        $sidebar_img_container.fadeOut('fast');
                    }

                    if ($full_page_background.length != 0) {
                        $full_page.removeAttr('data-image', '#');
                        $full_page_background.fadeOut('fast');
                    }

                    background_image = false;
                }
            });

            $('.switch-sidebar-mini input').change(function () {
                $body = $('body');

                $input = $(this);

                if (md.misc.sidebar_mini_active == true) {
                    $('body').removeClass('sidebar-mini');
                    md.misc.sidebar_mini_active = false;

                    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

                } else {

                    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

                    setTimeout(function () {
                        $('body').addClass('sidebar-mini');

                        md.misc.sidebar_mini_active = true;
                    }, 300);
                }

                // we simulate the window Resize so the charts will get updated in realtime.
                var simulateWindowResize = setInterval(function () {
                    window.dispatchEvent(new Event('resize'));
                }, 180);

                // we stop the simulation of Window Resize after the animations are completed
                setTimeout(function () {
                    clearInterval(simulateWindowResize);
                }, 1000);

            });
        });
    });
</script>
<!-- Sharrre libray -->
<script src="{{asset('assets/demo/jquery.sharrre.js')}}"></script>
<script>
    $(document).ready(function () {


    });
</script>

@yield('script')
</body>

</html>
