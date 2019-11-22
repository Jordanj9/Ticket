@extends('layouts.app')
@section('breadcrumb')
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <p class="animated fadeInDown">
                    <a href="{{route('inicio')}}">Inicio </a><span class="fa-angle-right fa"></span><a
                        href="{{route('admin.general')}}">  General </a><span class="fa-angle-right fa"></span>
                    Tickest
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
                        <h4 class="card-title">GENERAL - TICKETS</h4>
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
                    <div class="material-datatables">
                        <table id="datatables" class="table table-bordered table-striped table-hover" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>RADICADO</th>
                                <th>CLIENTE</th>
                                <th>TELEFONO</th>
                                <th>ESTADO</th>
                                <th>SOLICITANTE</th>
                                <th>DEPENDENCIA</th>
                                <th>CREADO</th>
                                <th>ACCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets as $t)
                                <tr>
                                    <td>{{$t->radicado}}</td>
                                    @if($t->solicitante == 'JURIDICA')
                                        <td>{{$t->cliente_juridico->empresa}}</td>
                                        <td>{{$t->cliente_juridico->telefono}}</td>
                                    @else
                                        <td>{{$t->cliente_natural->nombre." ".$t->cliente_natural->apellido}}</td>
                                        <td>{{$t->cliente_natural->telefono}}</td>
                                    @endif
                                    <td>{{$t->estado}}</td>
                                    <td>{{$t->cliente_natural->nombre." ".$t->cliente_natural->apellido}}</td>
                                    @if($t->dependencia == null)
                                        <td>NO APLICA</td>
                                    @else
                                        <td>{{$t->dependencia}}</td>
                                    @endif

                                    <td>{{$t->created_at}}</td>
                                    <td>
                                        <a href="{{ route('tickets.show',$t->id)}}"
                                           class="btn btn-link btn-info btn-just-icon remove" data-toggle="tooltip"
                                           data-placement="top" title="Ver Tickets"><i
                                                class="material-icons">visibility</i></a>

                                        <a data-toggle="modal"
                                           data-target="#estados" onclick="selectTicket('{{$t->id}}','{{$t->estado}}')"
                                           class="btn btn-link btn-success btn-just-icon remove" data-toggle="tooltip"
                                           data-placement="top" title="Cambiar Estado Ticket"><i class="material-icons">
                                                crop_rotate
                                            </i></a>
                                        @if(session('ROL') == 'ADMINISTRADOR')
                                            <a data-toggle="modal"
                                               data-target="#addEjeTematico" onclick="selectTicket('{{$t->id}}','{{$t->estado}}')"
                                               class="btn btn-link btn-dark btn-just-icon remove"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Asignar ticket"><i class="material-icons">
                                                    transfer_within_a_station
                                                </i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>RADICADO</th>
                                <th>CLIENTE</th>
                                <th>TELEFONO</th>
                                <th>ESTADO</th>
                                <th>SOLICITANTE</th>
                                <th>DEPENDENCIA</th>
                                <th>CREADO</th>
                                <th>ACCIONES</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal detalles -->
    <div class="modal fade modal-mini modal-primary" id="mdModal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-small">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                            class="material-icons">clear</i></button>
                </div>
                <div class="modal-body">
                    <strong>Detalles: </strong>los tickets son solicitudes de servicios realizadas por los clientes
                    <br/><strong>Nota: </strong> los iconos del ticket permiten aplazar, .
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">ACEPTAR</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal detalles -->
    <!-- modal asignar -->
    <div class="modal fade modal-mini modal-primary" id="addEjeTematico" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                            class="material-icons">clear</i></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <form class="form-horizontal" method="POST" action="{{route('tickets.asignar')}}">
                            @csrf
                            <input type="hidden" id="ticket_id" name="ticket_id">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5><strong>Asignar ticket a Ticket</strong></h5>
                                        <div class="form-group bmd-form-group">
                                            <div class="form-line">
                                                <select class="form-control selectpicker"
                                                        data-style="select-with-transition"
                                                        style="width: 100%;" required="required"
                                                        title="--Seleccione una opción--"
                                                        name="Ticket_id">
                                                    @foreach($empleados as $key=>$value)
                                                        <option value="{{$key}}">{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button class="btn btn-info btn-round" style="margin-right: 50px;" type="reset">Limpiar
                                    Formulario
                                </button>
                                <button class="btn btn-success btn-round" type="submit">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal asignar -->
    <!-- modal acciones -->
    <div class="modal fade modal-mini modal-primary" id="estados" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                            class="material-icons">clear</i></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        {{--<form class="form-horizontal" method="POST" action="{{route('tickets.estado')}}">--}}
                        {{--@csrf--}}
                        <input type="hidden" id="ticketid" name="ticket_id">
                        <div class="col-md-12">
                            <h5><strong>Cambiar estado de ticket</strong></h5>
                            <div class="row">
                                <div class="col-md-12 checkbox-radios" style="margin-left: 150px;">
                                    <div class="form-check form-check-inline">
                                        <input type="hidden" id="estadoDelTicketActual">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="estado"
                                                   value="FINALIZADO" id="finalizar" onclick="estado(this.id)"/>
                                            Finalizar
                                            <span class="circle"><span class="check"></span></span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="estado"
                                                   value="APLAZADO" id="aplazar" onclick="estado(this.id)"> Aplazar
                                            <span class="circle"><span class="check"></span></span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="estado"
                                                   value="CANCELADO" id="cancelar" onclick="estado(this.id)"> Cancelar
                                            <span class="circle"><span class="check"></span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="rowobservacion">
                                <div class="col-md-12">
                                    <div class="form-group bmd-form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   placeholder="Observación"
                                                   name="observacion" id="observacion"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button class="btn btn-info btn-round" style="margin-right: 50px;" type="reset">Limpiar
                                Formulario
                            </button>
                            <button class="btn btn-success btn-round" type="button" onclick="guardar()">Guardar</button>
                        </div>
                        {{--                        </form>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal acciones -->
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#rowobservacion").attr('style', 'display:none');
            $('#datatables').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                }
            });
        });

            function selectTicket(id,estado) {
                document.getElementById('ticket_id').value = id;
                document.getElementById('ticketid').value = id;
                document.getElementById('estadoDelTicketActual').value = estado;
            }

            function limpiar() {
                $("#observacion").val("");
            }

            function estado(estado) {
                if (estado == 'finalizar') {
                    $("#rowobservacion").removeAttr('style');
                } else {
                    $("#observacion").val("");
                    $("#rowobservacion").attr('style', 'display:none');
                }
            }

            function validar(){
                let estadoActual =  document.getElementById('estadoDelTicketActual').value;
                if(estadoActual == 'FINALIZADO' || estadoActual == 'CANCELADO'){
                    $.notify({
                        icon: "add_alert",
                        message: 'La accion que intenta realizar no es posible debido al estado actual del ticket.'
                    }, {type: 'warning', timer: 3e3, placement: {from: 'bottom', align: 'right'}});
                    return false;
                }

                return true;
            }

            function guardar() {
                if(!validar()){
                    return;
                }
                var band = true;
                var ticket = $("#ticketid").val();
                var obse = $("#observacion").val();
                if ($("#finalizar").prop('checked')) {
                    var estado = $("#finalizar").val();
                    if ($("#observacion").val().length > 0) {
                        location.href = "{{url("general/tickets/cambiar/")}}/"+ticket+"/"+estado+"/"+obse+"/estado";
                    }else{
                        $.notify({
                            icon: "add_alert",
                            message: 'Por favor ingrese la observación. Atención!'
                        }, {type: 'warning', timer: 3e3, placement: {from: 'bottom', align: 'right'}});
                        return;
                    }
                } else {
                    obse= "null";
                    if ($("#cancelar").prop('checked')) {
                        var estado = $("#cancelar").val();
                    } else {
                        let estadoActual =  document.getElementById('estadoDelTicketActual').value;
                        if(estadoActual == 'APLAZADO'){
                            $.notify({
                                icon: "add_alert",
                                message: 'La accion que intenta realizar no es posible debido al estado actual del ticket.'
                            }, {type: 'warning', timer: 3e3, placement: {from: 'bottom', align: 'right'}});
                            return;
                        }
                        var estado = $("#aplazar").val();
                    }
                    if (band == false) {
                        $.notify({
                            icon: "add_alert",
                            message: 'Por favor ingrese la observación. Atención!'
                        }, {type: 'warning', timer: 3e3, placement: {from: 'bottom', align: 'right'}});
                        return;
                    } else {
                        location.href = "{{url("general/tickets/cambiar/")}}/"+ticket+"/"+estado+"/"+obse+"/estado";
                    }
                }
            }

    </script>
@endsection
