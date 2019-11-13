<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset("assets/img/apple-icon.png")}}">
    <link rel="icon" type="image/png" href="{{asset("assets/img/upclogo.png")}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>
        {{ config('app.name') }}
    </title>
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
    <link href="{{asset("assets/css/material-dashboard.min.css?v=2.1.0")}}" rel="stylesheet"/>
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{asset("assets/demo/demo.css")}}" rel="stylesheet"/>
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

<body class="off-canvas-sidebar">
<!-- Extra details for Live View on GitHub Pages -->
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
    <div class="container">
        <div class="navbar-wrapper">
            <a class="navbar-brand" href="#pablo">Solicitando Tickets</a>
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
                <li class="nav-item ">
                    <a href="{{route('login')}}" class="nav-link">
                        <i class="material-icons">fingerprint</i> Login
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
<div class="wrapper wrapper-full-page">
    <div class="page-header register-page header-filter" filter-color="black"
         style="background-image: url({{asset("assets/img/register.jpg")}})">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-12 mr-auto ml-auto">
                    <!--      Wizard container        -->
                    <div class="wizard-container">
                        <div class="card card-wizard" style="opacity: 1;" data-color="rose" id="wizardProfile">
                            <form action="" method="">
                                <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
                                <div class="card-header text-center">
                                    <h3 class="card-title">
                                        Registro de Ticket
                                    </h3>
                                    <h5 class="card-description">This information will let us know more about you.</h5>
                                </div>
                                <div class="wizard-navigation">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#about" data-toggle="tab" role="tab">
                                                Datos básicos
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#account" data-toggle="tab" role="tab">
                                                Datos de la empresa
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="about">
                                            <h5 class="info-text"> Datos de contacto</h5>
                                            <div class="row justify-content-center">
                                                <div class="col-sm-6" style="margin-top: 21px;">
                                                    <select class="selectpicker  col-md-12"
                                                            data-style="btn btn-primary btn-round btn-block"
                                                            title="Single Select" data-size="20" name="tipopersona"
                                                            requerido>
                                                        <option disabled selected>Tipo de persona</option>
                                                        <option value="natural">Natural</option>
                                                        <option value="juridica">Jurídica</option>
                                                    </select>
                                                    <div class="input-group form-control-lg">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="material-icons">face</i>
                                                            </span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInput11" class="bmd-label-floating">Nombre
                                                                (requerido)</label>
                                                            <input type="text" class="form-control" id="nombreid"
                                                                   name="nombre" requerido>
                                                        </div>
                                                    </div>
                                                    <div class="input-group form-control-lg">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="material-icons">email</i>
                                                            </span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInput1" class="bmd-label-floating">Email
                                                                (requerido)</label>
                                                            <input type="email" class="form-control" id="exampleemalil"
                                                                   name="email" requerido>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="input-group form-control-lg">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="material-icons">payment</i>
                                                            </span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInput1"
                                                                   class="bmd-label-floating">Identificación
                                                                (requerido)</label>
                                                            <input type="number" class="form-control"
                                                                   id="identificacionid"
                                                                   name="identificacion" requerido>
                                                        </div>
                                                    </div>
                                                    <div class="input-group form-control-lg">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="material-icons">record_voice_over</i>
                                                            </span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInput11" class="bmd-label-floating">Apellido
                                                                (requerido)</label>
                                                            <input type="text" class="form-control" id="apellidoid"
                                                                   name="apellido" requerido>
                                                        </div>
                                                    </div>
                                                    <div class="input-group form-control-lg">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="material-icons">call</i>
                                                            </span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInput1"
                                                                   class="bmd-label-floating">Telefono
                                                                (requerido)</label>
                                                            <input type="number" class="form-control" id="telefonoid"
                                                                   name="telefono" requerido>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-10 mt-3">
                                                    <div class="input-group form-control-lg">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="material-icons">map</i>
                                                            </span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInput1"
                                                                   class="bmd-label-floating">Dirección
                                                                (requerido)</label>
                                                            <input type="text" class="form-control" id="direccionid"
                                                                   name="direccion" requerido>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="account">
                                            <h5 class="info-text"> Datos de la Empresa </h5>
                                            <div class="row justify-content-center">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="input-group form-control-lg">
                                                                <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="material-icons">credit_card</i>
                                                            </span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInput1"
                                                                           class="bmd-label-floating">Nit
                                                                        (requerido)</label>
                                                                    <input type="text" class="form-control"
                                                                           id="nitid"
                                                                           name="nit" requerido>
                                                                </div>
                                                            </div>
                                                            <div class="input-group form-control-lg">
                                                                <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="material-icons">view_carousel</i>
                                                            </span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInput1"
                                                                           class="bmd-label-floating">Dependencia
                                                                        (requerido)</label>
                                                                    <input type="text" class="form-control"
                                                                           id="dependenciaid"
                                                                           name="dependencia" requerido>
                                                                </div>
                                                            </div>
                                                            <div class="input-group form-control-lg">
                                                                <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="material-icons">map</i>
                                                            </span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInput1"
                                                                           class="bmd-label-floating">Dirección
                                                                        (requerido)</label>
                                                                    <input type="text" class="form-control"
                                                                           id="direccionemp"
                                                                           name="direccionemp" requerido>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="input-group form-control-lg">
                                                                <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="material-icons">account_balance</i>
                                                            </span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInput1"
                                                                           class="bmd-label-floating">Nombre de la
                                                                        Empresa
                                                                        (requerido)</label>
                                                                    <input type="number" class="form-control"
                                                                           id="empresaid"
                                                                           name="empresa" requerido>
                                                                </div>
                                                            </div>
                                                            <div class="input-group form-control-lg">
                                                                <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="material-icons">email</i>
                                                            </span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInput1"
                                                                           class="bmd-label-floating">Email
                                                                        (requerido)</label>
                                                                    <input type="email" class="form-control"
                                                                           id="emailemp"
                                                                           name="emailempresa" requerido>
                                                                </div>
                                                            </div>
                                                            <div class="input-group form-control-lg">
                                                                <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="material-icons">call</i>
                                                            </span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInput1"
                                                                           class="bmd-label-floating">Telefono
                                                                        (requerido)</label>
                                                                    <input type="number" class="form-control"
                                                                           id="telefonoemp"
                                                                           name="telefonoemp" requerido>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="address">
                                            <div class="row justify-content-center">
                                                <div class="col-sm-12">
                                                    <h5 class="info-text"> Are you living in a nice area? </h5>
                                                </div>
                                                <div class="col-sm-7">
                                                    <div class="form-group">
                                                        <label>Street Name</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Street No.</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-group select-wizard">
                                                        <label>Country</label>
                                                        <select class="selectpicker" data-size="7"
                                                                data-style="select-with-transition"
                                                                title="Single Select">
                                                            <option value="Afghanistan"> Afghanistan</option>
                                                            <option value="Albania"> Albania</option>
                                                            <option value="Algeria"> Algeria</option>
                                                            <option value="American Samoa"> American Samoa</option>
                                                            <option value="Andorra"> Andorra</option>
                                                            <option value="Angola"> Angola</option>
                                                            <option value="Anguilla"> Anguilla</option>
                                                            <option value="Antarctica"> Antarctica</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="mr-auto">
                                        <input type="button" class="btn btn-previous btn-fill btn-default btn-wd"
                                               name="previous" value="Previous">
                                    </div>
                                    <div class="ml-auto">
                                        <input type="button" class="btn btn-next btn-fill btn-info btn-wd" name="next"
                                               value="Siguiente">
                                        <input type="button" class="btn btn-finish btn-fill btn-info btn-wd"
                                               name="finish" value="Finish" style="display: none;">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- wizard container -->
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
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
<script src="{{asset("assets/js/core/jquery.min.js")}}"></script>
<script src="{{asset("assets/js/core/popper.min.js")}}"></script>
<script src="{{asset("assets/js/core/bootstrap-material-design.min.js")}}"></script>
<script src="{{asset("assets/js/plugins/perfect-scrollbar.jquery.min.js")}}"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Chartist JS -->
<script src="{{asset("assets/js/plugins/chartist.min.js")}}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset("assets/js/plugins/bootstrap-notify.js")}}"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{asset("assets/js/plugins/bootstrap-selectpicker.js")}}"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset("assets/js/material-dashboard.min.js?v=2.1.0")}}" type="text/javascript"></script>

