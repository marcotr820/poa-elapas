@extends('layouts.plantillabase')

@section('contenido')
    <div class="card border-dark">
        <h5 class="card-header border-dark p-2 pb-0">
            <table class="table table-sm m-0" width="100%">
                <tr>
                    <td width="15%"><h6><b>Acción Corto Plazo:</b></h6></td>
                    <td><h6>{!!$actividad->operacion->corto_plazo_accion->accion_corto_plazo!!}</h6></td>
                </tr>
                <tr>
                    <td><h6><b>Presupuesto Asignado:</b></h6></td>
                    <td><h6>{!!number_format($actividad->operacion->corto_plazo_accion->presupuesto_programado, 2, ".", ",")!!} Bs.</h6></td>
                </tr>
                <tr>
                    <td><h6><b>Operación:</b></h6></td>
                    <td><h6>{!!$actividad->operacion->nombre_operacion!!}</h6></td>
                </tr>
                <tr>
                    <td><h6><b>Actividad:</b></h6></td>
                    <td><h6>{{$actividad->nombre_actividad}}</h6></td>
                </tr>
                <tr>
                    <td><h6><b>Presupuesto Restante:</b></h6></td>
                    <td><h6>{{ number_format($actividad->operacion->corto_plazo_accion->presupuesto_programado - $accion->items->sum('presupuesto'), 2, '.', ',') }} Bs.</h6></td>
                </tr>
                <tr>
                    <td><h6 class="m-0"><b>Presupuesto Ejecutado:</b></h6></td>
                    <td class="d-flex flex-row">
                        <h6 class="m-0 mr-2 d-inline-block" style="width: 15%">{{number_format($accion->items->sum('presupuesto'), 2, '.', ',')}} Bs.</h6>
                        <div class="progress border border-dark" style="height: 18px; width: 85%;">
                            <div class="progress-bar" role="progressbar" 
                                style="width:{{ ($accion->items->sum('presupuesto')/$accion->presupuesto_programado)*100 }}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                {{ round(($accion->items->sum('presupuesto')/$accion->presupuesto_programado)*100, 2) }}%
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </h5>
        <h5 class="card-header border-dark py-1 d-flex justify-content-between align-items-center">
            Lista de Items
            <div>
                <a href="javascript:history.back()" class="boton red"><i class="fas fa-arrow-left"></i> Volver Atrás</a>
                <button type="button" id="nuevo" class="boton blue ml-2"><i class="fas fa-plus"></i> Nuevo Item</button>
            </div>
        </h5>
        <div class="card-body">
            <table id="items" class="table table-striped table-sm display" style="width:100%">
                <thead class="thead" style="background-color: skyblue;">
                    <tr>
                        <td width='5%'>ID</td>
                        <td>BIEN O SERVICIO</td>
                        <td>FECHA REQUERIDA</td>
                        <td>PRESUPUESTO</td>
                        <td>PARTIDA</td>
                        <td width="12%"></td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @include('items.modal_item.item_form')


@endsection

@section('js')
    
    <script src="{{asset('libs/js/validacionform/item_validar.js')}}"></script>
    <script>
        var actividad_uuid = "{!!$actividad->uuid!!}";
        $('#items').DataTable({
            "serverSide": true,
            "processing": true,
            "ajax": "/actividades/{!!$actividad->uuid!!}/items/",
            columns: [
                { data: 'id', name: 'items.id'},
                { data: 'bien_servicio', name: 'items.bien_servicio'},
                { data: 'fecha_requerida', name: 'items.fecha_requerida'},
                { 
                    data: 'presupuesto', name: 'items.presupuesto',
                    render: function(data, type) {
                    var number = $.fn.dataTable.render.number( ',', '.', 2, 'Bs ').display(data);
                        return number;
                    }
                },
                { data: 'nombre_partida', name: 'partidas.nombre_partida'},
                {
                    data: 'uuid',
                    render: function( data, type, row)
                    {
                        return `
                        <div class="btn-group">
                            <button class="boton blue" data-edit="" onclick="edit('${data}')"><i class="fas fa-pen"></i></button>
                            <button class="boton red ml-2" data-delete="" onclick="delet('${data}')"><i class="fas fa-trash"></i></button>
                        </div>
                        `;
                    }
                }
            ],
            "language": {
                "url" : "{{ asset('libs/datatables/es-ES.json') }}"
            }
        });
    </script>

@endsection