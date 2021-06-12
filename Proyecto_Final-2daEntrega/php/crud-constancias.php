<?php
    include("conexion.php");
    /*Modelo de datos = Modelo-Vista-Controlador
        Modelo          = .PHP 
        Vista           = .HTML 
        Controlador     = .JS

        CRUD        
        Crear       
        Leer
        Actualizar
        Eliminar

    */
if(isset($_POST['accion']))
    $accion                 = $_POST['accion'];
if(isset($_GET['accion']))    
    $accion                 = $_GET['accion'];

switch ($accion) {
    case 'Create':
        actionCreatePHP($conexion);
        break;
    case 'Read':
        accionReadPHP($conexion);
        break;
    case 'Delete':
        accionDeletePHP($conexion);
        break;
    case 'Update':
        accionUpdatePHP($conexion);
        break;        
    default:
        # code...
        break;
}


    function actionCreatePHP($conexion){
    $actividad          = $_POST['actividad'];
    $fecha_inicio       = $_POST['fecha_inicio'];
    $fecha_fin          = $_POST['fecha_fin'];
    $horas              = $_POST['horas'];
    $archivo            = $_POST['archivo'];
    $observaciones      = $_POST['observaciones'];
 

    $Query    = "INSERT INTO constancia (id, actividad, fecha_inicio, fecha_fin, horas, archivo, observaciones, valida, observaciones_encargado, creditos, denominacion_id, alumno_id) 
                 VALUES (NULL, '". $actividad."', '".$fecha_inicio."', '".$fecha_fin."', '".$horas."', '".$archivo."', '".$observaciones."', -1, '', 0, 8, 5)";

     //echo $Query;
     
     $resultado = mysqli_query($conexion,$Query); 
     $respuesta = array();
    
     if($resultado >= 1){
            $respuesta["Estado"]            = 1;
            $respuesta["Mensaje"]           = "La información se guardó correctamente";
            $respuesta["id"]                = mysqli_insert_id($conexion);
            echo json_encode($respuesta);
        }
        else{
            $respuesta["Estado"]   = 0;
            $respuesta["Mensaje"]  = "Ocurrió un error desconocido";
            $respuesta["id"]       = -1;
            echo json_encode($respuesta);
        }
        mysqli_close($conexion);
    }


    function accionReadPHP($conexion){   
        $respuesta = array();

        if(isset($_GET['id'])){
            $id               = $_GET['id'];
            $Query            = "SELECT * FROM constancia WHERE id=".$id;
            $resultado        = mysqli_query($conexion,$Query);
            $numeroRegistros  = mysqli_num_rows($resultado);

            if($numeroRegistros>=1){
                $Registros            = mysqli_fetch_array($resultado);
                
                $respuesta["estado"]  = 1;
                $respuesta["mensaje"] = "Si hay registros";

                $respuesta["id"]                      = $Registros["id"];
                $respuesta["actividad"]               = $Registros["actividad"];
                $respuesta["fecha_inicio"]            = $Registros["fecha_inicio"];
                $respuesta["fecha_fin"]               = $Registros["fecha_fin"];
                $respuesta["horas"]                   = $Registros["horas"];
                $respuesta["archivo"]                 = $Registros["archivo"];
                $respuesta["observaciones"]           = $Registros["observaciones"];

            }else{
                $respuesta["estado"]  = 0;
                $respuesta["mensaje"] = "No hay registros";
            }

        }else{
            $Query = "SELECT * FROM constancia";
        }

        $Query                           = "SELECT * FROM constancia";
        $resultado                       = mysqli_query($conexion,$Query);
        $numeroRegistros                 = mysqli_num_rows($resultado);
        if($numeroRegistros >= 1){
            $respuesta["estado"]         = 1;
            $respuesta["mensaje"]        = "Si hay registros";
            $respuesta["constancias"]    = array();
            
            while($row = mysqli_fetch_array($resultado)){
                $objetoConstancia                           = array(); 

                $objetoConstancia["id"]                     = $row["id"];
                $objetoConstancia["actividad"]              = $row["actividad"];
                $objetoConstancia["fecha_inicio"]           = $row["fecha_inicio"];
                $objetoConstancia["fecha_fin"]              = $row["fecha_fin"];
                $objetoConstancia["horas"]                  = $row["horas"];
                $objetoConstancia["archivo"]                = $row["archivo"];
                $objetoConstancia["observaciones"]          = $row["observaciones"];

                array_push($respuesta["constancias"],$objetoConstancia);
            }
        }
        else{
            $respuesta["estado"]  = 0;
            $respuesta["mensaje"] = "No hay registros";
        }
        echo json_encode($respuesta);
        mysqli_close($conexion);
    }

    function accionUpdatePHP($conexion){
        $Respuesta = array();
        
        $id                     = $_POST["id"];

        $actividad              = $_POST['actividad'];
        $fecha_inicio           = $_POST['fecha_inicio'];
        $fecha_fin              = $_POST['fecha_fin'];
        $horas                  = $_POST['horas'];
        $archivo                = $_POST['archivo']; 
        $observaciones          = $_POST['observaciones'];
    
        $Query=" UPDATE constancia ";
        $Query=$Query." SET actividad='".$actividad."', fecha_inicio='".$fecha_inicio."', fecha_fin='".$fecha_fin."', horas='".$horas."', archivo='".$archivo."', observaciones='".$observaciones."' ";
        $Query=$Query." WHERE id=".$id;
    
        mysqli_query($conexion,$Query);
        $numeroRegistros=mysqli_affected_rows($conexion);
    
        if($numeroRegistros>=1){
            $respuesta["estado"]         = 1;
            $respuesta["mensaje"]        = "El registro se actualizo correctamente";
        }else{
            $respuesta["estado"]         = 0;
            $respuesta["mensaje"]        = "Ocurrió un error desconocido";
        }
    
        echo json_encode($respuesta);
        mysqli_close($conexion);
    }

    function accionDeletePHP($conexion){
        $respuesta    = array();
        $id           =$_POST["id"];
        $Query        = "DELETE FROM constancia WHERE constancia.id = ".$id;

        mysqli_query($conexion,$Query);
        $numeroRegistros=mysqli_affected_rows($conexion);

        if($numeroRegistros >=1){
            $respuesta["estado"]         = 1;
            $respuesta["mensaje"]        = "El registro se elimino correctamente";
        }else{
            $respuesta["estado"]         = 0;
            $respuesta["mensaje"]        = "Ocurrió un error desconocido";
        }

        echo json_encode($respuesta);
        mysqli_close($conexion);
    }

  

?>