@extends('layouts.app')
@section('breadcrumb')
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <p class="animated fadeInDown">
                    <a href="{{route('inicio')}}">Inicio </a><span class="fa-angle-right fa"></span><a
                        href="{{route('admin.general')}}"> General </a><span
                        class="fa-angle-right fa"></span><a href="{{route('tickets.index')}}"> Ticket</a><span
                        class="fa-angle-right fa"></span> Ver
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
                        <h4 class="card-title">DATOS DEL TICKET</h4>
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
                                <td class="contact btn-info" colspan="2" style="border-radius: 10px;">
                                    <center><b>Información del Ticket</b></center>
                                </td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Estado</b></td>
                                <td class="subject">{{$ticket->estado}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Radicado</b></td>
                                <td class="subject">{{$ticket->radicado}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Descripciòn</b></td>
                                <td class="subject">{{$ticket->descripcion}}</td>
                            </tr>
                            @if($ticket->estado == 'FINALIZADO')
                                <tr class="read">
                                    <td class="contact"><b>Observación</b></td>
                                    <td class="subject">{{$ticket->observación}}</td>
                                </tr>
                            @endif
                            @if($ticket->empleado!=null)
                            <tr class="read">
                                <td class="contact btn-info" colspan="2" style="border-radius: 10px;">
                                    <center><b>Empleado Encargado</b></center>
                                </td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Nombre</b></td>
                                <td class="subject">{{$ticket->empleado->nombre." ".$ticket->empleado->apellido}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Telefono</b></td>
                                <td class="subject">{{$ticket->empleado->telefono}}</td>
                            </tr>
                            @endif
                            <tr class="read">
                                <td class="contact btn-info" colspan="2" style="border-radius: 10px;">
                                    <center><b>Información del Cliente</b></center>
                                </td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Identificación</b></td>
                                <td class="subject">{{$ticket->cliente_natural->identificacion}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Nombre</b></td>
                                <td class="subject">{{$ticket->cliente_natural->nombre." ".$ticket->cliente_natural->apellido}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Telefono</b></td>
                                <td class="subject">{{$ticket->cliente_natural->telefono}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Email</b></td>
                                <td class="subject">{{$ticket->cliente_natural->email}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Dirección</b></td>
                                <td class="subject">{{$ticket->cliente_natural->direccion}}</td>
                            </tr>
                            @if($ticket->solicitante == 'JURIDICA')
                                <tr class="read">
                                    <td class="contact btn-info" colspan="2" style="border-radius: 10px;">
                                        <center><b>Empresa</b></center>
                                    </td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Nit</b></td>
                                    <td class="subject">{{$ticket->cliente_juridico->nit}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Empresa</b></td>
                                    <td class="subject">{{$ticket->cliente_juridico->empresa}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Depend</b></td>
                                    <td class="subject">{{$ticket->cliente_juridico->empresa}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Telefono</b></td>
                                    <td class="subject">{{$ticket->cliente_juridico->telefono}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Dirección</b></td>
                                    <td class="subject">{{$ticket->cliente_juridico->direccion}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Email</b></td>
                                    <td class="subject">{{$ticket->cliente_juridico->email}}</td>
                                </tr>
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
