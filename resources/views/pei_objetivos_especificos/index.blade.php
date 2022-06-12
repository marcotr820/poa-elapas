@extends('layouts.plantillabase')

@section('title', 'Pei Objetivo Institucional Especifico')

@section('contenido')
    <div class="card">
        <div class="bg-light p-2">
            <div class="d-flex">
                <label class="font-weight-bold pr-2">Pilar:</label>
                <p class="m-0">{{$mediano_plazo_accion->resultado->meta->pilar->nombre_pilar}}</p>
            </div>
            <div class="d-flex">
                <label class="font-weight-bold pr-2">Meta:</label>
                <p class="m-0">{{$mediano_plazo_accion->resultado->meta->nombre_meta}}</p>
            </div>
            <div class="d-flex">
                <label class="font-weight-bold pr-2">Resultado:</label>
                <p class="m-0">{{$mediano_plazo_accion->resultado->nombre_resultado}}</p>
            </div>
            <div class="d-flex">
                <label class="font-weight-bold m-0 pr-2">Acción Mediano Plazo:</label>
                <p class="m-0">{{$mediano_plazo_accion->accion_mediano_plazo}}</p>
            </div>
        </div>
        <h5 class="card-header py-1 d-flex justify-content-between align-items-center">
            Lista PEI Objetivos Institucional Especificos
            <div>
                <a href="javascript:history.back()" class="boton red mr-3"><i class="fas fa-arrow-left"></i> Volver Atrás</a>
                <button type="button" id="nuevo" class="boton blue"><i class="fas fa-plus-circle"></i> Nueva Objetivo Gestion</button>
            </div>
        </h5>
        <div class="card-body">
            <table id="pei_objetivos_especificos" class="table table-striped table-sm display" style="width:100%">
                <thead class="thead" style="background-color: skyblue">
                    <tr>
                        <td width="5%">ID</td>
                        <td width="40%">OBJETIVO ESPECIFICO</td>
                        <td width="10%">PONDERACION</td>
                        <td width="18%">INDICADOR DE PROCESO</td>
                        <td>GERENCIA</td>
                        <td width="10%"></td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @include('pei_objetivos_especificos.modal_pei_objetivo_especifico.pei_objetivo_especifico_form')

@endsection

@section('js')
    <script>
        var mediano_plazo_accion_uuid = "{!!$mediano_plazo_accion->uuid!!}";
        $('#pei_objetivos_especificos').DataTable({
            "order": [[ 0, "desc" ]],
            "serverSide": true,
            "processing": true,
            "ajax": "/mediano_plazo_acciones/{!!$mediano_plazo_accion->uuid!!}/pei_objetivos_especificos/",
            columns: [
                { data: 'id', name:'pei_objetivos_especificos.id'},
                { data: 'objetivo_institucional', name:'pei_objetivos_especificos.objetivo_institucional'},
                { 
                    data: 'ponderacion', name:'pei_objetivos_especificos.ponderacion',
                    render: function( data, type, row)
                    {
                        return data + ' %';
                    }
                },
                { 
                    data: 'indicador_proceso', name:'pei_objetivos_especificos.indicador_proceso',
                    render: function( data, type, row)
                    {
                        return data;
                    }
                },
                { data: 'nombre_gerencia', name:'gerencias.nombre_gerencia'},
                { 
                    data: 'uuid',
                    render: function( data, type, row)
                    {
                        return `
                        <div class="btn-group">
                            <button class="boton blue" data-edit="" onclick="edit('${data}')"><i class="fas fa-pen"></i></button>
                            <button class="boton red ml-1" data-delete="" onclick="delet('${data}')"><i class="fas fa-times-circle"></i></button>
                        </div>
                        `;
                    }
                },
            ],
            "language": {
                "url" : "{{ asset('libs/datatables/es-ES.json') }}"
            }
        });
    </script>

    <script src="{{asset('libs/js/validacionform/pei_objetivo_especifico_validar.js')}}"></script>

@endsection