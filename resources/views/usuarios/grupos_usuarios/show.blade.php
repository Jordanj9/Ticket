@extends('layouts.app')
@section('breadcrumb')
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <p class="animated fadeInDown">
                    <a href="{{route('inicio')}}">Inicio </a><span class="fa-angle-right fa"></span><a
                        href="{{route('admin.usuarios')}}"> Usuarios </a><span
                        class="fa-angle-right fa"></span><a href="{{route('pagina.index')}}"> Grupo de
                        Usuarios </a><span class="fa-angle-right fa"></span> Ver
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
                        <h4 class="card-title">DATOS DEL GRUPO SELECCIONADO</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        @component('layouts.errors')
                        @endcomponent
                    </div>
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <tbody>
                            <tr class="read">
                                <td class="contact"><b>Id del Grupo</b></td>
                                <td class="subject">{{$grupo->id}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Nombre</b></td>
                                <td class="subject">{{$grupo->nombre}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Descripción</b></td>
                                <td class="subject">{{$grupo->descripcion}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Cantidad de Usuarios en el Grupo</b></td>
                                <td class="subject">{{$total}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Creado</b></td>
                                <td class="subject">{{$grupo->created_at}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Modificado</b></td>
                                <td class="subject">{{$grupo->updated_at}}</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="list-group">
                            <a class="list-group-item active" style="color: white; background-color: #296a3c">
                                MÓDULOS A LOS QUE TIENE ACCESO EL GRUPO DE USUARIOS
                            </a>
                            @foreach($grupo->modulos as $modulo)
                                <span class="list-group-item">{{$modulo->nombre}} ==> {{$modulo->descripcion}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">

    </script>
@endsection
