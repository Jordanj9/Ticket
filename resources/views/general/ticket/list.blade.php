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
                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                               width="100%" style="width:100%">
                            <thead>
                            <tr>
                                <th>TIPO DE PERSONA</th>
                                <th>IDENTIFICACIÓN</th>
                                <th>NOMBRE</th>
                                <th>DESCRIPCIÓN</th>
                                <th>TELEFONO</th>
                                <th>EMAIL</th>
                                <th>CREADO</th>
                                <th>MODIFICADO</th>
                                <th>ACCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets as $t)
                                <tr>
                                    <td>{{$t->cliente->tipopersona}}</td>
                                    <td>{{$t->cliente->identificacion}}</td>
                                    <td>{{$t->cliente->nombre." ".$t->cliente->apellido}}</td>
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
                                        <a href="{{ route('tickets.edit',$t->id)}}"
                                           class="btn btn-link btn-danger btn-just-icon remove" data-toggle="tooltip"
                                           data-placement="top" title="Finalizar Ticket"><i class="material-icons">layers_clear</i></a>
                                        <a href="{{ route('tickets.edit',$t->id)}}"
                                           class="btn btn-link btn-primary btn-just-icon remove" data-toggle="tooltip"
                                           data-placement="top" title="Editar Módulo"><i class="material-icons">mode_edit</i></a>
                                        <a href="{{ route('tickets.show',$t->id)}}"
                                           class="btn btn-link btn-success btn-just-icon remove" data-toggle="tooltip"
                                           data-placement="top" title="Ver Tickets"><i
                                                class="material-icons">style</i></a>
                                        <a href="{{ route('tickets.delete',$t->id)}}"
                                           class="btn btn-link btn-danger btn-just-icon remove" data-toggle="tooltip"
                                           data-placement="top" title="Cancelar tickets"><i class="material-icons">delete</i></a>
                                        <a href="{{ route('tickets.edit',$t->id)}}"
                                           class="btn btn-link btn-primary btn-just-icon remove" data-toggle="tooltip"
                                           data-placement="top" title="Aplazar Ticket"><i class="material-icons">date_range</i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>TIPO DE PERSONA</th>
                                <th>IDENTIFICACIÓN</th>
                                <th>NOMBRE</th>
                                <th>DESCRIPCIÓN</th>
                                <th>TELEFONO</th>
                                <th>EMAIL</th>
                                <th>CREADO</th>
                                <th>MODIFICADO</th>
                                <th>ACCIONES</th>
                            </tr>
                            </tfoot>
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
                                <button class="btn btn-info btn-round" style="margin-right: 50px;" type="reset">Limpiar Formulario</button>
                                <button class="btn btn-success btn-round" type="submit">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
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
        }
    </script>
@endsection