<script src="{{asset("assets/js/plugins/jquery.validate.min.js")}}"></script>
<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="{{asset("assets/js/plugins/jquery.bootstrap-wizard.js")}}"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{asset("assets/demo/demo.js")}}"></script>

<script>
    $(document).ready(function () {
        $().ready(function () {
            $sidebar = $('.sidebar');

            $sidebar_img_container = $sidebar.find('.sidebar-background');

            $full_page = $('.full-page');

            $sidebar_responsive = $('body > .navbar-collapse');

            window_width = $(window).width();

            fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

            if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
                if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                    $('.fixed-plugin .dropdown').addClass('open');
                }

            }

            $('.fixed-plugin a').click(function (event) {
                // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                if ($(this).hasClass('switch-trigger')) {
                    if (event.stopPropagation) {
                        event.stopPropagation();
                    } else if (window.event) {
                        window.event.cancelBubble = true;
                    }
                }
            });

            $('.fixed-plugin .active-color span').click(function () {
                $full_page_background = $('.full-page-background');

                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                var new_color = $(this).data('color');

                if ($sidebar.length != 0) {
                    $sidebar.attr('data-color', new_color);
                }

                if ($full_page.length != 0) {
                    $full_page.attr('filter-color', new_color);
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.attr('data-color', new_color);
                }
            });

            $('.fixed-plugin .background-color .badge').click(function () {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                var new_color = $(this).data('background-color');

                if ($sidebar.length != 0) {
                    $sidebar.attr('data-background-color', new_color);
                }
            });

            $('.fixed-plugin .img-holder').click(function () {
                $full_page_background = $('.full-page-background');

                $(this).parent('li').siblings().removeClass('active');
                $(this).parent('li').addClass('active');


                var new_image = $(this).find("img").attr('src');

                if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                    $sidebar_img_container.fadeOut('fast', function () {
                        $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                        $sidebar_img_container.fadeIn('fast');
                    });
                }

                if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                    $full_page_background.fadeOut('fast', function () {
                        $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                        $full_page_background.fadeIn('fast');
                    });
                }

                if ($('.switch-sidebar-image input:checked').length == 0) {
                    var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                    $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                    $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                }
            });

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
<noscript>
    <img height="1" width="1" style="display:none"
         src="https://www.facebook.com/tr?id=111649226022273&ev=PageView&noscript=1"/>
</noscript>
<script>
    $(document).ready(function () {
        md.checkFullPageBackgroundImage();
        // Initialise the wizard
        demo.initMaterialWizard();
        setTimeout(function () {
            $('.card.card-wizard').addClass('active');
        }, 600);
    });
</script>
</body>

</html>
