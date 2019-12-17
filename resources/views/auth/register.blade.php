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
    <meta name="keywords"
          content="pctools","mantenimientos barranca">
    <meta name="description"
          content="PC-Tools ">
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

    <style>

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] { -moz-appearance:textfield; }

    </style>
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
            <a class="navbar-brand" href="">Solicitando Tickets</a>
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
                            <form class="form-horizontal" id="formulario" method="POST"
                                  action="{{route('ticket.store')}}">
                            @csrf
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
                                        <li class="nav-item" id="itemempresa">
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
                                                <div class="col-md-6">
                                                    <select class="selectpicker  col-md-12"
                                                            data-style="btn btn-primary btn-round btn-block"
                                                            title="Single Select" data-size="20" name="tipopersona"
                                                            id="tipopersona"
                                                            onchange="verificar(this.value)"
                                                            required="required">
                                                        <option disabled selected>Tipo de persona</option>
                                                        <option value="NATURAL">Natural</option>
                                                        <option value="JURIDICA">Jurídica</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
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
                                                                   name="identificacion" required="required"
                                                                   onblur="consultar()">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
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
                                                                   name="nombre" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
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
                                                                   name="apellido" required="required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
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
                                                                   name="email" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
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
                                                                   name="telefono" required="required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
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
                                                                   name="direccion" required="required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 offset-2">
                                                    <div class="input-group form-control-lg">
                                                        <div class="form-group">
                                                            <label for="exampleInput1"
                                                                   class="bmd-label-floating">Descripción
                                                                (requerido)</label>
                                                            <textarea cols="30" rows="10" class="form-control"
                                                                      id="descripcion"
                                                                      name="descripcion" required="required"></textarea>
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
                                                                           onblur="consultarJuridica()"
                                                                           id="nitid" name="nit" required>
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
                                                                           name="dependencia" required>
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
                                                                           name="direccionemp" required>
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
                                                                    <input type="text" class="form-control"
                                                                           id="empresaid"
                                                                           name="empresa" required="required">
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
                                                                           name="emailempresa" required="required">
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
                                                                           name="telefonoemp" required>
                                                                </div>
                                                            </div>
                                                        </div>
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
                                               id="siguiente">
                                        <input type="button" class="btn btn-finish btn-fill btn-info btn-wd"
                                               name="finish" id="finish" value="Finish">
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
                    <a href="" target="_blank">Skynet Web Design</a>.
                </div>
            </div>
        </footer>
    </div>
