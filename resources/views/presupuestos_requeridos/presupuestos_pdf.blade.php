<style>
   table{
      border-collapse: collapse;
      font-size: 6px;
    }
    th, td{
      border:.5px solid black;
    } 
</style>
<table width="100%" style="padding: 5px;">
   <thead>
      <tr style="background-color: skyblue;">
         <th><strong>ACCION CORTO PLAZO</strong></th>
         <th><strong>PRESUPUESTO SOLICITADO</strong></th>
         <th><strong>FECHA REQUERIDA</strong></th>
      </tr>
   </thead>
   <tbody>
      @forelse ($datos as $dato)
      <tr>
         <td>{{$dato->accion_corto_plazo}}</td>
         <td>{{number_format($dato->presupuesto_programado, 2, ".", ",")}} Bs.</td>
         <td>{{$dato->fecha_inicio}}</td>
      </tr>
      @empty
      <tr>
         <td colspan="3">NO EXISTE REGISTROS</td>
      </tr>
      @endforelse
   </tbody>
</table>