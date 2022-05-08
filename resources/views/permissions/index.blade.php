@extends('layouts.plantillabase')

@section('contenido')
    <!-- CSRF Token -->
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <div class="card">
        <h5 class="card-header py-1 d-flex justify-content-between align-items-center">
            Lista Permisos
            <div>
                <button type="button" id="nuevo" class="boton blue"><i class="fas fa-plus"></i> Nuevo Permiso</button>
            </div>
        </h5>
        <div class="card-body">
            <table id="permisos" class="table table-striped table-sm display" style="width:100%">
                <thead class="thead" style="background-color: skyblue";>
                    <tr>
                        <td width="5%">ID</td>
                        <td width="">PERMISO</td>
                        <td width="15%"></td>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    @include('permissions.modal_permissions.permissions_form')
    
@endsection


@section('js')

    <script>
    $('#permisos').DataTable({ //declaramos variable global
        "serverSide": true,
        "processing": true,
        "ajax": "{{route('permissions.index')}}",
        columns: [
            { data: 'id'},
            { data: 'name'},
            {
                data: 'id',
                render: function( data, type, row)
                {
                    return `
                    <div class="btn-group">
                        <button class="boton blue" data-edit="" onclick="edit('${data}')"><i class="fas fa-pen"></i></button>
                        <form class="d-inline" data-delete="">
                            @csrf
                            <button type="submit" class="boton red ml-2"><i class="fas fa-times-circle"></i></button>
                        </form>
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

    <script src="{{asset('libs/js/validacionform/permission_validar.js')}}"></script>

@endsection