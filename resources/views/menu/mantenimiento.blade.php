@extends('layouts.app')
@section('breadcrumb')
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <p class="animated fadeInDown">
                    <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> Módulo Mantenimiento
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
                        <h4 class="card-title">MANTENIMIENTO</h4>
                    </div>
                </div>
                <div class="card-body">
                    <a href="{{route('mantenimiento.create')}}">
                        <button class="btn btn-outline-info btn-round">
                            <i class="material-icons">build</i> NUEVO MANTENIMIENTO
                            <div class="ripple-container"></div>
                        </button>
                    </a>
                    <a href="{{route("tickets.index")}}">
                        <button class="btn btn-outline-info btn-round">
                            <i class="material-icons">assignment</i>  INFORME
                            <div class="ripple-container"></div>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
