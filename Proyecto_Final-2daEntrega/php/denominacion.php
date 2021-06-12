<?php 
//Modelo
include("conexion.php");

if(isset($_POST['accion'])){
    $accion                 = $_POST['accion'];
    $parametro              = $_POST['parametro'];
}
if(isset($_GET['accion'])){    
    $accion                 = $_GET['accion'];
    $parametro              = $_GET['parametro'];
}


switch ($parametro) {
    case 1:
        accionRead1PHP($conexion);
    break;   
    case 2:
        accionRead2PHP($conexion);
    break;    
    case 3:
        accionRead3PHP($conexion);
    break;  
    case 4:
        accionReadElectivasPHP($conexion);
    break;  
}

function accionRead1PHP($conexion)
{   
    $respuesta = array();
    if(isset($_GET['id'])){
        $id=$_GET['id'];

        $Query = " SELECT * FROM denominacion WHERE eje_tematico='Inquietudes vocacionales propias' ";

        $resultado        = mysqli_query($conexion,$Query);
        $numeroRegistros  = mysqli_num_rows($resultado);

        if($numeroRegistros>=1){
            $Registros                   = mysqli_fetch_array($resultado);
            
            $respuesta["estado"]         = 1;
            $respuesta["mensaje"]        = "Si hay registros";
            $respuesta["id"]             = $Registros["id"];
            $respuesta["modalidad"]      = $Registros["modalidad"];
            $respuesta["ejemplos"]       = $Registros["ejemplos"];
            $respuesta["descripcion"]    = $Registros["descripcion"];

        }else{
            $respuesta["estado"]    = 0;
            $respuesta["mensaje"]   = "NO hay registros";
        }

    }else{

        $Query =" SELECT * FROM denominacion WHERE eje_tematico='Inquietudes vocacionales propias' ";

        $resultado       = mysqli_query($conexion,$Query);
        $numeroRegistros = mysqli_num_rows($resultado);
        if($numeroRegistros >= 1){
            $respuesta["estado"]         = 1;
            $respuesta["mensaje"]        = "Si hay registros";
            $respuesta["denominaciones"] = array();
        
            while($row = mysqli_fetch_array($resultado)){
                $objetoDenominacion      = array();
             
                $objetoDenominacion["id"]                = $row["id"];
                $objetoDenominacion["moda1"]             = $row["modalidad"];
                $objetoDenominacion["ejem1"]             = $row["ejemplos"];
                $objetoDenominacion["cred1"]             = $row["descripcion"];           

                array_push($respuesta["denominaciones"],$objetoDenominacion);
            }
        }
        else{
            $respuesta["estado"]    = 0;
            $respuesta["mensaje"]   = "NO hay registros";
        }
    }
    echo json_encode($respuesta);
    mysqli_close($conexion);
}


function accionRead2PHP($conexion)
{   
    $respuesta = array();
    if(isset($_GET['id'])){
        $id=$_GET['id'];

        $query =" SELECT * FROM denominacion WHERE eje_tematico='Énfasis en la profesión' ";

        $resultado = mysqli_query($conexion,$Query);
        $numeroRegistros = mysqli_num_rows($resultado);

        if($numeroRegistros>=1){
            $Registros=mysqli_fetch_array($resultado);
            
            $respuesta["estado"]       = 1;
            $respuesta["mensaje"]      = "Si hay registros";
            $respuesta["id"]           = $Registros["id"];
            $respuesta["modalidad"]    = $Registros["modalidad"];
            $respuesta["ejemplos"]     = $Registros["ejemplos"];
            $respuesta["descripcion"]  = $Registros["descripcion"];

        }else{
            $respuesta["estado"]    = 0;
            $respuesta["mensaje"]   = "NO hay registros";
        }

    }else{
        $Query =" SELECT * FROM denominacion WHERE eje_tematico='Énfasis en la profesión' ";

        $resultado = mysqli_query($conexion,$Query);
        $numeroRegistros = mysqli_num_rows($resultado);
        if($numeroRegistros >= 1){
            $respuesta["estado"]          = 1;
            $respuesta["mensaje"]         = "Si hay registros";
            $respuesta["denominaciones"]  = array();
        
            while($row = mysqli_fetch_array($resultado)){
                $objetoDenominacion               = array();
                $objetoDenominacion["id"]         = $row["id"];
                $objetoDenominacion["moda2"]      = $row["modalidad"];
                $objetoDenominacion["ejem2"]      = $row["ejemplos"];
                $objetoDenominacion["cred2"]      = $row["descripcion"];           

                array_push($respuesta["denominaciones"],$objetoDenominacion);
            }
        }
        else{
            $respuesta["estado"]    = 0;
            $respuesta["mensaje"]   = "NO hay registros";
        }
    }
    echo json_encode($respuesta);
    mysqli_close($conexion);
}



