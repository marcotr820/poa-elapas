@extends('layouts.plantillabase')

@section('title', 'Metas')

@section('contenido')
    <div class="card">
        <div class="bg-light p-2">
            <div class="d-flex">
                <label class="font-weight-bold m-0 pr-2">Pilar:</label>
                <p class="m-0">{{ $pilar->nombre_pilar }}</p>
            </div>
        </div>
        <h5 class="card-header py-1 d-flex justify-content-between align-items-center">
            Lista de Metas
            <div>
                <a href="javascript:history.back()" class="boton red mr-2"><i class="fas fa-arrow-left"></i> Volver Atrás</a>
                <button class="boton blue" id="nuevo"><i class="fas fa-plus"></i> Nueva Meta</button>
            </div>
        </h5>
        <div class="card-body">
            <table id="metas" class="table table-striped display table-sm" style="width:100%">
                <thead class="thead" style="background-color: skyblue;">
                    <tr>
                        <td width="5%">ID</td>
                        <td>META</td>
                        <td width="18%">ACCIONES</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @include('metas.modal_meta.meta_form')

@endsection

@section('js')
    <script>
        var pilar_uuid = "{!!$pilar->uuid!!}";
        $('#metas').DataTable({
            "serverSide": true,
            "processing": true,
            "ajax": '/pilares/{!!$pilar->uuid!!}/metas',
            columns: [
                { data: 'id', name:'metas.id'},
                { data: 'nombre_meta', name:'metas.nombre_meta'},
                {
                    data: 'uuid',
                    render: function( data, type, row)
                    {
                        return `
                        <div class="btn-group">
                            <button class="boton blue" data-edit="" onclick="edit('${data}')"><i class="fas fa-pen"></i></button>
                            <button class="boton red ml-1" data-delete="" onclick="delet('${data}')"><i class="fas fa-times-circle"></i></button>
                            <button class='boton default ml-4' data-resultados="">Resultados</a>
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

    <script src="{{asset('libs/js/validacionform/meta_validar.js')}}"></script>

@endsection