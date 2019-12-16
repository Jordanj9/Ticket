@extends('layouts.app')
@section('breadcrumb')
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <p class="animated fadeInDown">
                    <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> Módulo Reporte
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
                        <h4 class="card-title">REPORTE DE TICKETS</h4>
                    </div>
                </div>
                <div class="col-md-12">
                    @component('layouts.errors')
                    @endcomponent
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group bmd-form-group">
                                    <div class="form-line">
                                        <label class="control-label"> Estado</label>
                                        <select class="selectpicker  col-md-12" data-style="select-with-transition"
                                                title="Single Select" data-size="20" name="estado" id="estado"
                                                required="required">
                                            <option disabled selected>--Seleccione una opción--</option>
                                            <option value="TODO">TODO</option>
                                            <option value="PENDIENTE">PENDIENTE</option>
                                            <option value="FINALIZADO">FINALIZADO</option>
                                            <option value="CANCELADO">CANCELADO</option>
                                            <option value="APLAZADO">APLAZADO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group bmd-form-group is-filled">
                                    <div class="form-line">
                                        <label class="control-label"> Fecha Inicial</label>
                                        <input type="text" class="form-control datepicker" name="fechai" id="fechai"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group bmd-form-group is-filled">
                                    <div class="form-line">
                                        <label class="control-label"> Fecha Final</label>
                                        <input type="text" class="form-control datepicker" name="fechaf" id="fechaf"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <div class="form-line">
                                        <label class="control-label"> Cliente </label>
                                        <select class="form-control select2" data-style="select-with-transition"
                                                style="width: 100%;" name="cliente" id="cliente">
                                            <option disabled selected>--Seleccione una opción--</option>
                                            @foreach($clientes as $key=>$value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <button onclick="getTickets()" class="btn btn-success icon-btn "><i class="material-icons">search</i>Consultar
                        </button>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover table-condensed dataTable " cellspacing="0"
                               width="100%" style="width:100%">
                            <thead>
                            <tr>
                                <th>RADICADO</th>
                                <th>CLIENTE</th>
                                <th>ESTADO</th>
                                <th>SOLICITANTE</th>
                                <th>DEPENDENCIA</th>
                                <th>FECHA</th>
                            </tr>
                            </thead>
                            <tbody id="tb2">

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>RADICADO</th>
                                <th>CLIENTE</th>
                                <th>ESTADO</th>
                                <th>SOLICITANTE</th>
                                <th>DEPENDENCIA</th>
                                <th>FECHA</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {

            var table = $('#datatables').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            });
            // initialise Datetimepicker and Sliders
            md.initFormExtendedDatetimepickers();
            if ($('.slider').length != 0) {
                md.initSliders();
            }
            $('.select2').select2();
        });

        function getTickets() {

            $("#tb2").html("");
            var esta = $("#estado").val();
            var fi = $("#fechai").val();
            var ff = $("#fechaf").val();
            var cli = $("#cliente").val();
            if (esta == null || fi.length <= 0 || ff.length <= 0) {
                $.notify({
                    icon: "add_alert",
                    message: 'Alerta, Debe indicar todos los parámetros para continuar'
                }, {type: 'warning', timer: 3e3, placement: {from: 'top', align: 'right'}});
                return;
            }
            if (cli == null) {
                cli = "null";
            }
            var i = fi.split("/");
            var f = ff.split("/");
            $.ajax({
                type: 'GET',
                url: '{{url("reporte/reporte/menu/")}}/' + esta + "/" + i + "/" + f + "/" + cli + "/tickets",
                data: {},
            }).done(function (msg) {
                console.log(msg);
                if (msg != "null") {
                    var m = JSON.parse(msg);
                    var html = "";
                    $.each(m, function (index, item) {
                        html = html + "<tr><td>" + item.radicado + "</td>";
                        html = html + "<td>" + item.cliente + "</td>";
                        html = html + "<td>" + item.estado + "</td>";
                        html = html + "<td>" + item.solicitante + "</td>";
                        html = html + "<td>" + item.dependencia + "</td>";
                        html = html + "<td>" + item.fecha + "</td>";
                        +"</tr>";
                    });
                    $("#tb2").html(html);
                    table.ajax.reload();
                } else {
                    $.notify({
                        icon: "add_alert",
                        message: 'Alerta, No hay tickets para los parametros seleccionados.'
                    }, {type: 'warning', timer: 3e3, placement: {from: 'top', align: 'right'}});
                    return;
                }
            });
        }

    </script>
@endsection
