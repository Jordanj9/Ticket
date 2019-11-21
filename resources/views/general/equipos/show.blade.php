@extends('layouts.app')
@section('breadcrumb')
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <p class="animated fadeInDown">
                    <a href="{{route('inicio')}}">Inicio </a><span class="fa-angle-right fa"></span><a
                        href="{{route('admin.general')}}"> General </a><span
                        class="fa-angle-right fa"></span><a href="{{route('equipos.index')}}"> Equipos</a><span
                        class="fa-angle-right fa"></span> Crear
                </p>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-success card-header-text">
                    <div class="card-text col-md-6">
                        <h4 class="card-title">DATOS DEL EQUIPO</h4>
                    </div>
                    <div class="pull-right col-md-6">
                        <ul class="navbar-nav pull-right">
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" id="navbarDropdownProfile" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                       data-target="#mdModal">Ayuda</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        @component('layouts.errors')
                        @endcomponent
                    </div>
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <tbody>
                            <tr class="read">
                                <td class="contact bg-info" colspan="2" style="border-radius: 10px;">
                                    <center><b>Información del Equipo</b></center>
                                </td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Año Adquicisión</b></td>
                                <td class="subject">{{$equipo->anio_adquicision}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Marca</b></td>
                                <td class="subject">{{$equipo->marca}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Procesador</b></td>
                                <td class="subject">{{$equipo->procesador}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Memoria Ram</b></td>
                                <td class="subject">{{$equipo->memoria_ram}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Disco Duro</b></td>
                                <td class="subject">{{$equipo->disco_duro}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Licencias</b></td>
                                <td class="subject">{{$equipo->licencias}}</td>
                            </tr>

                            <tr class="read">
                                <td class="contact bg-info" colspan="2" style="border-radius: 10px;">
                                    <center><b>Mantenimientos Realizados</b></center>
                                </td>
                            </tr>
                            @if(count($equipo->mantenimientos)>0)
                                @foreach($equipo->mantenimientos as $mantenimiento)
                                    <tr class="read">
                                        <td class="contact"><b>Fecha Realización</b></td>
                                        <td class="subject">{{$mantenimiento->created_at}}</td>
                                    </tr>
                                    <tr class="read">
                                        <td class="contact"><b>Descripción</b></td>
                                        <td class="subject">{{$mantenimiento->descripcion}}</td>
                                    </tr>
                                    @if($mantenimiento->empleado_id != null)
                                        <tr class="read">
                                            <td class="contact"><b>Empleado</b></td>
                                            <td class="subject">{{$mantenimiento->empleado->nombre." ".$mantenimiento->empleado->apellido}}</td>
                                        </tr>
                                    @endif
                                 @endforeach
                            @endif
                            </tbody>
                        </table>
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
                    <strong>Agregue nuevos Equipos,</strong> el nombre del módulo no debe llevar acentos, eñes (ñ) ni
                    caracteres especiales, el nombre del módulo debe iniciar con "MOD_" seguido del nombre que usted
                    desee. Los módulos generales del sistema son las aplicaciones generales representadas en las
                    opciones del menú. Ejemplo de modulo general: MOD_INICIO, MOD_USUARIO, ETC.
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
            var table = $('#datatables').DataTable();
        });
        function selecionarCliente(event, identificacion, nombres,id,tipo) {
            event.preventDefault();
            $('#clientes').modal('hide');
            $('#identificacion_cliente').val(identificacion);
            $('#nombre_cliente').val(nombres);
            $('#cliente_id').val(id);
            $('#tipo').val(tipo);
            $('#datos_cliente').attr('style', 'display:flex;');
        }

        function agregarLicecncia() {
            $('#licencia').modal('hide');
            const programa = $("#programa_id").val();
            const detalle = $("#detalle").val();
            const licencia =$("#licencias").val() + programa + "\n" + detalle + "\n";
            $("#licencias").val(licencia);
            $("#programa_id").val("");
            $("#detalle").val("");
        }

        function guardar(){
            const clientehasValue = $('#cliente_id').val().length > 0;
            $('#licencias').removeAttr('disabled');
            if(!clientehasValue){
                $.notify({
                    icon: "add_alert",
                    message: 'Debe selecionar el cliente al cual pertenece el equipo a registrar.'
                }, {type: 'danger', timer: 3e3, placement: {from: 'top', align: 'right'}});
            }
        }
    </script>
@endsection
