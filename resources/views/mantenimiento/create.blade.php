@extends('layouts.app')
@section('breadcrumb')
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <p class="animated fadeInDown">
                    <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span>
                    <a href="{{route('admin.mantenimiento')}}"> Módulo Mantenimiento</a>
                    <span class="fa-angle-right fa"></span>Crear
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
                        <h4 class="card-title">NUEVO MANTENIMIENTO</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-line">
                                    <input type="text" id="id" class="form-control"
                                           placeholder="Escriba la identificación a consultar" name="id"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button onclick="consultar(event)" class="btn bg-info waves-effect btn-block">CONSULTAR
                                    CLIENTE
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 offset-2"  id="equipos">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mantenimiento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detalle</h4>
                </div>
                <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="equipo_id">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <div class="form-line">
                                        <label class="control-label">Descripción</label>
                                        <textarea name="" class="form-control" id="detalle" cols="30" rows="10"
                                                  placeholder="Detalle de la licencia"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="agregarMantenimiento()" class="btn btn-success btn-link"
                            data-dismiss="modal"><i class="material-icons">
                            note_add
                        </i>Agregar
                    </button>
                    <button type="button" class="btn btn-danger btn-link" data-dismiss="modal"><i
                            class="material-icons">
                            cancel
                        </i>Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">

        function consultar(event) {
            event.preventDefault();

            var id = $("#id").val();
            if (id.length <= 0) {
                $.notify({
                    icon: "add_alert",
                    message: 'Por favor ingrese el numero de identificación. Atención!'
                }, {type: 'warning', timer: 3e3, placement: {from: 'bottom', align: 'right'}});
                return;
            } else {

                $.ajax({
                    type: 'GET',
                    url: '{{url("tickest/consultar/")}}/' + id + "/cliente",
                    data: {},
                }).done(function (msg) {
                    if (msg.status == "ok") {
                        const equipos = document.getElementById('equipos');
                        let html = `<div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                                   width="100%" style="width:100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>MARCA</th>
                                    <th>PROCESADOR</th>
                                    <th>MEMORIA RAM</th>
                                    <th>DISCO DURO</th>
                                    <th>CREADO</th>
                                    <th>ACTUALIZADO</th>
                                    <th>ACCIONES</th>
                                </tr>
                                </thead>
                                <tbody>`;
                         let equiposJson  =  msg.response.equipos;

                         equiposJson.forEach(item => {
                               html += `<tr>
                                    <td>${item.id}</td>
                                    <td>${item.marca}</td>
                                    <td>${item.procesador}</td>
                                    <td>${item.memoria_ram}</td>
                                    <td>${item.disco_duro}</td>
                                    <td>${item.created_at}</td>
                                    <td>${item.updated_at}</td>
                                    <td style="text-align: center;">
                                        <a onclick="showModal(event,${item.id})"
                                           class="btn btn-link btn-info btn-just-icon remove" data-toggle="tooltip"
                                           data-placement="top" title="Nuevo Mantenimiento"><i class="material-icons">add_circle</i></a>
                                    </td>
                                </tr>`;
                         });

                         html += ` </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>MARCA</th>
                                <th>PROCESADOR</th>
                                <th>MEMORIA RAM</th>
                                <th>DISCO DURO</th>
                                <th>CREADO</th>
                                <th>ACTUALIZADO</th>
                                <th class="text-right">ACCIONES</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>`;
                         equipos.innerHTML = html;
                    } else {
                        $.notify({
                            icon: "add_alert",
                            message: 'No se encontro registro con esa identificación. Debe llenar el formulario.'
                        }, {type: 'warning', timer: 3e3, placement: {from: 'bottom', align: 'right'}});
                        return;
                    }

                });
            }
        }
        function agregarMantenimiento(){

            let url = '{{url("mantenimiento/mantenimiento ")}}';
            if( $('#detalle').val().length > 0){
                axios.post(url,{
                    'descripcion': $('#detalle').val(),
                    'equipo_id' : $('#equipo_id').val()
                }).then(response => {
                  let data =  response.data;

                  if(data.status == 'ok'){
                      $.notify({
                          icon: "add_alert",
                          message: data.message
                      }, {type: 'success', timer: 3e3, placement: {from: 'top', align: 'right'}});
                  }else{
                      $.notify({
                          icon: "add_alert",
                          message: data.message
                      }, {type: 'danger', timer: 3e3, placement: {from: 'top', align: 'right'}});
                  }

                });
            }else{
                $.notify({
                    icon: "add_alert",
                    message: 'por favor, ingrese una descripción del mantenimiento para poder guardarlo en nuestros registros.'
                }, {type: 'danger', timer: 3e3, placement: {from: 'top', align: 'right'}});
                return;
            }

        }
        function showModal(event,id) {
            event.preventDefault();
            $('#equipo_id').val(id);
            $('#mantenimiento').modal('show');
        }

    </script>
@endsection
