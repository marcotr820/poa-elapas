@extends('layouts.plantillabase')

@section('title', 'Administrar Estados POA')

@section('css')
<style>
   table{
       font-size: 12px !important;
   }
</style>
@endsection

@section('contenido')
    <div class="cabecera_pagina">
        <h5>Administrar POA presupuestos</h5>
    </div>
    
    <select id="select2" class="select2" onchange="cambio()" style="width: 100%, display: flex;">
        <option value=""> -- Seleccione Objetivo Institucional Especifico -- </option>
        @foreach ($objetivos_especificos as $obj)
            <option value="{{$obj->uuid}}" data-gerencia="{{$obj->gerencia->nombre_gerencia}}">{{$obj->gerencia->nombre_gerencia}} >> {{$obj->objetivo_institucional}}</option>
        @endforeach
    </select>

    <hr>

    <div class="card">
        <div class="card-header pl-2">
            <table>
                <tr>
                    <td class="pr-2 mb-5"><strong>OBJETIVO ESPECIFICO:</strong></td>
                    <td><span class="objetivo_especifico"></span></td>
                </tr>
                <tr>
                    <td><strong>GERENCIA:</strong></td>
                    <td><span class="gerencia"></span></td>
                </tr>
            </table>
        </div>
        <div class="card-body p-2">
        <table class="table table-striped table-sm" id="table" width="100%">
            <thead style="background-color: skyblue">
                <tr>
                    <th>ACCION CORTO PLAZO</th>
                    <th>PRESUPUESTO REQUERIDO</th>
                    <th>STATUS</th>
                    <th width="7%"></th>
                </tr>
            </thead>
        </table>
        </div>
    </div>

    @include('admin_poa.modal_admin_poa.admin_poa_form')

@endsection

@section('js')
    <script>
        $('.select2').select2({
            theme: 'bootstrap4',
            // dropdownCssClass: "badge"
        });

        $('#table').DataTable({
            "language": {
                "url" : "{{ asset('libs/datatables/es-ES.json') }}"
            }
        });
    </script>
    <script src="{{asset('libs/js/admin_poa.js')}}"></script>

@endsection