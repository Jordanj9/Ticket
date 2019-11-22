@extends('layouts.app')
@section('breadcrumb')
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <p class="animated fadeInDown">
                    <a href="{{route('inicio')}}">Inicio </a><span class="fa-angle-right fa"></span><a
                        href="{{route('admin.general')}}">General</a><span class="fa-angle-right fa"></span>
                    Equipos
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
                        <h4 class="card-title">GENERAL - EQUIPOS</h4>
                    </div>
                    <div class="pull-right col-md-6">
                        <ul class="navbar-nav pull-right">
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" id="navbarDropdownProfile" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                    <a href="{{ route('equipos.create') }}" class="dropdown-item" href="#">Agregar nuevo
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
                        <table id="datatables" class="table table-bordered table-striped table-hover"
                               width="100%" style="width:100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>CLIENTE</th>
                                <th>MARCA</th>
                                <th>PROCESADOR</th>
                                <th>MEMORIA RAM</th>
                                <th>DISCO DURO</th>
                                <th>ACCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($equipos as $equipo)
                                <tr>
                                    <td>{{$equipo->id}}</td>
                                    @if($equipo->propietario == 'NATURAL')
                                        <td>{{$equipo->cliente_natural->nombre.' '.$equipo->cliente_natural->apellido}}</td>
                                    @else
                                        <td>{{$equipo->cliente_juridico->empresa}}</td>
                                    @endif

                                    <td>{{$equipo->marca}}</td>
                                    <td>{{$equipo->procesador}}</td>
                                    <td>{{$equipo->memoria_ram}}</td>
                                    <td>{{$equipo->disco_duro}}</td>
                                    <td style="text-align: center;">
                                        <a href="{{route('equipos.show',$equipo->id)}}"
                                           class="btn btn-link btn-info btn-just-icon remove" data-toggle="tooltip"
                                           data-placement="top" title="Ver Equipo"><i class="material-icons">
                                                remove_red_eye
                                            </i></a>
                                        <a href="{{route('equipos.edit',$equipo->id)}}"
                                           class="btn btn-link btn-success btn-just-icon remove" data-toggle="tooltip"
                                           data-placement="top" title="Editar Equipo"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('equipos.delete',$equipo->id)}}"
                                           class="btn btn-link btn-danger btn-just-icon remove" data-toggle="tooltip"
                                           data-placement="top" title="Eliminar Equipo"><i class="material-icons">delete</i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>CLIENTE</th>
                                <th>MARCA</th>
                                <th>PROCESADOR</th>
                                <th>MEMORIA RAM</th>
                                <th>DISCO DURO</th>
                                <th class="text-right">ACCIONES</th>
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
                    <strong>Detalles: </strong>Los Equipos son computadores pertenecientes a una Persona o Empresa.
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
    </script>
@endsection
