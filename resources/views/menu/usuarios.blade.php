@extends('layouts.app')
@section('breadcrumb')
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <p class="animated fadeInDown">
                    <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> Módulo Usuarios
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
                    <div class="card-text">
                        <h4 class="card-title">USUARIOS DEL SISTEMA</h4>
                    </div>
                </div>
                <div class="card-body">
                @if(session()->has('PAG_MODULOS'))
                    <a href="{{route('modulo.index')}}">
                        <button class="btn btn-outline-info btn-round">
                            <i class="fa fa-cubes"></i>  MODULOS DEL SISTEMA
                            <div class="ripple-container"></div>
                        </button>
                    </a>
                @endif
                @if(session()->has('PAG_PAGINAS'))
                    <a href="{{route("pagina.index")}}">
                        <button class="btn btn-outline-info btn-round">
                            <i class="fa fa-file-powerpoint-o"></i>  PÁGINAS DEL SISTEMA
                            <div class="ripple-container"></div>
                        </button>
                    </a>
                @endif
                @if(session()->has('PAG_GRUPOS-ROLES'))
                    <a href="{{route("grupousuario.index")}}">
                        <button class="btn btn-outline-info btn-round">
                            <i class="fa fa-user"></i>  GRUPOS O ROLES DE USUARIOS
                            <div class="ripple-container"></div>
                        </button>
                    </a>
                @endif
                @if(session()->has('PAG_PRIVILEGIOS'))
                    <a href="{{route('grupousuario.privilegios')}}">
                        <button class="btn btn-outline-info btn-round">
                            <i class="fa fa-key"></i>  PRIVILÉGIOS A PÁGINAS
                            <div class="ripple-container"></div>
                        </button>
                    </a>
               @endif
               @if(session()->has('PAG_USUARIOS'))
                    <a href="{{route('usuario.index')}}">
                        <button class="btn btn-outline-info btn-round">
                            <i class="fa fa-users"></i>  LISTAR TODOS LOS USUARIOS
                            <div class="ripple-container"></div>
                        </button>
                    </a>
               @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-success card-header-text">
                    <div class="card-text">
                        <h4 class="card-title">MODIFICAIÓN Y ELIMINACIÓN DE USUARIO</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form class="form-horizontal form-label-left" method="POST"
                          action="{{route('usuario.operaciones')}}" name="form-privilegios" id="form-privilegios">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-line">
                                        <input type="text" id="id" class="form-control"
                                               placeholder="Escriba la identificación a consultar" name="id"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn bg-info waves-effect btn-block">CONSULTAR USUARIO
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
