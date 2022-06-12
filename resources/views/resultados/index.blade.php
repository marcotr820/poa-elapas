@extends('layouts.plantillabase')

@section('title', 'Resultados')

@section('contenido')
    <div class="card">
        <div class="bg-light p-2">
            <div class="d-flex">
                <label class="font-weight-bold pr-2">Pilar:</label>
                <p class="m-0">{{$meta->pilar->nombre_pilar}}</p>
            </div>
            <div class="d-flex">
                <label class="font-weight-bold m-0 pr-2">Meta:</label>
                <p class="m-0">{{$meta->nombre_meta}}</p>
            </div>
        </div>
        <h5 class="card-header py-1 d-flex justify-content-between align-items-center">
            Lista de Resultados
            <div>
                <a href="{{ url()->previous() }}" class="boton red mr-3"><i class="fas fa-arrow-left"></i> Volver Atrás</a>
                <button class="boton blue" id="nuevo"><i class="fas fa-plus-circle"></i> Nuevo Resultado</button>
            </div>
        </h5>
        <div class="card-body">
            <table id="resultados" class="table table-striped table-sm display" style="width:100%">
                <thead class="thead" style="background-color: skyblue;">
                    <tr>
                        <td width="5%">ID</td>
                        <td>RESULTADO</td>
                        <td width="25%"></td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @include('resultados.modal_resultado.resultado_form')

@endsection

@section('js')
    
    <script>
        var meta_uuid = "{!!$meta->uuid!!}";
        $('#resultados').DataTable({
        "serverSide": true,
        "processing": true,
        "ajax": "/metas/{!!$meta->uuid!!}/resultados/",
        columns: [
            { data: 'id', name:'resultados.id'},
            { data: 'nombre_resultado'},
            {
                data: 'uuid',
                render: function( data, type, row)
                {
                    return `
                    <div class="btn-group">
                        <button class="boton blue" data-edit="" onclick="edit('${data}')"><i class="fas fa-pen"></i></button>
                        <button class="boton red ml-1" data-delete="" onclick="delet('${data}')"><i class="fas fa-times-circle"></i></button>
                        <button class='boton default ml-4' data-mediano="">mediano plazo acciones</a>
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

    <script src="{{asset('libs/js/validacionform/resultado_validar.js')}}"></script>

@endsection