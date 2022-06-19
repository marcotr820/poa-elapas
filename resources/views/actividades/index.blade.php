@extends('layouts.plantillabase')

@section('title', 'Actividades')

@section('contenido')
    <div class="card">
        <h5 class="card-header p-2 pb-0">
            <table class="table table-sm m-0" width="100%">
                <tr>
                    <td width="12%"><h6><b>Acción Corto Plazo:</b></h6></td>
                    <td><h6 class="ml-1">{{$operacion->corto_plazo_accion->accion_corto_plazo}}</h6></td>
                </tr>
                <tr>
                    <td><h6 class="m-0"><b>Operación:</b></h6></td>
                    <td><h6 class="m-0 ml-1">{{$operacion->nombre_operacion}}</h6></td>
                </tr>
            </table>
        </h5>
        <h5 class="card-header py-1 d-flex justify-content-between align-items-center">
            Lista de Actividades
            <div>
                <a href="javascript:history.back()" class="boton red"><i class="fas fa-arrow-left"></i> Volver Atrás</a>
                @if ($operacion->corto_plazo_accion->status != 'monitoreo')
                    <button type="button" id="nuevo" class="boton blue ml-2"><i class="fas fa-plus"></i> Nueva Actividad</button>
                @endif
            </div>
        </h5>
        <div class="card-body">
            <table id="actividades" class="table table-striped table-sm display" style="width:100%">
                <thead class="thead" style="background-color: skyblue">
                    <tr>
                        <td width='5%'>ID</td>
                        <td>ACTIVIDAD</td>
                        <td width="20%">RESULTADOS INTERMEDIOS ESPERADOS</td>
                        <td>ITEMS PRESUPUESTO EJECUTADO</td>
                        <td width='22%'>ACCIONES</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @include('actividades.modal_actividad.actividad_form')

@endsection

@section('js')
    <script src="{{asset('libs/js/validacionform/actividad_validar.js')}}"></script>
    <script>
        var operacion_uuid = "{!!$operacion->uuid!!}";
        $('#actividades').DataTable({
            "serverSide": true,
            "processing": true,
            "ajax": "/operaciones/{!!$operacion->uuid!!}/actividades",
            columns: [
                { data: 'id'},
                { data: 'nombre_actividad'},
                { data: 'resultado_esperado'},
                {
                    data: 'items_presupuesto',
                    render: function(data, type, row) {
                    var number = $.fn.dataTable.render.number( ',', '.', 2, 'Bs ').display(data);
                        return number;
                    }
                },
                {
                    data: 'uuid',
                    render: function( data, type, row)
                    {
                        if(row.status_accion_corto_plazo == 'monitoreo'){
                            return `
                            <div class="btn-group">
                                <button class='boton info ml-3' data-tareas="">Tareas</a>
                                <button class='boton green ml-2' data-items="">Items</a>
                            </div>
                            `;
                        } else {
                            return `
                            <div class="btn-group">
                                <button class="boton blue" data-edit="" onclick="edit('${data}')"><i class="fas fa-pen"></i></button>
                                <button class="boton red ml-2" data-delete="" onclick="delet('${data}')"><i class="fas fa-times-circle"></i></button>
                                <button class='boton info ml-3' data-tareas="">Tareas</a>
                                <button class='boton green ml-2' data-items="">Items</a>
                            </div>
                            `;
                        }
                    }
                }
            ],
            "language": {
                "url" : "{{ asset('libs/datatables/es-ES.json') }}"
            }
        })
    </script>
@endsection