function accionRead3PHP($conexion)
{   
    $respuesta = array();//arreglo1
    if(isset($_GET['id'])){
        $id=$_GET['id'];

        $Query =" SELECT * FROM denominacion WHERE eje_tematico='Complementarias a la formación' ";

        $resultado       = mysqli_query($conexion,$Query);
        $numeroRegistros = mysqli_num_rows($resultado);

        if($numeroRegistros>=1){
            $Registros                 = mysqli_fetch_array($resultado);
            $respuesta["estado"]       = 1;
            $respuesta["mensaje"]      = "Si hay registros";
            $respuesta["id"]           = $Registros["id"];
            $respuesta["modalidad"]    = $Registros["modalidad"];
            $respuesta["ejemplos"]     = $Registros["ejemplos"];
            $respuesta["descripcion"]  = $Registros["descripcion"];

        }else{
            $respuesta["estado"]    = 0;
            $respuesta["mensaje"]   = "NO hay registros";
        }

    }else{
        $Query =" SELECT * FROM denominacion WHERE eje_tematico='Complementarias a la formación' ";

        $resultado = mysqli_query($conexion,$Query);
        $numeroRegistros = mysqli_num_rows($resultado);
        if($numeroRegistros >= 1){
            $respuesta["estado"]          = 1;
            $respuesta["mensaje"]         = "Si hay registros";
            $respuesta["denominaciones"]  = array();
        
            while($row = mysqli_fetch_array($resultado)){
                $objetoDenominacion             = array();
                $objetoDenominacion["id"]       = $row["id"];
                $objetoDenominacion["moda3"]    = $row["modalidad"];
                $objetoDenominacion["ejem3"]    = $row["ejemplos"];
                $objetoDenominacion["cred3"]    = $row["descripcion"];           

                array_push($respuesta["denominaciones"],$objetoDenominacion);
            }
        }
        else{
            $respuesta["estado"]   = 0;
            $respuesta["mensaje"]  = "NO hay registros";
        }
    }
    echo json_encode($respuesta);
    mysqli_close($conexion);
}


function accionReadElectivasPHP($conexion)
{   
    $respuesta = array();
    if(isset($_GET['id'])){
        $id=$_GET['id'];

        $query =" SELECT nombre, creditos, creditos_acumulados FROM electiva ";

        $resultado          = mysqli_query($conexion,$query);
        $numeroRegistros    = mysqli_num_rows($resultado);

        if($numeroRegistros>=1){
            $Registros = mysqli_fetch_array($resultado);
            
            $respuesta["estado"]                 = 1;
            $respuesta["mensaje"]                = "Si hay registros";
            $respuesta["nombre"]                 = $Registros["nombre"];
            $respuesta["creditos"]               = $Registros["creditos"];
            $respuesta["creditos_acumulados"]    = $Registros["creditos_acumulados"];

        }else{
            $respuesta["estado"]  = 0;
            $respuesta["mensaje"] = "NO hay registros";
        }

    }else{

        $query =" SELECT nombre, creditos, creditos_acumulados FROM electiva ";

        $resultado = mysqli_query($conexion,$query);
        $numeroRegistros = mysqli_num_rows($resultado);
        if($numeroRegistros >= 1){
            $respuesta["estado"]         = 1;
            $respuesta["mensaje"]        = "Si hay registros";
            $respuesta["electivas"] = array();
        
            while($row = mysqli_fetch_array($resultado)){
                $objetoElectiva = array();

                $objetoElectiva["nombre"]                = $row["nombre"];
                $objetoElectiva["creditos"]              = $row["creditos"];
                $objetoElectiva["creditos_acumulados"]   = $row["creditos_acumulados"];

                array_push($respuesta["electivas"],$objetoElectiva);
            }
        }
        else{
            $respuesta["estado"]  = 0;
            $respuesta["mensaje"] = "NO hay registros";
        }
    }
    echo json_encode($respuesta);
    mysqli_close($conexion);
}

?>