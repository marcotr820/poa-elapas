const d = document;
//Initialize Select2 Elements

$('.select2').select2({
   theme: 'bootstrap4'
});

function edit(item_uuid){
   d.getElementById('form').onsubmit = function(e){
      if(! e.target.hasAttribute('data-form')){
         e.preventDefault();
         d.querySelector('.spinner-border').style.display = 'inline-block';
         d.getElementById('btnGuardar').disabled = true;
         d.querySelectorAll('[data-error="textarea"]').forEach((el)=>{ el.classList.remove('is-invalid') });
         d.querySelectorAll('[data-error="input"]').forEach((el)=>{ el.classList.remove('is-invalid') });
         d.querySelectorAll('[data-error="span"]').forEach((el)=>{ el.textContent = '' });
         d.querySelectorAll('[data-error="select"]').forEach((el)=>{ el.classList.remove('is-invalid') });
         axios.put('/items/'+ item_uuid,{
            bien_servicio: d.getElementById('bien_servicio').value,
            fecha_requerida: d.getElementById('fecha_requerida').value,
            presupuesto: d.getElementById('presupuesto').value,
            partida_id: d.getElementById('partida_id').value
         })   
         .then(function (resp){
            // console.log(resp);
            location.reload();
            // $('#modal').modal('hide');
            // $('#items').DataTable().ajax.reload();
         })
         .catch(function (error){
            const objeto = error.response.data.errors; //creamos el objeto para luego recorrerlo
            if (error.response.data.hasOwnProperty('errors')) //preguntamos si exite la propiedad donde se almacenan los errores false/true
            {
               d.querySelector('.spinner-border').style.display = 'none';
               d.getElementById('btnGuardar').disabled = false;
                for (let key in  objeto) 
                {
                    console.log(key);
                    console.log(objeto[key]);
                    //key nombre del campo ej. nombre_operacion
                    //objeto[key] valor ej. "El campo nombre operacion es obligatorio. SU VALOR"
                    d.getElementById(key).classList.add('is-invalid');
                    d.getElementById(key+'-error').textContent = objeto[key];
                }
            }
         })
      }
   }
}

function delet(item_uuid){
   d.getElementById('form_delete').onsubmit = function(e){
      e.preventDefault();
      axios.delete('/items/' + item_uuid)
      .then(function (response) {
         location.reload();
         // $('#modal_delete').modal('hide');
         // $('#items').DataTable().ajax.reload(null, false);
      })
      .catch(function (error) {
         
      });
   }
}

// EVENTO CLICK
d.addEventListener('click', (e)=>{
   // ENFOCAR input select2
   if(e.target.matches('.select2-selection__rendered')){
      if(d.querySelector('.select2-search__field') != null){
          d.querySelector('.select2-search__field').focus();
      }   
   }

   if(e.target.matches('#nuevo') || e.target.matches('#nuevo *'))
   {
      d.querySelector('.spinner-border').style.display = 'none';
      d.getElementById('btnGuardar').disabled = false;
      d.querySelectorAll('[data-error="textarea"]').forEach((el)=>{ el.classList.remove('is-invalid') });
      d.querySelectorAll('[data-error="input"]').forEach((el)=>{ el.classList.remove('is-invalid') });
      d.querySelectorAll('[data-error="span"]').forEach((el)=>{ el.textContent = '' });
      d.querySelectorAll('[data-error="select"]').forEach((el)=>{ el.classList.remove('is-invalid') });
      d.getElementById('form').reset();
      d.querySelector('.modal-title').textContent = 'Nuevo Item Servicio';
      d.getElementById('form').setAttribute('data-form', '');
      $('#modal').modal('show');
   }

   if(e.target.matches('[data-edit]') || e.target.matches('[data-edit] *'))
   {
      d.querySelector('.spinner-border').style.display = 'none';
      d.getElementById('btnGuardar').disabled = false;
      d.querySelectorAll('[data-error="textarea"]').forEach((el)=>{ el.classList.remove('is-invalid') });
      d.querySelectorAll('[data-error="input"]').forEach((el)=>{ el.classList.remove('is-invalid') });
      d.querySelectorAll('[data-error="span"]').forEach((el)=>{ el.textContent = '' });
      d.querySelectorAll('[data-error="select"]').forEach((el)=>{ el.classList.remove('is-invalid') });
      const data = $('#items').DataTable().row($(e.target).parents('tr') ).data();
      console.log(data);
      d.querySelector('.modal-title').textContent = 'Editar Item Servicio';
      d.getElementById('form').removeAttribute('data-form');
      d.getElementById('bien_servicio').value = data['bien_servicio'];
      d.getElementById('fecha_requerida').value = data['fecha_requerida'];
      d.getElementById('presupuesto').value = data['presupuesto'];
      // $('#partida_id').select2('val', '1');
      $('#partida_id').val(data.partida_id).trigger('change');
      $('#modal').modal('show');
   }

   if(e.target.matches('[data-delete]') || e.target.matches('[data-delete] *'))
   {
      $('#modal_delete').modal('show');
      let data = $('#items').DataTable().row($(e.target).parents('tr') ).data();
      d.querySelector('.message').textContent = data.bien_servicio;
   }
});

// EVENTO SUBMIT
d.addEventListener('submit', (e)=>{
   if(e.target.matches('#form'))
   {
      if(e.target.hasAttribute('data-form'))
      {
         e.preventDefault();
         d.querySelector('.spinner-border').style.display = 'inline-block';
         d.getElementById('btnGuardar').disabled = true;
         d.querySelectorAll('[data-error="textarea"]').forEach((el)=>{ el.classList.remove('is-invalid') });
         d.querySelectorAll('[data-error="input"]').forEach((el)=>{ el.classList.remove('is-invalid') });
         d.querySelectorAll('[data-error="span"]').forEach((el)=>{ el.textContent = '' });
         d.querySelectorAll('[data-error="select"]').forEach((el)=>{ el.classList.remove('is-invalid') });
         const datos = new FormData(e.target);
			axios.post('/items/'+ actividad_uuid, datos) //enviamos todos los input del form
        	.then(function (response) {
            console.log(response);
            location.reload();
            // $('#items').DataTable().ajax.reload(null, false);
            // $('#modal').modal('hide');
         })
         .catch(function (error) {
            // console.log(error.response.data.errors);
            const objeto = error.response.data.errors; //creamos el objeto para luego recorrerlo
            if (error.response.data.hasOwnProperty('errors')) //preguntamos si exite la propiedad donde se almacenan los errores false/true
            {
               d.querySelector('.spinner-border').style.display = 'none';
               d.getElementById('btnGuardar').disabled = false;
               for (let key in  objeto) {
                  // console.log(key);
                  // console.log(objeto[key]);
                  d.getElementById(key).classList.add('is-invalid');
                  d.getElementById(key+'-error').textContent = objeto[key];
               }
            }
         });
      }
   }
})