</div>
<div id="loader" style="display: none; position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('{{asset("assets/img/images/loader.gif")}}') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;">
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
        $("#account").attr('style', 'display:none');
        $("#finish").attr('style', 'display:none');
        $("#siguiente").attr('value', 'Registrar');
        $("#siguiente").attr('onclick', 'guardar()');
        md.checkFullPageBackgroundImage();
        // Initialise the wizard
        demo.initMaterialWizard();
        var $validator = $('.card-wizard form').validate({
            rules: {
                nombre: {
                    required: true,
                    minlength: 3
                },
                apellido: {
                    required: true,
                    minlength: 3
                },
                tipopersona: {
                    required: true,
                    minlength: 3,
                },
                identificacion: {
                    required: true,
                },
                descripcion: {
                    required: true,
                    minlength: 3,
                },
                telefono: {
                    required: true,
                },
                direccion: {
                    required: true,
                    minlength: 3,
                }
            },

            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
            },
            success: function (element) {
                $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
            },
            errorPlacement: function (error, element) {
                $(element).append(error);
            }
        });
        setTimeout(function () {
            $('.card.card-wizard').addClass('active');
        }, 600);
    });

    function verificar(id) {
        if (id == 'JURIDICA') {
            $("#account").removeAttr('style');
            $("#itemempresa").removeAttr('style');
            $("#siguiente").attr('type', 'button');
            $("#siguiente").attr('value', 'siguiente');
            $("#siguiente").removeAttr('onclick', 'guardar()');
            $("#finish").attr('onclick', 'guardar()');

            $("#dependenciaid").attr('required', 'true');
            $("#empresaid").attr('required', 'true');
            $("#nitid").attr('required', 'true');
            $("#telefonoemp").attr('required', 'true');
            $("#emailemp").attr('required', 'true');
            $("#direccionemp").attr('required', 'true');

        } else {

            $("#itemempresa").attr('style', 'display:none');
            $("#account").attr('style', 'display:none');
            $("#siguiente").attr('value', 'Registrar');
            $("#siguiente").attr('onclick', 'guardar()');
            $("#finish").removeAttr('onclick', 'guardar()');

            $("#dependenciaid").removeAttr('required');
            $("#empresaid").removeAttr('required');
            $("#nitid").removeAttr('required');
            $("#telefonoemp").removeAttr('required');
            $("#emailemp").removeAttr('required');
            $("#direccionemp").removeAttr('required');
        }
    }

    function consultar() {
        var id = $("#identificacionid").val();
        if (id.length > 0) {
            limpiar();
            $.ajax({
                type: 'GET',
                url: '{{url("tickest/consultar/")}}/' + id + "/cliente",
                data: {},
            }).done(function (msg) {
                if (msg.status == "ok") {

                    $("#nombreid").val(msg.response.nom).trigger("change");
                    $("#nombreid").closest('.form-group').removeClass('has-danger').addClass('has-success');
                    $("#apellidoid").val(msg.response.ape).trigger("change");
                    $("#apellidoid").closest('.form-group').removeClass('has-danger').addClass('has-success');
                    $("#telefonoid").val(msg.response.tel).trigger("change");
                    $("#telefonoid").closest('.form-group').removeClass('has-danger').addClass('has-success');
                    $("#exampleemalil").val(msg.response.corr).trigger("change");
                    $("#exampleemalil").closest('.form-group').removeClass('has-danger').addClass('has-success');
                    $("#direccionid").val(msg.response.dir).trigger("change");
                    $("#direccionid").closest('.form-group').removeClass('has-danger').addClass('has-success');
                    $("#tipopersona").val(msg.response.tipo).trigger("change");

                    if (msg.response.tipo == 'JURIDICA') {
                        $("#nitid").val(msg.response.nit).trigger("change");
                        $("#nitid").closest('.form-group').removeClass('has-danger').addClass('has-success');
                        $("#empresaid").val(msg.response.empresa).trigger("change");
                        $("#empresaid").closest('.form-group').removeClass('has-danger').addClass('has-success');
                        $("#dependenciaid").val(msg.response.dependencia).trigger("change");
                        $("#dependenciaid").closest('.form-group').removeClass('has-danger').addClass('has-success');
                        $("#telefonoemp").val(msg.response.telefonoemp).trigger("change");
                        $("#telefonoemp").closest('.form-group').removeClass('has-danger').addClass('has-success');
                        $("#emailemp").val(msg.response.emailempresa).trigger("change");
                        $("#emailemp").closest('.form-group').removeClass('has-danger').addClass('has-success');
                        $("#direccionemp").val(msg.response.direccionemp).trigger("change");
                        $("#direccionemp").closest('.form-group').removeClass('has-danger').addClass('has-success');

                        // $("#dependenciaid").val(msg.response.dependencia).trigger("change");
                        // $("#dependenciaid").closest('.form-group').removeClass('has-danger').addClass('has-success');
                        // $("#empresaid").val(msg.response.empresa).trigger("change");
                        // $("#empresaid").closest('.form-group').removeClass('has-danger').addClass('has-success');
                        // $("#nitid").val(msg.response.nit).trigger("change");
                        // $("#nitid").closest('.form-group').removeClass('has-danger').addClass('has-success');
                        // $("#telefonoemp").val(msg.response.telefonoemp).trigger("change");
                        // $("#telefonoemp").closest('.form-group').removeClass('has-danger').addClass('has-success');
                        // $("#emailemp").val(msg.response.emailempresa).trigger("change");
                        // $("#emailemp").closest('.form-group').removeClass('has-danger').addClass('has-success');
                        // $("#direccionemp").val(msg.response.direccionemp).trigger("change");
                        // $("#direccionemp").closest('.form-group').removeClass('has-danger').addClass('has-success');
                    }
                }
            });
        }
    }

    function consultarJuridica() {
        var id = $("#nitid").val();
        if (id.length > 0) {
            $.ajax({
                type: 'GET',
                url: '{{url("tickest/consultar/")}}/' + id + "/juridica",
                data: {},
            }).done(function (msg) {
                if (msg.status == "ok") {
                    $("#empresaid").val(msg.response.empresa).trigger("change");
                    $("#empresaid").closest('.form-group').removeClass('has-danger').addClass('has-success');
                    $("#telefonoemp").val(msg.response.telefonoemp).trigger("change");
                    $("#telefonoemp").closest('.form-group').removeClass('has-danger').addClass('has-success');
                    $("#emailemp").val(msg.response.emailempresa).trigger("change");
                    $("#emailemp").closest('.form-group').removeClass('has-danger').addClass('has-success');
                    $("#direccionemp").val(msg.response.direccionemp).trigger("change");
                    $("#direccionemp").closest('.form-group').removeClass('has-danger').addClass('has-success');
                }
            });
        }
    }

    function limpiar() {
        $("#nombreid").val("").trigger('change');
        $("#apellidoid").val("").trigger('change');
        $("#telefonoid").val("").trigger('change');
        $("#exampleemalil").val("").trigger('change');
        $("#direccionid").val("").trigger('change');
        $("#direccionemp").val("").trigger('change');
        $("#nitid").val("").trigger('change');
        $("#telefonoemp").val("").trigger('change');
        $("#emailemp").val("").trigger('change');
        $("#empresaid").val("").trigger('change');
        $("#dependenciaid").val("").trigger('change');
        $("#descripcion").val("").trigger('change');
    }

    function inhabilitar() {
        $("#nombreid").attr('disabled', true);
        $("#apellidoid").attr('disabled', true);
        $("#telefonoid").attr('disabled', true);
        $("#email").attr('disabled', true);
        $("#direccionid").attr('disabled', true);
    }

    function guardar() {
        var $request = $("#formulario").serialize();
        var iden = $("#identificacionid").val();
        var tipo = $("#tipopersona").val();
        var des = $("#descripcion").val();
        var nom = $("#nombreid").val();
        var tel = $("#telefonoid").val();
        var dir = $("#direccionid").val();
        var empresa = $("#empresaid").val();
        var dependencia = $("#dependenciaid").val();
        var diremp = $("#direccionemp").val();
        var telemp = $("#telefonoemp").val();
        var nit = $("#nitid").val();

        if (tipo.length <= 0) {
            $.notify({
                icon: "add_alert",
                message: 'Por favor, Selecione el tipo de persona'
            }, {type: 'warning', timer: 3e3, placement: {from: 'top', align: 'right'}});
            return;
        }
        if (iden.length <= 0 || tipo.length <= 0 || des.length <= 0 || nom.length <= 0 || dir.length <= 0) {
            $.notify({
                icon: "add_alert",
                message: 'Por favor, Llene todos los campos requeridos.'
            }, {type: 'warning', timer: 3e3, placement: {from: 'top', align: 'right'}});
            return;
        }
        if (tipo == 'JURIDICA') {
            if (empresa.length <= 0 || diremp.length <= 0 || telemp.length <= 0 || nit.length <= 0 || dependencia.length <= 0) {
                $.notify({
                    icon: "add_alert",
                    message: 'Por favor, Llene todos los campos requeridos.'
                }, {type: 'warning', timer: 3e3, placement: {from: 'top', align: 'right'}});
                return;
            }
        }
        const loader = document.getElementById('loader');
        loader.style.display = 'block';
        $.post(
            '{{url('tickets/publico/crear/')}}', $request
        ).done(function (msg) {
            if (msg.status == "ok") {
                loader.style.background = "url('{{asset("assets/img/images/mailenviado.gif")}}') 50% 50% no-repeat rgb(249,249,249)";
                setTimeout(function () {
                    loader.style.display = 'none';
                    loader.style.background = "url('{{asset("assets/img/images/loader.gif")}}') 50% 50% no-repeat rgb(249,249,249)";
                    $.notify({
                        icon: "add_alert",
                        message: msg.response
                    }, {type: 'info', timer: 3e3, placement: {from: 'top', align: 'right'}});
                }, 3000);
                limpiar();
            } else {
                $.notify({
                    icon: "add_alert",
                    message: '<h1>Ha surgido un problema</h1><br><p>Error interno. inténtelo otra vez más tarde.</p>'
                }, {type: 'warning', timer: 3e3, placement: {from: 'top', align: 'right'}});
            }
        });
    }

</script>
</body>

</html>
