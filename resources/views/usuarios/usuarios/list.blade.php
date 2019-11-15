@extends('layouts.app')
@section('breadcrumb')
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <p class="animated fadeInDown">
                    <a href="{{route('inicio')}}">Inicio </a><span class="fa-angle-right fa"></span><a
                        href="{{route('admin.usuarios')}}"> Módulo Usuarios </a><span class="fa-angle-right fa"></span>
                    Listar Usuarios
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
                        <h4 class="card-title">USUARIOS - LISTADO DE USUARIOS DEL SISTEMA</h4>
                    </div>
                    <div class="pull-right col-md-6">
                        <ul class="navbar-nav pull-right">
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" id="navbarDropdownProfile" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                    <a href="{{ route('usuario.create') }}" class="dropdown-item" href="#">Agregar nuevo
                                        modulo</a>
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
                                <th>IDENTIFICACIÓN</th>
                                <th>USUARIO</th>
                                <th>E-MAIL</th>
                                <th>ESTADO</th>
                                <th>ROLES</th>
                                <th>CREADO</th>
                                <th>MODIFICADO</th>
                                <th>ACCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($usuarios as $usuario)
                                <tr>
                                    <td>{{$usuario->identificacion}}</td>
                                    <td>{{$usuario->nombres}} {{$usuario->apellidos}}</td>
                                    <td>{{$usuario->email}}</td>
                                    <td>@if($usuario->estado=='ACTIVO')<label
                                            class="label label-success">ACTIVO</label>@else<label
                                            class="label label-danger">INACTIVO</label>@endif</td>
                                    <td>
                                        @foreach($usuario->grupousuarios as $grupo)
                                            {{$grupo->nombre}} -
                                        @endforeach
                                    </td>
                                    <td>{{$usuario->created_at}}</td>
                                    <td>{{$usuario->updated_at}}</td>
                                    <td style="text-align: center;">
                                        <form class="form-horizontal form-label-left" method="POST"
                                              action="{{route('usuario.operaciones')}}"><input type="hidden" name="id" value="{{$usuario->identificacion}}"/>
                                            @csrf
                                            <button class="btn btn-link btn-info btn-just-icon" type="submit"
                                                    data-toggle="tooltip" data-placement="top" title="Editar Usuario"><i
                                                    class="material-icons">mode_edit</i></button>
                                        </form>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>IDENTIFICACIÓN</th>
                                <th>USUARIO</th>
                                <th>E-MAIL</th>
                                <th>ESTADO</th>
                                <th>ROLES</th>
                                <th>CREADO</th>
                                <th>MODIFICADO</th>
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
