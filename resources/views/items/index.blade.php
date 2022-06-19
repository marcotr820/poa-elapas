@extends('layouts.plantillabase')

@section('title', 'Items Servicios')

@section('css')
    <style>
        .skill-box{
            padding: 0 15px;
            width: 75%;
        }
        .skill-box .title{
            display: block;
            font-size: 14px;
            font-weight: 600;
        }
        .skill-box .skill-bar{
            height: 15px;
            width: 100%;
            margin-top: 5px;
            border-radius: 6px;
            background: rgba(0,0,0,0.2)
        }
        .skill-bar .skill-per{
            position: relative;
            display: block;
            height: 100%;
            /* width: 20%; */
            border-radius: 6px;
            background: #004D99;
            animation: progress 1.2s ease-in-out;
        }
        @keyframes progress{
            0%{
                width: 0%;
                opacity: 0.5;
            }
            100%{
                opacity: 1;
            }
        }
        .skill-per .tip{
            color: #fff;
            padding: 1px 3px;
            position: absolute;
            right: -12px;
            top: -28px;
            font-size: 12px;
            border-radius: 4px;
            background-color: #000;
            z-index: 1;
        }
        .tip::before{
            content: '';
            position: absolute;
            width: 10px;
            height: 10px;
            bottom: -4px;
            background-color: #000;
            left: 50%;
            transform: translateX(-50%) rotate(45deg);
            z-index: -1;
        }
    </style>
@endsection

@section('contenido')
    <div class="card border-dark">
        <div class="bg-light p-2">
            <div class="d-flex">
                <label class="font-weight-bold pr-2">Acción Corto Plazo:</label>
                <p class="m-0">{{$actividad->operacion->corto_plazo_accion->accion_corto_plazo}}</p>
            </div>
            <div class="d-flex">
                <label class="font-weight-bold pr-2">Presupuesto Asignado:</label>
                <p class="m-0">{{number_format($actividad->operacion->corto_plazo_accion->presupuesto_programado, 2, ".", ",")}} Bs.</p>
            </div>
            <div class="d-flex">
                <label class="font-weight-bold pr-2">Operación:</label>
                <p class="m-0">{{$actividad->operacion->nombre_operacion}}</p>
            </div>
            <div class="d-flex">
                <label class="font-weight-bold pr-2">Actividad:</label>
                <p class="m-0">{{$actividad->nombre_actividad}}</p>
            </div>
            <div class="d-flex">
                <label class="font-weight-bold pr-2">Presupuesto Restante:</label>
                <p class="m-0">{{ number_format($actividad->operacion->corto_plazo_accion->presupuesto_programado - $accion->items->sum('presupuesto'), 2, '.', ',') }} Bs.</p>
            </div>
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <label class="font-weight-bold pr-2">Presupuesto Ejecutado:</label>
                    <p class="m-0">{{number_format($accion->items->sum('presupuesto'), 2, '.', ',')}} Bs.</p>
                </div>
                <div class="skill-box">
                    <span class="title">Porcentaje Ejecutado:</span>
                    <div class="skill-bar">
                        <span class="skill-per">
                            <span class="tip">{{ round(($accion->items->sum('presupuesto')/$accion->presupuesto_programado)*100) }}%</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <h5 class="card-header border-dark py-1 d-flex justify-content-between align-items-center">
            Lista de Items
            <div>
                <a href="javascript:history.back()" class="boton red"><i class="fas fa-arrow-left"></i> Volver Atrás</a>
                @if ($actividad->operacion->corto_plazo_accion->status != 'monitoreo')
                    <button type="button" id="nuevo" class="boton blue ml-2"><i class="fas fa-plus"></i> Nuevo Item</button>
                @endif
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
                        <td width="12%">ACCIONES</td>
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
        var total_progress = '{{ round(($accion->items->sum('presupuesto')/$accion->presupuesto_programado)*100) }}%';
        document.querySelector('.skill-per').style.width = total_progress;

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
                { data: 'partida.nombre_partida', name: 'partida.nombre_partida'},
                {
                    data: 'uuid',
                    render: function( data, type, row)
                    {
                        if(row.status_accion_corto_plazo == 'monitoreo'){
                            return null;
                        } else {
                            return `
                            <div class="btn-group">
                                <button class="boton blue" data-edit="" onclick="edit('${data}')"><i class="fas fa-pen"></i></button>
                                <button class="boton red ml-2" data-delete="" onclick="delet('${data}')"><i class="fas fa-times-circle"></i></button>
                            </div>
                            `;
                        }
                    }
                }
            ],
            "language": {
                "url" : "{{ asset('libs/datatables/es-ES.json') }}"
            }
        });
    </script>

@endsection