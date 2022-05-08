@extends('layouts.plantillabase')

@section('contenido')

<style>
  /* input[type="radio"]{
    display: none;
  }
  .form-check label{
    padding: 10px;
    border: 1px solid black;
    width: 100%;
    border-radius: 5px;
    display: flex;
    align-items: center;
    cursor: pointer;
  }
  input[type="radio"]:checked + label{
    background-color:#3490dc;
    color: #fff;
    transition: 0.3s;
  } */

  .select-box{
    display: block;
    width: 400px;
  }
  .select-box .options-container{
    background-color: #fff;
    width: 100%;
    border-radius: 5px;
    overflow-y: scroll;
    max-height: 240px;
    border: 1px solid black;
  }
  .select-box .option label{
    margin: 0;
    padding: 10px 24px;
    width: 100%;
    font-size: 12px;
    border-bottom: 1px solid #808080;
  }
  .select-box .option .radio{
    display: none;
  }
  .select-box .option .radio[type="radio"]:checked + label{
    background-color:#ddd;
  }
</style>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" id="primer_modal">
   Launch demo modal
 </button>
 
 <!-- Modal -->
 <div class="modal fade animado" id="modal1" tabindex="-1">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">@</span>
            </div>
            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">@</span>
            </div>
            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
          </div>

          <button class="btn btn-danger" id="segundo_modal">segundo modal</button>
          
          <table class="table" id="datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
                <th>ACCIONES</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td><button class="btn btn-danger btn-sm" id="segundo_modal">segundo modal</button></td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                <td><button class="btn btn-danger btn-sm" id="segundo_modal">segundo modal</button></td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
                <td><button class="btn btn-danger btn-sm" id="segundo_modal">segundo modal</button></td>
              </tr>
            </tbody>
          </table>

       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <button type="button" class="btn btn-primary">Save changes</button>
       </div>
     </div>
   </div>
 </div>

 <!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-id="" data-toggle="modal" data-target="#radiobutton">
  radio buttons
</button>

<!-- Modal -->
<div class="modal fade animado" id="radiobutton" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-check p-0">
          <input type="radio" class="" name="accion" id="editar">
          <label for="editar">Editar</label>
        </div>

        <div class="form-check p-0">
          <input type="radio" class="" name="accion" id="aprobar">
          <label for="aprobar">Aprobar</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<hr>
{{-- select html css --}}
  <div class="select-box">
    <input class="btn btn-light" type="button" value="seleccione...">
    <div class="options-container">
      @for ($i = 0; $i <= 10; $i++)
        <div class="option">
          <input type="radio" class="radio" id="{{$i}}" name="category">
          <label for="{{$i}}">{{$i}}Apache 2.0</label>
        </div>
      @endfor
    </div>
  </div>

@endsection

@section('js')
    <script src="{{asset('libs/js/validacionform/actividad_validar.js')}}"></script>
    <script>
      $('#datatable').DataTable();

      d.addEventListener('click', (e)=>{
        if(e.target.matches('#primer_modal')){
          $('#modal1').modal('show');
        }
        if(e.target.matches('#segundo_modal')){
          $('#radiobutton').modal('show');
        }
      })
    </script>

@endsection