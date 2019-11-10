@extends('layouts.app')
@section('breadcrumb')
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <p class="animated fadeInDown">
                    <a href="{{route('inicio')}}">Inicio </a><span class="fa-angle-right fa"></span><a
                        href="{{route('admin.usuarios')}}"> Usuarios </a><span
                        class="fa-angle-right fa"></span><a href="{{route('pagina.index')}}"> Grupo de
                        Usuarios </a><span class="fa-angle-right fa"></span> Editar
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
                        <h4 class="card-title">EDITAR DATOS DEL GRUPO DE USUARIO : {{$grupo->nombre}}</h4>
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
                        <form class="form-horizontal" method="POST"
                              action="{{route('grupousuario.update',$grupo->id)}}">
                            @csrf
                            <input name="_method" type="hidden" value="PUT"/>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <br/><input type="text" value="{{$grupo->nombre}}" class="form-control"
                                                    placeholder="Escriba el nombre del grupo o rol de usuario"
                                                    name="nombre" required="required"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <br/><input type="text" value="{{$grupo->descripcion}}" class="form-control"
                                                    placeholder="Descripción del grupo (Opcional)" name="descripcion"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <br/>
                                        <label>Seleccione los Módulos a los que el Grupo Tendrá Acceso</label>
                                        <select class="form-control selectpicker" data-style="select-with-transition" name="modulos[]"
                                                title="Seleccione los Módulos a los que el Grupo Tendrá Acceso"
                                                required="" multiple="">
                                            @foreach($modulos as $key=>$value)
                                                <?php
                                                $existe = false;
                                                ?>
                                                @foreach($grupo->modulos as $m)
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
                                    <br/><br/><a href="{{route('grupousuario.index')}}" class="btn btn-danger btn-round">Cancelar</a>
                                    <button class="btn btn-info btn-round" type="reset">Limpiar Formulario</button>
                                    <button class="btn btn-success btn-round" type="submit">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="mdModal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                            class="material-icons">clear</i></button>
                </div>
                <div class="modal-body">
                    <strong>Edite los datos de los grupos,</strong> Los grupos de usuarios son los roles o agrupaciones de usuarios que permite asignarle privilegios a todo un conglomerado de usuarios que comparte funciones. Ejemplo de grupos de usuarios: ADMINISTRADOR, FELIGRES, ESCUELA SABATICA, MAYORDOMIA, MINISTERIO JUVENIL, ETC.
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

    </script>
@endsection
