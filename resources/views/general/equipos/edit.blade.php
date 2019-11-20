@extends('layouts.app')
@section('breadcrumb')
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <p class="animated fadeInDown">
                    <a href="{{route('inicio')}}">Inicio </a><span class="fa-angle-right fa"></span><a
                        href="{{route('admin.general')}}"> General </a><span
                        class="fa-angle-right fa"></span><a href="{{route('equipos.index')}}"> Equipos</a><span
                        class="fa-angle-right fa"></span> Editar
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
                        <h4 class="card-title">DATOS DEL EQUIPO</h4>
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
                        <form class="form-horizontal" method="POST" action="{{route('equipos.update',$equipo->id)}}">
                            @csrf
                            <input name="_method" type="hidden" value="PUT"/>
                            <div class="row">
                                <div class="col-md-8">
                                </div>
                                <div class="col-md-4">
                                    <a data-toggle="modal" data-target="#clientes"
                                       class="btn bg-info waves-effect btn-block">CONSULTAR PROPIETARIO DEL EQUIPO
                                    </a>
                                </div>
                            </div>
                            <div class="row" id="datos_cliente" >
                                <div class="col-md-4">
                                    <input type="hidden" name="cliente_id" id="cliente_id" required value="{{$cliente['id']}}">
                                    <input type="hidden" name="tipo" id="tipo" required value="{{$cliente['tipo']}}">
                                    <div class="form-group bmd-form-group">
                                        <div class="form-line">
                                            <label class="control-label">Identificaciòn</label>
                                            <input type="text" class="form-control" value="{{$cliente['identificacion']}}"
                                                   required="required" id="identificacion_cliente" disabled placeholder=""
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group bmd-form-group">
                                        <div class="form-line">
                                            <label class="control-label">Nombres</label>
                                            <input type="text" class="form-control" value="{{$cliente['nombre']}}"
                                                   required="required" id="nombre_cliente" disabled placeholder=""
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <h4>Descripción del Producto</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <div class="form-line">
                                            <label class="control-label">Año de Aquisiciòn</label>
                                            <input type="number" min="1998" max="2019" class="form-control" value="{{$equipo->anio_adquicision}}" name="anio_adquicision"
                                                   required="required" placeholder="Año en el cual el cliente adquirio el equipo"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <div class="form-line">
                                            <label class="control-label">Pantalla</label>
                                            <input type="text" class="form-control" name="pantalla" value="{{$equipo->pantalla}}"
                                                   required="required" placeholder="Detalle de la pantalla"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group bmd-form-group">
                                        <div class="form-line">
                                            <label class="control-label">Marca</label>
                                            <input type="text" class="form-control" value="{{$equipo->marca}}" name="marca"
                                                   required="required" placeholder="marca del equipo"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group bmd-form-group">
                                        <div class="form-line">
                                            <label class="control-label">Procesador</label>
                                            <input type="text" class="form-control"
                                                   required="required" value="{{$equipo->procesador}}" name="procesador" placeholder="Detalle del procesador"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group bmd-form-group">
                                        <div class="form-line">
                                            <label class="control-label">Memoria Ram</label>
                                            <input type="text" class="form-control"
                                                   required="required" value="{{$equipo->memoria_ram}}" name="memoria_ram"
                                                   placeholder="Detalle de la memoria ram"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group bmd-form-group">
                                        <div class="form-line">
                                            <label class="control-label">Disco Duro</label>
                                            <input type="text" class="form-control"
                                                   required="required" value="{{$equipo->disco_duro}}" name="disco_duro"
                                                   placeholder="Detalle del disco duro"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group bmd-form-group">
                                        <div class="form-line">
                                            <label class="control-label">Licencias</label>
                                            <textarea id="licencias" disabled
                                                      class="form-control" id="" cols="30" rows="10" name ="licencias"
                                                      placeholder="licencias con las que cuenta el equipo">{{$equipo->licencias}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                </div>
                                <div class="col-md-4" style="margin-top: -150px;">
                                    <a data-toggle="modal" data-target="#licencia"
                                       class="btn bg-defaut waves-effect btn-round"><i class="material-icons">
                                            fingerprint
                                        </i> Agregar licencia
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                </div>
                                <div class="col-md-4" style="margin-top: -100px;">
                                    <a onclick="editLicencia()"
                                       class="btn bg-success waves-effect btn-round"><i class="material-icons">
                                            fingerprint
                                        </i> Editar licencias
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 offset-3">
                                <div class="form-group">
                                    <br/><br/><a href="{{route('equipos.index')}}" class="btn btn-danger btn-round">Cancelar</a>
                                    <button class="btn btn-info btn-round" type="reset">Limpiar Formulario</button>
                                    <button class="btn btn-success btn-round" type="submit" onclick="guardar(event)">Guardar</button>
                                </div>
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
                    <strong>Agregue nuevos Equipos,</strong> el nombre del módulo no debe llevar acentos, eñes (ñ) ni
                    caracteres especiales, el nombre del módulo debe iniciar con "MOD_" seguido del nombre que usted
                    desee. Los módulos generales del sistema son las aplicaciones generales representadas en las
                    opciones del menú. Ejemplo de modulo general: MOD_INICIO, MOD_USUARIO, ETC.
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">ACEPTAR</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="clientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Clientes Registrados</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                               width="100%" style="width:100%">
                            <thead>
                            <tr>
                                <th>IDENTIFICACION</th>
                                <th>NOMBRES</th>
                                <th>TIPO PERSONA</th>
                                <th class="text-right">ACCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clientes as $cliente)
                                <tr>
                                    <td>{{$cliente['identificacion']}}</td>
                                    <td>{{$cliente['nombre']}}</td>
                                    <td>{{$cliente['tipo']}}</td>
                                    <td style="text-align: center;">
                                        <a href=""
                                           onclick="selecionarCliente(event,'{{$cliente['identificacion']}}','{{$cliente['nombre']}}','{{$cliente['id']}}','{{$cliente['tipo']}}')"
                                           class="btn btn-link btn-info btn-just-icon remove" title="Editar Equipo"><i
                                                class="material-icons">
                                                arrow_forward_ios
                                            </i></a>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>IDENTIFICACION</th>
                                <th>NOMBRES</th>
                                <th>TIPO PERSONA</th>
                                <th class="text-right">ACCIONES</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="licencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detalle</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group bmd-form-group">
                                <div class="form-line">
                                    <label class="control-label">Programa</label>
                                    <input type="text" class="form-control"
                                           required="required" id="programa_id"
                                           placeholder="programa al que pertenece la licencia"
                                    />
                                </div>
                            </div>
                        </div>
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
                    <button type="button" onclick="agregarLicecncia()" class="btn btn-success btn-link"
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
            table.on('click', '.edit', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
            });

            // Delete a record
            table.on('click', '.remove', function(e) {
                $tr = $(this).closest('tr');
                table.row($tr).remove().draw();
                e.preventDefault();
            });

            //Like record
            table.on('click', '.like', function() {
                alert('You clicked on Like button');
            });
        });
        function selecionarCliente(event, identificacion, nombres,id,tipo) {
            event.preventDefault();
            $('#clientes').modal('hide');
            $('#identificacion_cliente').val(identificacion);
            $('#nombre_cliente').val(nombres);
            $('#cliente_id').val(id);
            $('#tipo').val(tipo);
            $('#datos_cliente').attr('style', 'display:flex;');
        }


        function agregarLicecncia() {
            $('#licencia').modal('hide');
            const programa = $("#programa_id").val();
            const detalle = $("#detalle").val();
            const licencia =$("#licencias").val() + programa + "\n" + detalle + "\n";
            $("#licencias").val(licencia);
            $("#programa_id").val("");
            $("#detalle").val("");
        }

        function guardar(){
            const clientehasValue = $('#cliente_id').val().length > 0;
            $('#licencias').removeAttr('disabled');
            if(!clientehasValue){
                $.notify({
                    icon: "add_alert",
                    message: 'Debe selecionar el cliente al cual pertenece el equipo a registrar.'
                }, {type: 'danger', timer: 3e3, placement: {from: 'top', align: 'right'}});
            }
        }

        function editLicencia(){
            $('#licencias').removeAttr('disabled');
        }

    </script>
@endsection
