@extends('layouts.app')
@section('breadcrumb')
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <p class="animated fadeInDown">
                    <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> Módulo General
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
                        <h4 class="card-title">GENERAL</h4>
                    </div>
                </div>
                <div class="card-body">
                    @if(session()->has('PAG_EQUIPOS'))
                    <a href="{{route('equipos.index')}}">
                        <button class="btn btn-outline-info btn-round">
                            <i class="material-icons">desktop_mac</i> EQUIPOS
                            <div class="ripple-container"></div>
                        </button>
                    </a>
                    @endif
                    @if(session()->has('PAG_TICKETS'))
                        <a href="{{route("tickets.index")}}">
                            <button class="btn btn-outline-info btn-round">
                                <i class="material-icons">style</i>  TICKETS
                                <div class="ripple-container"></div>
                            </button>
                        </a>
                    @endif

                    @if(session()->has('PAG_EMPLEADOS'))
                            <a href="{{route("empleado.index")}}">
                                <button class="btn btn-outline-info btn-round">
                                    <i class="material-icons">people_alt</i>  EMPLEADOS
                                    <div class="ripple-container"></div>
                                </button>
                            </a>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
