@extends('layouts.plantillabase')

@section('title', 'Tareas Especificas')

@section('contenido')
    <div class="card">
        <div class="card-header p-2 pb-0">
            <table class="table table-sm m-0" width="100%">
                <tr>
                    <td width="12%"><h6><b>Acción Corto Plazo:</b></h6></td>
                    <td><h6>{!!$actividad->operacion->corto_plazo_accion->accion_corto_plazo!!}</h6></td>
                </tr>
                <tr>
                    <td><h6><b>Operación:</b></h6></td>
                    <td><h6>{!!$actividad->operacion->nombre_operacion!!}</h6></td>
                </tr>
                <tr>
                    <td><h6><b>Actividad:</b></h6></td>
                    <td><h6 class="m-0">{{$actividad->nombre_actividad}}</h6></td>
                </tr>
            </table>
        </div>
        <h5 class="card-header py-1 d-flex justify-content-between align-items-center">
            Lista de Tareas Especificas
            <div>
                <a href="javascript:history.back()" class="boton red"><i class="fas fa-arrow-left"></i> Volver Atrás</a>
                <button type="button" id="nuevo" class="boton blue ml-2"><i class="fas fa-plus"></i> Nueva Tarea</button>
            </div>
        </h5>
        <div class="card-body">
            <table id="tareas_especificas" class="table table-striped table-sm" style="width:100%">
                <thead class="thead" style="background-color: skyblue">
                    <tr>
                        <td width='5%'>ID</td>
                        <td>TAREA ESPECIFICA</td>
                        {{-- <th>RESULTADO ESPERADO</th> --}}
                        <td width="15%"></td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    @include('tareas_especificas.modal_tarea_especifica.tarea_especifica_form')


@endsection

@section('js')
    
    <script src="{{asset('libs/js/validacionform/tarea_especifica_validar.js')}}"></script>
    <script>
        var actividad_uuid = "{!!$actividad->uuid!!}";
        $('#tareas_especificas').DataTable({
            "serverSide": true,
            "processing": true,
            "ajax": "/actividades/{!!$actividad->uuid!!}/tareas_especificas/",
            columns: [
                { data: 'id'},
                { data: 'nombre_tarea'},
                // { data: 'resultado_esperado'},
                {
                    data: 'uuid',
                    render: function( data, type, row)
                    {
                        return `
                        <div class="btn-group">
                            <button class="boton blue" data-edit="" onclick="edit('${data}')"><i class="fas fa-pen"></i></button>
                            <button class="boton red ml-2" data-delete="" onclick="delet('${data}')"><i class="fas fa-times-circle"></i></button>
                        </div>
                        `;
                    }
                }
            ],
            "language": {
                "url" : "{{ asset('libs/datatables/es-ES.json') }}"
            }
        })
    </script>

@endsection