@extends('layouts.plantillabase')

@section('title', 'Acciones Corto Plazo')

@section('contenido')

    <div class="card">
        <h5 class="card-header">
            <table style="vertical-align: center;">
                <tr>
                    <td width="13%"><h6><b>Objetivo Gestion:</b></h6></td>
                    <td class="pl-1"><h6>{{$pei_objetivo_especifico->objetivo_institucional}}</h6></td>
                </tr>
                <tr>
                    <td><h6 class="m-0"><strong>Gerencia:</strong></h6></td>
                    <td><h6 class="m-0 pl-1">{{$pei_objetivo_especifico->gerencia->nombre_gerencia}}</h6></td>
                </tr>
            </table>
        </h5>
        <h5 class="card-header py-1 d-flex justify-content-between align-items-center">
            Lista Acciones Corto Plazo
            <div>
                <a href="{{ route('poa.index') }}" class="boton red"><i class="fas fa-arrow-left"></i> Volver Atrás</a>
                <button type="button" id="nuevo" class="boton blue ml-2"><i class="fas fa-plus"></i> Nueva Accion Corto Plazo</button>
            </div>
        </h5>
        <div class="card-body">
            <table id="corto_plazo_acciones" class="table table-striped table-sm display" style="width:100%">
                <thead class="thead" style="background-color: skyblue;">
                    <tr>
                        <td width="20%">ACCION CORTO PLAZO</td>
                        <td width="6%">GESTION</td>
                        <td width="12%">RESULTADO ESPERADO</td>
                        <td width="15%">PRESUPUESTO PROGRAMADO</td>
                        <td width="8%">FECHA INICIO</td>
                        <td width="8%">FECHA FIN</td>
                        <td width="10%"></td>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    @include('corto_plazo_acciones.modal_corto_plazo_accion.corto_plazo_accion_form')

@endsection

@section('js')
    
    <script>
        var pei_uuid = "{!!$pei_objetivo_especifico->uuid!!}";
        $('#corto_plazo_acciones').DataTable({    
            "serverSide": true,
            "processing": true,
            "ajax": "/pei_objetivos_especifico/{!!$pei_objetivo_especifico->uuid!!}/corto_plazo_acciones/",
            columns: [
                { data: 'accion_corto_plazo'},
                { data: 'gestion'},
                { data: 'resultado_esperado'},
                { 
                    data: 'presupuesto_programado',
                    render: function(data, type) {
                    var number = $.fn.dataTable.render.number( ',', '.', 2, 'Bs ').display(data);
                        return number;
                    }
                },
                { data: 'fecha_inicio'},
                { data: 'fecha_fin'},
                {
                    data: 'status',
                    render: function( data, type, row)
                    {
                        switch(data){
                            case 'editar':
                                return `
                                <button class="boton blue" data-edit="" onclick="edit('${row.uuid}')"><i class="fas fa-pen"></i></button>
                                `;
                            break;

                            case 'presentado':
                                return `
                                <div class="btn-group">
                                    <button class="boton blue" data-edit="" onclick="edit('${row.uuid}')"><i class="fas fa-pen"></i></button>
                                    <button class="boton red ml-2" data-delete="" onclick="delet('${row.uuid}')"><i class="fas fa-times-circle"></i></button>
                                </div>
                                `;
                            break;

                            case 'aprobado':
                                if(row.planificacion >= 1){
                                    return '<button class="boton info" data-operaciones="">Operaciones</button>';
                                }
                                else{
                                    return '<button class="boton green" data-planificacion="">Planificacion</button>';
                                }
                            break;

                            case 'monitoreo':
                                return `
                                <button class='boton default'>monitoreo</button>
                                `;
                            break;
                        }
                    }
                }
            ],
            "language": {
                "url" : "{{ asset('libs/datatables/es-ES.json') }}"
            }
        });
    </script>

    <script src="{{asset('libs/js/validacionform/corto_plazo_accion_validar.js')}}"></script>

@endsection