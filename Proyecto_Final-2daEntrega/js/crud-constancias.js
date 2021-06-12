//Conrolador
var idSeleccionadoParaEliminar   = 0;
var idSeleccionadoParaActualizar = 0;

function actionCreate() {
    //POST
    var tabla                 = $('#datatable').DataTable();

    var nombre_create         = document.getElementById("nombre_create").value 
    var fecha_in_create       = document.getElementById("fecha_in_create").value
    var fecha_ter_create      = document.getElementById("fecha_ter_create").value
    var hora_create           = document.getElementById("hora_create").value
    var subir_cons_create     = document.getElementById("subir_cons_create").value
    var observaciones_create  = document.getElementById("observaciones_create").value
    
    //$ = jquery

    $.ajax({
        url    : "php/crud-constancias.php",
        method : 'POST',
        data: {
            actividad       : nombre_create,
            fecha_inicio    : fecha_in_create,
            fecha_fin       : fecha_ter_create,
            horas           : hora_create,
            archivo         : subir_cons_create,
            observaciones   : observaciones_create,
            accion          : 'Create'
          },
        success: function( resultado ){
            var objetoJSON = JSON.parse( resultado );           
                if(objetoJSON.Estado == 1){
                            //AGREGAR BOTONES
                    var botones   = '<a class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#Modal-actualizar" onclick="recuperaDatosUpdate('+objetoJSON.id+');" href="#">';
                    botones       = botones + '<i class="fa fa-pencil">';
                    botones       = botones + '</i>';
                    botones       = botones + '</a>';
                    botones       = botones + '<a class="btn btn-danger btn-sm text-white" data-toggle="modal" data-target="#Modal-eliminar" onclick="idSeleccionEliminar('+objetoJSON.id+');" href="#">';
                    botones       = botones + '<i class="fa fa-trash">';
                    botones       = botones + '</i>';
                    botones       = botones + '</a>';
                   
                    tabla.row.add([
                        nombre_create,
                        fecha_in_create,
                        hora_create,
                        botones
                    ]).node().id = 'renglon_'+objetoJSON.id;
                    tabla.draw(false);

                alert(objetoJSON.Mensaje);
                $('#Modal2').modal ('hide'); 
    
            }else{
                alert(objetoJSON.Mensaje);
            }
        }
    });
}


function actionRead() {
    //GET
    $.ajax({
        url        : "php/crud-constancias.php",
        method     : 'GET',
        data       : {
        accion     : 'Read'
            },
            success: function( resultado ){
                    var objetoJSON = JSON.parse( resultado );
                    //alert(resultado);
                    if(objetoJSON.estado == 1){
                            var tabla         = $('#datatable').DataTable();
                            for(var constancia of objetoJSON.constancias){
                                var botones   = '<a class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#Modal-actualizar" onclick="recuperaDatosUpdate('+constancia.id+');" href="#">';
                                botones       = botones + '<i class="fa fa-pencil">';
                                botones       = botones + '</i>';
                                botones       = botones + '</a>';
                                botones       = botones + '<a class="btn btn-danger btn-sm text-white" data-toggle="modal" data-target="#Modal-eliminar" onclick="idSeleccionEliminar('+constancia.id+');" href="#">';
                                botones       = botones + '<i class="fa fa-trash">';
                                botones       = botones + '</i>';
                                botones       = botones + '</a>';

                                    tabla.row.add([    
                                        constancia.actividad,
                                        constancia.fecha_inicio,
                                        constancia.horas,
                                        botones
                                    ]).node().id = 'renglon_'+constancia.id;

                                    tabla.draw(false);
                                }
                        }else{
                                
                    }
             }
    });
}


function actionUpdate() {
    //PUT
    //var tabla               = $('#datatable').DataTable();
    var nombre_update         = document.getElementById("nombre_update").value 
    var fecha_in_update       = document.getElementById("fecha_in_update").value
    var fecha_ter_update      = document.getElementById("fecha_ter_update").value
    var hora_update           = document.getElementById("hora_update").value
    var subir_cons_update     = document.getElementById("subir_cons_update").value
    var observaciones_update  = document.getElementById("observaciones_update").value

    $.ajax({
            url: "php/crud-constancias.php",
            method: 'POST',
            data: {
                    id               : idSeleccionadoParaActualizar,
                    actividad        : nombre_update ,
                    fecha_inicio     : fecha_in_update ,
                    fecha_fin        : fecha_ter_update ,
                    horas            : hora_update ,
                    archivo          : subir_cons_update ,
                    observaciones    : observaciones_update ,
                    accion           : 'Update'  
                  },
                success: function( resultado ){
                        var objetoJSON = JSON.parse(resultado);
                        if(objetoJSON.estado==1){
                            alert(objetoJSON.mensaje);
                            var tabla     = $('#datatable').DataTable();
                            var renglon   = tabla.row("#renglon_"+idSeleccionadoParaActualizar).data();
                            renglon[0]    = nombre_update;
                            renglon[1]    = fecha_in_update;
                            renglon[2]    = hora_update;

                            tabla.row("#renglon_"+idSeleccionadoParaActualizar).data(renglon);
                            $('#Modal-actualizar').modal ('hide');
                        }else{
                            alert(objetoJSON.mensaje);
                        }
            }
    });
}


function recuperaDatosUpdate(id){
    //alert (id);
    idSeleccionadoParaActualizar=id;
    $.ajax({
            url           : "php/crud-constancias.php",
            method        : 'GET',
                data      : {
                id        : idSeleccionadoParaActualizar,
                accion    : 'Read'
                },
                success: function( resultado ){
                        var objetoJSON = JSON.parse( resultado );
                        if(objetoJSON.estado==1){
                            $("#nombre_update").val(objetoJSON.actividad); 
                            $("#fecha_in_update").val(objetoJSON.fecha_in);
                            $("#fecha_ter_update").val(objetoJSON.fecha_fin);
                            $("#hora_update").val(objetoJSON.horas);
                            $("#subir_cons_update").val(objetoJSON.archivo);
                            $("#observaciones_update").val(objetoJSON.observaciones);

                        }else{
                            alert(objetoJSON.mensaje);
                        }
            }
    });
}


function actionDelete() {
    //DELETE
    $.ajax({
        url          : "php/crud-constancias.php",
        method       : 'POST',
            data     : {
            id       : idSeleccionadoParaEliminar,
            accion   : 'Delete'
            },
            success: function( resultado ){
                    var objetoJSON = JSON.parse( resultado );
                    if(objetoJSON.estado==1){
                            var tabla = $('#datatable').DataTable();
                        //ELIMINAR DE LA TABLA EL RENGLON
                        tabla.row("#renglon_"+idSeleccionadoParaEliminar).remove().draw();
                    }
                    alert(objetoJSON.mensaje);
                    $('#Modal-eliminar').modal ('hide'); 
            }
        });
}

function idSeleccionEliminar(id){
    //alert (id);
    idSeleccionadoParaEliminar = id;
}


