<?php
    //Estos datos seran requeridos para establecer la comunicacion con la base de datos
    $servidor        = "localhost";
    $usuario         = "root";
    $clave           = "";
    $basedatos       = "electivas";
                
    $conexion = mysqli_connect($servidor,$usuario,$clave,$basedatos);
    
?>