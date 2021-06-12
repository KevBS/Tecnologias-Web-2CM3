function actionRead1(){ 
    //GET
    $.ajax({
        url         : "php/denominacion.php",
        method      : 'GET',
            data    : {
                parametro  : 1,
                accion     : 'Read'
            },
            success: function( Resultado ){
               // alert(Resultado);
                    var objetoJSON = JSON.parse(Resultado);
                    if(objetoJSON.estado == 1){                        
                            var tabla = $('#tabla1').DataTable();
                                
                                for(var denominacion of objetoJSON.denominaciones){
                                        tabla.row.add([    
                                        denominacion.moda1,
                                        denominacion.ejem1,
                                        denominacion.cred1,
                                        ]).node().id = 'renglon_'+denominacion.id;
                                        tabla.draw(false);
                                }                  
                    }else{
                          
                    }
            },
    });
}

function actionRead2(){
    //GET
    $.ajax({
            url        : "php/denominacion.php",
            method     : 'GET',
            data       : {
            parametro  :2,    //por parametros en el switch
            accion     : 'Read'
            },
            success: function( Resultado ){
                    var objetoJSON = JSON.parse(Resultado);
                    if(objetoJSON.estado == 1){
                           
                            var tabla = $('#tabla2').DataTable();
                                for(var denominacion of objetoJSON.denominaciones){
                                        tabla.row.add([    
                                        denominacion.moda2,
                                        denominacion.ejem2,
                                        denominacion.cred2,
                                        ]).node().id = 'renglon_'+denominacion.id;

                                        tabla.draw(false);
                                }                  
                    }else{
                           
                    }
            },
    });
}

function actionRead3(){
    //GET
    $.ajax({
        url         : "php/denominacion.php",
        method      : 'GET',
            data    : {
                parametro  : 3,
                accion     : 'Read'
            },
            success: function( Resultado ){ 
                    var objetoJSON = JSON.parse(Resultado);
                    if(objetoJSON.estado == 1){
                           
                            var tabla = $('#tabla3').DataTable();
                                for(var denominacion of objetoJSON.denominaciones){
                                        tabla.row.add([    
                                        denominacion.moda3,
                                        denominacion.ejem3,
                                        denominacion.cred3,
                                        ]).node().id = 'renglon_'+denominacion.id;

                                        tabla.draw(false);
                                }                  
                    }else{
                          
                    }
            },
    });
}


function actionReadElectivas(){
    //GET
    $.ajax({
        urlq       : "php/denominacion.php",
        method     : 'GET',
        data       : {
            parametro  : 4,
            accion     : 'Read'
            },
            success: function( Resultado ){ 
                    var objetoJSON = JSON.parse(Resultado);
                    if(objetoJSON.estado == 1){
                            var tabla = $('#barra-electivas').DataTable();
                                for(var electiva of objetoJSON.electivas){
                                    var porcentaje = (electiva.creditos_acumulados/electiva.creditos)*100;
                                    var barras     = '<div class="progress">';
                                        barras     = barras+' <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"'; 
                                        barras     = barras+'aria-valuenow=" ' +electiva.creditos_acumulados+'" aria-valuemin="0" aria-valuemax="'+electiva.creditos+'" style="width: '+porcentaje+'%">';
                                        barras     = barras+'</div>';
                                        barras     = barras+'</div>';
                                
                                        tabla.row.add([    
                                        electiva.nombre,
                                        barras
                                        ]).node().id = 'renglon_'+electiva.id;

                                        tabla.draw(false);
                                }                  
                    }else{
                        
                    }
            },
    });
}
                             