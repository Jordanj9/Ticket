@extends('layouts.app')
@section('breadcrumb')
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <p class="animated fadeInDown">
                    <a href="{{route('inicio')}}">Inicio </a><span class="fa-angle-right fa"></span><a
                        href="{{route('admin.usuarios')}}"> Módulo Usuarios </a><span class="fa-angle-right fa"></span>
                    Privilegios a Páginas
                </p>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-info card-header-text">
                    <div class="card-text col-md-6">
                        <h4 class="card-title">USUARIOS - PRIVILEGIOS A PÁGINAS</h4>
                    </div>
                    <div class="pull-right col-md-6">
                        <ul class="navbar-nav pull-right">
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" id="navbarDropdownProfile" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                    <a href="{{ route('modulo.create') }}" class="dropdown-item" href="#">Agregar nuevo
                                        modulo</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                       data-target="#mdModal">Ayuda</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <br/><select class="form-control" data-style="select-with-transition"
                                                 name="grupousuario_id" id="grupousuario_id"
                                                 onchange="traerData()">
                                        <option value="0">Seleccione Grupo o Rol de Usuario</option>
                                        @foreach($grupos as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body btn-info">
                                        PÁGINAS DEL SISTEMA
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control" style="height: 250px" name="paginas[]" id="paginas"
                                            multiple="" size="23">
                                        @foreach($paginas as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2" style="margin-top: 10%;">
                            <div class="col-md-12">
                                <center>
                                    <button type="button" class="btn btn-info btn-round btn-fab" onclick="agregar()">
                                        <i class="fa fa-plus-circle"></i>
                                    </button>
                                </center>
                            </div>
                            <div class="col-md-12">
                                <center>
                                    <button type="button" class="btn btn-default btn-round btn-fab"  onclick="retirar()">
                                        <i class="fa fa-minus-circle"></i>
                                    </button>
                                </center>
                            </div>
                            <div class="col-md-12">
                                <center>
                                    <button type="button" class="btn btn-info btn-round btn-fab" onclick="agregarTodas()">
                                        <i class="fa fa-arrow-circle-right" ></i>
                                    </button>
                                </center>
                            </div>
                            <div class="col-md-12">
                                <center>
                                    <button type="button" class="btn btn-default btn-round btn-fab"  onclick="retirarTodas()">
                                        <i class="fa fa-arrow-circle-left" ></i>
                                    </button>
                                </center>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body btn-info">
                                        PRIVILEGIOS DEL GRUPO
                                    </div>
                                </div>
                            </div>
                            <form method="POST" action="{{route('grupousuario.guardar')}}"
                                  name="form-privilegios" id="form-privilegios">
                                @csrf
                                <input type="hidden" name="id" id="id"/>
                                <div class="form-group bmd-form-group" style="height: 250px">
                                    <div class="form-line">
                                        <select class="form-control"  name="privilegios[]"
                                                id="privilegios" required="" style="height: 250px" multiple="" size="20"></select>
                                    </div>
                                </div>
                                <div class="form-group bmd-form-group">
                                    <div class="col-md-12">
                                        <button type="submit" id="btn-enviar" class="btn btn-info btn-block">Guardar
                                            los
                                            Cambios Para el Grupo Seleccionado
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-mini modal-primary" id="mdModal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-small">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                            class="material-icons">clear</i></button>
                </div>
                <div class="modal-body">
                    <strong>Detalles: </strong>Los módulos generales del sistema son las aplicaciones generales
                    representadas en las opciones del menú. Ejemplo de módulo general: MOD_INICIO, MOD_USUARIOS.
                    <br/><strong>Nota: </strong> No modifique los nombres de los módulos ya creados ya que puede
                    ocasionar fallas en el sistema.
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">ACEPTAR</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#btn-enviar").click(function (e) {
                validar(e);
            });
        });

        function validar(e) {
            e.preventDefault();
            var id = $("#id").val();
            if (id.length === 0) {
                notify('Atención', 'Debe seleccionar un grupo de usuarios para agregar privilegios.', 'warning');
            } else {
                $('#privilegios option').each(function () {
                    var valor = $(this).attr('value');
                    $("#privilegios").find("option[value='" + valor + "']").prop("selected", true);
                });
                $("#form-privilegios").submit();
            }
        }

        function agregar() {
            var id = $("#grupousuario_id").val();
            if (id === null) {
                notify('Atención', 'Debe seleccionar un grupo de usuarios para agregar privilegios.', 'warning');
            } else {
                $.each($('#paginas :selected'), function () {
                    var valor = $(this).val();
                    var texto = $(this).text();
                    if (!existe(valor)) {
                        $("#privilegios").append("<option value='" + valor + "'>" + texto + "</option>");
                        $("#paginas").find("option[value='" + valor + "']").prop("disabled", true);
                    }
                });
            }
        }

        function agregarTodas() {
            var id = $("#grupousuario_id").val();
            if (id === null) {
                notify('Atención', 'Debe seleccionar un grupo de usuarios para agregar privilegios.', 'warning');
            } else {
                $('#paginas option').each(function () {
                    var valor = $(this).attr('value');
                    var texto = $(this).text();
                    if (texto !== "-- Seleccione una opción --") {
                        if (!existe(valor)) {
                            $("#privilegios").append("<option value='" + valor + "'>" + texto + "</option>");
                            $("#paginas").find("option[value='" + valor + "']").prop("disabled", true);
                        }
                    }
                });
            }
        }

        function existe(valor) {
            var array = [];
            $("#privilegios option").each(function () {
                array.push($(this).attr('value'));
            });
            var index = $.inArray(valor, array);
            if (index !== -1) {
                return true;
            } else {
                return false;
            }
        }

        function retirar() {
            $.each($('#privilegios :selected'), function () {
                var valor = $(this).val();
                $("#paginas").find("option[value='" + valor + "']").prop("disabled", false);
                $(this).remove();
            });
        }

        function retirarTodas() {
            $('#privilegios option').each(function () {
                var valor = $(this).attr('value');
                $("#paginas").find("option[value='" + valor + "']").prop("disabled", false);
                $(this).remove();
            });
        }

        function traerData() {
            var id = $("#grupousuario_id").val();
            $("#id").val(id);
            $.ajax({
                type: 'GET',
                url: url + "usuarios/grupousuario/" + id + "/privilegios",
                data: {},
            }).done(function (msg) {
                $('#privilegios option').each(function () {
                    $(this).remove();
                });
                if (msg !== "null") {
                    var m = JSON.parse(msg);
                    $('#paginas option').each(function () {
                        var valor = $(this).attr('value');
                        $("#paginas").find("option[value='" + valor + "']").prop("disabled", false);
                    });
                    $.each(m, function (index, item) {
                        $("#privilegios").append("<option value='" + item.id + "'>" + item.value + "</option>");
                        $("#paginas").find("option[value='" + item.id + "']").prop("disabled", true);
                    });
                } else {
                    notify('Atención', 'El grupo de usuarios seleccionado no tiene privilegios asignados aún.', 'error');
                    $('#paginas option').each(function () {
                        var valor = $(this).attr('value');
                        $("#paginas").find("option[value='" + valor + "']").prop("disabled", false);
                    });
                }
            });
        }
    </script>
@endsection
