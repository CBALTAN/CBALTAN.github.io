<?php
require_once("../modelo/carrito.php");
$usuobj=new carrito;
switch ($_POST['opcion']){
    case 'consulta':
        $datos=$usuobj->obtenerTodo();
        $tabla="";
        foreach ($datos as $fila){
            $tabla.="<tr><td>".$fila['codigo']."</td>";
            $tabla.="<td>".$fila['nombre']."</td>";
            $tabla.="<td>".$fila['precio']."</td>";
            $tabla.="<td>".$fila['cantidad']."</td></tr>";
        }
        echo $tabla;
        break;

    case 'insertar':
        $datos['nombre']=$_POST['nombre'];
        $datos['precio']=$_POST['precio'];
        $datos['cantidad']=$_POST['cantidad'];
        echo ($usuobj->insertar($datos));
        break;

    case 'eliminarTodo':
        $tabla = "carrito"; 
        $resultado = $usuobj->eliminarTodo($tabla);
        break;
    default:
        // code..
        break;
}


?>