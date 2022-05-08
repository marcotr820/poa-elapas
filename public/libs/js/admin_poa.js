const d = document;
function update(accion_uuid){
    d.getElementById('form').onsubmit = function (e){
        e.preventDefault();
        let datosform = $(e.target).serializeArray();
        $.ajax({
            url:"/update_status_corto_plazo_accion/"+ accion_uuid,
            type: 'PUT',
            data: datosform,
            success:function(resp){
                console.log(resp);
                $('#modal').modal('hide');
                $('#table').DataTable().ajax.reload(null, false);
                // contamos las acciones que tengan un status 1 para mostrarlos como notificacion en el sidebar
                axios.get('/notificacion')
                .then(function(response){
                    if(response.data === 0){
                        d.getElementById('notificacion').setAttribute('hidden', true);
                    }else{
                        d.getElementById('notificacion').removeAttribute('hidden');
                        d.getElementById('notificacion').innerHTML = response.data;
                    }
                })
                .catch(function(error){
                    console.log(error);
                });
            }
        })
    }
    
}

// EVENTO CHANGE
function cambio (){
    if(d.querySelector('.select2').value != ''){
        var pei_uuid = d.querySelector('.select2').value;
        axios.get('/data_pei/' + pei_uuid)
        .then(function (resp) {
            d.querySelector('.objetivo_especifico').innerHTML = resp.data.objetivo_institucional;
            d.querySelector('.gerencia').textContent = resp.data.nombre_gerencia;
        })
        .catch(function (error) {
        });

        $('#table').DataTable({
            "destroy": true, /*metodo para destriur la tabla que tenemos al inicio y remplazarla por una nueva con nuevos datos*/
            "processing": true,
            "serverSide": true,
            "ajax": {
               "url": "/listar_acciones/"+pei_uuid,
               "type": "GET"
            },
            columns: [
                { data: 'accion_corto_plazo', name:'accion_corto_plazo'},
                { 
                    data: 'presupuesto_programado',
                    render: function(data, type, row) {
                    var number = $.fn.dataTable.render.number( ',', '.', 2, 'Bs ').display(data);
                        return number;
                    }
                },
                {
                    data: 'status',
                    render: function(data, type, row) {
                        switch(data){
                            case 'editar': 
                                return `<span class="badge badge-warning p-1"><b>EDICION</b></span>`;
                            break;

                            case 'presentado': 
                                return `<span class="badge badge-danger p-1">PRESENTADO</span>`;
                            break;

                            case 'aprobado': 
                                return `<span class="badge badge-success p-1">APROBADO</span>`;
                            break;

                            case 'monitoreo': 
                                return `<span class="badge badge-primary p-1">MONITOREO</span>`;
                            break;
                        }
                    }
                },
                { 
                    data: 'uuid',
                    render: function(data, type, row) {
                        switch(row.status){
                            case 'editar': 
                                return `<button class="boton yellow" data-accion="" onclick="update('${data}')"><i class="fas fa-cogs"></i></button>`;
                            break;

                            case 'presentado': 
                                return `<button class="boton red" data-accion="" onclick="update('${data}')"><i class="fas fa-cogs"></i></button>`;
                            break;

                            case 'aprobado':
                                return `<button class="boton green" data-accion="" onclick="update('${data}')"><i class="fas fa-cogs"></i></button>`;
                            break;

                            case 'monitoreo':
                                return `<button class="boton yellow" data-accion="" onclick="update('${data}')"><i class="fas fa-cogs"></i></button>`;
                            break;

                            // default: return `<button class="btn btn-primary btn-sm" data-accion="" onclick="update('${data}')"><i class="fas fa-cogs"></i></button>`;
                        }
                    }
                }
            ]
        });
    }
}

// EVENTO CLICK
d.addEventListener('click', (e)=>{
    if(e.target.matches('[data-accion]') || e.target.matches('[data-accion] *')){
        let data = $('#table').DataTable().row($(e.target).parents('tr') ).data();
        axios.get('/status_corto_plazo_accion/' + data.uuid) //enviamos todos los input del form
        .then(function (resp) {
            d.getElementById('accion_corto_plazo').textContent = resp.data.accion_corto_plazo;
            d.getElementById('presupuesto_accion').textContent = resp.data.presupuesto_programado;
            d.getElementById('status').value = resp.data.status;
            $("#modal").modal("show");
        })
        .catch(function (error) {
        });
    }

    if(e.target.matches('.select2-selection__rendered')){
        if(d.querySelector('.select2-search__field') != null){
            d.querySelector('.select2-search__field').focus();
        }   
    }
});