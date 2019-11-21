@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <a href="{{route('admin.usuarios')}}">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">supervised_user_circle</i>
                            </div>
                            <p class="card-category">Modulo</p>
                            <h3 class="card-title">Usuario</h3>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <a href="{{route('admin.general')}}">
                    <div class="card card-stats">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">account_balance</i>
                            </div>
                            <p class="card-category">Modulo</p>
                            <h3 class="card-title">Generales</h3>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <a href="{{route('admin.usuarios')}}">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">assignment</i>
                            </div>
                            <p class="card-category">Modulo</p>
                            <h3 class="card-title">Mantenimiento</h3>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <a href="{{route('admin.reporte')}}">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">trending_up</i>
                            </div>
                            <p class="card-category">Modulo</p>
                            <h3 class="card-title">Reportes</h3>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               style="color: white"><i class="material-icons">toggle_off</i></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                        <p class="card-category">Cerrar</p>
                        <h3 class="card-title">Sesión</h3>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
