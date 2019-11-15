@extends('layouts.app')
@section('breadcrumb')
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <p class="animated fadeInDown">
                    <a href="{{route('inicio')}}">Inicio </a><span class="fa-angle-right fa"></span><a
                        href="{{route('admin.usuarios')}}"> Usuarios </a><span
                        class="fa-angle-right fa"></span> Editar/Eliminar Usuario
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
                        <h4 class="card-title">DATOS DEL USUARIO</h4>
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
                        <form class="form-horizontal" method="POST" action="{{route('usuario.update',$user->id)}}">
                            @csrf
                            <input name="_method" type="hidden" value="PUT"/>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <br/><input type="text" class="form-control" value="{{$user->identificacion}}"
                                                    placeholder="Escriba el número de identificación del usuario, con éste tendrá acceso al sistema"
                                                    name="identificacion" required="required"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <br/><input type="text" class="form-control" value="{{$user->nombres}}"
                                                    placeholder="Escriba los nombres del usuario" name="nombres" required
                                                    id="txt_nombres"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <br/><input type="text" class="form-control" value="{{$user->apellidos}}"
                                                    placeholder="Escriba los apellidos del usuario" name="apellidos" required
                                                    id="txt_apellidos"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <br/><input type="email" class="form-control" value="{{$user->email}}"
                                                    placeholder="Escriba el correo electrónico del usuario" name="email"
                                                    required id="txt_email"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <br/><label>Estado del Usuario</label>
                                        <br/><select class="form-control selectpicker"
                                                     data-style="select-with-transition" name="estado"
                                                     title="-- Seleccione Estado del Usuario --" required="">
                                            @if($user->estado=='ACTIVO')
                                                <option value="ACTIVO" selected="">ACTIVO</option>
                                                <option value="INACTIVO">INACTIVO</option>
                                            @else
                                                <option value="ACTIVO">ACTIVO</option>
                                                <option value="INACTIVO" selected="">INACTIVO</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Seleccione los Grupos o Roles de Usuarios</label>
                                        <br/><select class="form-control selectpicker"
                                                     data-style="select-with-transition" data-size="7" name="grupos[]"
                                                     title="Seleccione los Grupos o Roles de Usuarios" required=""
                                                     multiple="">
                                            @foreach($grupos as $key=>$value)
                                                <?php
                                                $existe = false;
                                                ?>
                                                @foreach($user->grupousuarios as $m)
                                                    @if($m->id==$key)
                                                        <?php
                                                        $existe = true;
                                                        ?>
                                                    @endif
                                                @endforeach
                                                @if($existe)
                                                    <option value="{{$key}}" selected>{{$value}}</option>
                                                @else
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <br/><br/><a href="{{route('admin.usuarios')}}" class="btn btn-danger btn-round">Cancelar</a>
                                    <button class="btn btn-info btn-round" type="reset">Limpiar Formulario</button>
                                    <button class="btn btn-success btn-round" type="submit">Guardar</button>
                                    <a href="{{route('usuario.delete',$user->id)}}" class="btn btn-danger btn-round">Eliminar
                                        Usuario</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-success card-header-text">
                    <div class="card-text col-md-6">
                        <h4 class="card-title">CAMBIAR LA CONTRASEÑA</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        @component('layouts.errors')
                        @endcomponent
                    </div>
                    <div class="col-md-12">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{route('usuario.cambiarPass')}}">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <br/><input type="text" class="form-control"
                                                    value="{{$user->identificacion}}"
                                                    name="identificacion2" readonly="" required="required"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Escriba la Nueva Contraseña</label>
                                        <br/><input type="password" name="pass1" placeholder="Mínimo 6 caracteres"
                                                    class="form-control" required="required"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Vuelva a Escribir La Nueva Contraseña</label>
                                        <br/><input type="password" name="pass2" placeholder="Mínimo 6 caracteres"
                                                    class="form-control" required="required"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-info btn-round" type="reset">Limpiar</button>
                                <button class="btn btn-success btn-round" type="submit">Guardar</button>
                            </div>
                        </form>
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
                    Edite ó elimine un usuario del sistema. Además, puede cambiar la contraseña.
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
