@extends('layouts.app')
@section('breadcrumb')
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <p class="animated fadeInDown">
                    <a href="{{route('inicio')}}">Inicio </a><span class="fa-angle-right fa"></span><a
                        href="{{route('admin.general')}}">General</a><span class="fa-angle-right fa"></span>
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
                                    <a href="{{ route('modulo.create') }}" class="dropdown-item" href="#">Agregar nuevo
                                        equipo</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                       data-target="#mdModal">Ayuda</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables" class="table table-bordered table-striped table-hover table-responsive table-condensed dataTable js-exportable" width="100%" cellspacing="0"
                               width="100%" style="width:100%">
                            <thead>
                            <tr>
                                <th>RADICADO</th>
                                <th>CLIENTE</th>
                                <th>TELEFONO</th>
                                <th>DESCRIPCIÓN</th>
                                <th>ESTADO</th>
                                <th>ACCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets as $t)
                                <tr>
                                    <td>{{$t->radicado}}</td>
                                    @if($t->solicitante == 'JURIDICA')
                                        <td>{{$t->cliente_juridico->empresa}}</td>
                                    @endif
                                    <td>{{$t->cliente_natura}}</td>
                                    <td>{{$t->cliente->telefono}}</td>
                                    <td>{{$t->cliente->email}}</td>
                                    <td>{{$t->direccion}}</td>
                                    <td>{{$t->created_at}}</td>
                                    <td>{{$t->updated_at}}</td>
                                    <td>
                                        @if(session('ROL') == 'ADMINISTRADOR')
                                            <a data-toggle="modal"
                                               data-target="#addEjeTematico" onclick="selectEmpleado('{{$t->id}}')"
                                               class="btn btn-link btn-warning btn-just-icon remove"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Asignar ticket"><i class="material-icons">perm_data_setting</i></a>
                                        @endif
                                        <a data-toggle="modal"
                                           data-target="#estados" onclick="selectEmpleado('{{$t->id}}')"
                                           class="btn btn-link btn-danger btn-just-icon remove" data-toggle="tooltip"
                                           data-placement="top" title="Cambiar Estado Ticket"><i class="material-icons">layers_clear</i></a>
                                        <a href="{{ route('tickets.edit',$t->id)}}"
                                           class="btn btn-link btn-primary btn-just-icon remove" data-toggle="tooltip"
                                           data-placement="top" title="Editar Módulo"><i class="material-icons">mode_edit</i></a>
                                        <a href="{{ route('tickets.show',$t->id)}}"
                                           class="btn btn-link btn-success btn-just-icon remove" data-toggle="tooltip"
                                           data-placement="top" title="Ver Tickets"><i
                                                class="material-icons">style</i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>RADICADO</th>
                                <th>CLIENTE</th>
                                <th>TELEFONO</th>
                                <th>DESCRIPCIÓN</th>
                                <th>ESTADO</th>
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
                                        <h5><strong>Asignar ticket a empleado</strong></h5>
                                        <div class="form-group bmd-form-group">
                                            <div class="form-line">
                                                <select class="form-control selectpicker"
                                                        data-style="select-with-transition"
                                                        style="width: 100%;" required="required"
                                                        title="--Seleccione una opción--"
                                                        name="empleado_id">
                                                    <option value="">--Seleccione una opción--</option>
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
                        {{--                        <form class="form-horizontal" method="POST" action="{{route('tickets.estado')}}">--}}
                        {{--                                @csrf--}}
                        <input type="hidden" id="ticketid" name="ticket_id">
                        <div class="col-md-12">
                            <h5><strong>Cambiar estado de ticket</strong></h5>
                            <div class="row">
                                <div class="col-md-12 checkbox-radios" style="margin-left: 150px;">
                                    <div class="form-check form-check-inline">
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

            var table = $('#datatable').DataTable();

            // Edit record
            table.on('click', '.edit', function () {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
            });

            // Delete a record
            table.on('click', '.remove', function (e) {
                $tr = $(this).closest('tr');
                table.row($tr).remove().draw();
                e.preventDefault();
            });

            //Like record
            table.on('click', '.like', function () {
                alert('You clicked on Like button');
            });
        });

        function selectEmpleado(id) {
            document.getElementById('ticket_id').value = id;
            document.getElementById('ticketid').value = id;
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

        function guardar() {
            var band = true;
            var ticket = $("#ticketid").val();
            var obse = $("#observacion").val();
            if ($("#finalizar").prop('checked')) {
                var estado = $("#finalizar").val();
                if ($("#observacion").length <= 0) {
                    band = false;
                }
            } else {
                if($("#cancelar").prop('checked')){
                    var estado = $("#cancelar").val();
                }else{
                    var estado = $("#aplazar").val();
                }
                if (band == false) {
                    $.notify({
                        icon: "add_alert",
                        message: 'Por favor ingrese la observación. Atención!'
                    }, {type: 'warning', timer: 3e3, placement: {from: 'bottom', align: 'right'}});
                    return;
                } else {
                        //ruta 'tickets/cambiar/{ticket}/{estado}/{obs}/estado'
                }
            }
        }
    </script>
@endsection
